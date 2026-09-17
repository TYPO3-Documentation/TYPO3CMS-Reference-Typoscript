<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Check the TypoScript snippets of the manual for syntax errors.
 *
 * TypoScript silently ignores whatever it cannot parse, at runtime as well as
 * here, so a broken example looks fine until somebody copies it. Two checks
 * catch that, and neither finds what the other does:
 *
 * - Round trip: the tokenizer is lossless by contract, so casting its output
 *   back to a string has to return the input unchanged. Anything the tokenizer
 *   could not read is missing from the result, together with everything that
 *   followed it.
 * - Brace balance: an unclosed or surplus curly brace round trips unchanged,
 *   so the opening and closing block lines are counted instead.
 *
 * A file demonstrating invalid syntax on purpose says so in its first line:
 *
 *     # typoscript-lint: ignore-file
 *
 * A file whose content is shown to the reader verbatim cannot carry that
 * comment, because the renderer silently ignores the :lines: option of
 * literalinclude and would print it. Those paths are listed in
 * Build/typoscriptLint.ignore instead.
 *
 * Examples name the variable part of a path with an angle-bracket placeholder,
 * `<tableName>` or `<table name>`. The tokenizer cannot read that as an
 * identifier and drops the line, so placeholders are replaced before the
 * checks run. Only the part of a line before the first "=" or "{" is touched:
 * after that a value begins, where angle brackets are usually HTML and a
 * mistake there should still be reported.
 *
 * `\TYPO3\CMS\Core\TypoScript\Tokenizer\LosslessTokenizer` is marked
 * `@internal`, but its own description names syntax linting as the reason it
 * is lossless. A Core update may change it; only this script would break.
 */

use TYPO3\CMS\Core\TypoScript\Tokenizer\Line\BlockCloseLine;
use TYPO3\CMS\Core\TypoScript\Tokenizer\Line\IdentifierBlockOpenLine;
use TYPO3\CMS\Core\TypoScript\Tokenizer\Line\LineStream;
use TYPO3\CMS\Core\TypoScript\Tokenizer\LosslessTokenizer;

require __DIR__ . '/../../.Build/vendor/autoload.php';

/**
 * Count opening and closing block lines over the whole stream.
 */
function countBraces(LineStream $stream, int &$open, int &$close): void
{
    foreach ($stream->getNextLine() as $line) {
        if ($line instanceof IdentifierBlockOpenLine) {
            $open++;
        }
        if ($line instanceof BlockCloseLine) {
            $close++;
        }
        if (method_exists($line, 'getChildLineStream') && $line->getChildLineStream() !== null) {
            countBraces($line->getChildLineStream(), $open, $close);
        }
    }
}

/**
 * Replace angle-bracket placeholders in identifier position with a plain name.
 */
function replacePlaceholders(string $source): string
{
    $lines = explode("\n", $source);
    foreach ($lines as $number => $line) {
        $identifierLength = strcspn($line, '={');
        $lines[$number] = preg_replace(
            '/<[^<>\r\n]+>/',
            'placeholder',
            substr($line, 0, $identifierLength)
        ) . substr($line, $identifierLength);
    }
    return implode("\n", $lines);
}

/**
 * The first line of $source that $roundTrip no longer contains.
 */
function firstDroppedLine(string $source, string $roundTrip): int
{
    $sourceLines = explode("\n", $source);
    $roundTripLines = explode("\n", $roundTrip);
    foreach ($sourceLines as $number => $line) {
        if (($roundTripLines[$number] ?? null) !== $line) {
            return $number + 1;
        }
    }
    return count($sourceLines);
}

$ignoreList = __DIR__ . '/../typoscriptLint.ignore';
$ignoredPaths = [];
if (is_file($ignoreList)) {
    foreach (file($ignoreList, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $path) {
        if (!str_starts_with(trim($path), '#')) {
            $ignoredPaths[] = trim($path);
        }
    }
}

$directory = $argv[1] ?? 'Documentation';
$files = [];
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
foreach ($iterator as $file) {
    if ($file->isFile() && in_array($file->getExtension(), ['typoscript', 'tsconfig'], true)) {
        $files[] = $file->getPathname();
    }
}
sort($files);

$failed = 0;
$ignored = 0;
foreach ($files as $file) {
    $source = file_get_contents($file);

    if (in_array($file, $ignoredPaths, true)
        || str_contains($source, '# typoscript-lint: ignore-file')
    ) {
        $ignored++;
        continue;
    }

    $source = replacePlaceholders($source);
    $stream = (new LosslessTokenizer())->tokenize($source);

    $roundTrip = (string)$stream;
    if ($roundTrip !== $source) {
        printf(
            "%s:%d does not survive the tokenizer, the rest of the file is dropped\n",
            $file,
            firstDroppedLine($source, $roundTrip)
        );
        $failed++;
        continue;
    }

    $open = 0;
    $close = 0;
    countBraces($stream, $open, $close);
    if ($open !== $close) {
        printf("%s opens %d blocks and closes %d\n", $file, $open, $close);
        $failed++;
    }
}

printf("\n%d files checked, %d ignored, %d with errors\n", count($files), $ignored, $failed);
exit($failed > 0 ? 1 : 0);
