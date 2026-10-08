<?php

declare(strict_types=1);

/*
 * Creates the pages that the screenshots show. A screenshot of a page
 * TSconfig example gets a page of its own, whose TSconfig field holds the
 * snippet that the documentation includes, so the screenshot always shows
 * what the example does.
 *
 * Runs after "typo3 setup" and "typo3 extension:setup".
 */

use TYPO3\CMS\Core\Authentication\CommandLineUserAuthentication;
use TYPO3\CMS\Core\Configuration\SiteWriter;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\Core\Bootstrap;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Core\SystemEnvironmentBuilder;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Localization\LanguageServiceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

$classLoader = require __DIR__ . '/../../.Build/vendor/autoload.php';
SystemEnvironmentBuilder::run(0, SystemEnvironmentBuilder::REQUESTTYPE_CLI);
$container = Bootstrap::init($classLoader);
Bootstrap::initializeBackendUser(CommandLineUserAuthentication::class);
$GLOBALS['BE_USER']->authenticate();
$GLOBALS['LANG'] = $container->get(LanguageServiceFactory::class)
    ->createFromUserPreferences($GLOBALS['BE_USER']);

$documentation = __DIR__ . '/../../Documentation/';
$snippet = static fn(string $path): string => file_get_contents($documentation . $path);
$fixture = static fn(string $name): string => file_get_contents(__DIR__ . '/Fixtures/' . $name);

$process = static function (array $data): DataHandler {
    $dataHandler = GeneralUtility::makeInstance(DataHandler::class);
    $dataHandler->start($data, []);
    $dataHandler->process_datamap();
    if ($dataHandler->errorLog !== []) {
        throw new RuntimeException(implode("\n", $dataHandler->errorLog));
    }
    return $dataHandler;
};

// One page per TSconfig example, below the root page of "typo3 setup"
$examples = [
    'allowedNewTables' => ['Allowed new tables', 'PageTsconfig/Mod/_codesnippets/_pageTsConfigWebListAllowedNewTable.typoscript'],
    'altLabels' => ['Page type labels', 'PageTsconfig/_codesnippets/_altLabels.typoscript'],
];
$data = ['pages' => []];
foreach ($examples as $key => [$title, $path]) {
    $data['pages']['NEW' . $key] = [
        'pid' => 1,
        'title' => $title,
        'TSconfig' => $snippet($path),
    ];
}
$dataHandler = $process($data);

// The TypoScript of the root page, replacing the one of "typo3 setup"
$connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('sys_template');
$connection->delete('sys_template', ['pid' => 1]);
$process(['sys_template' => ['NEWtemplate' => [
    'pid' => 1,
    'title' => 'Site package',
    'root' => 1,
    'clear' => 3,
    'constants' => $fixture('constants.typoscript'),
    'config' => $fixture('setup.typoscript'),
]]]);

// Without site sets and the TypoScript file that "typo3 setup" writes next
// to the site configuration, the TypoScript of the root page comes from the
// sys_template record alone
$site = GeneralUtility::makeInstance(SiteFinder::class)->getSiteByRootPageId(1);
$configuration = $site->getConfiguration();
unset($configuration['dependencies']);
GeneralUtility::makeInstance(SiteWriter::class)->write($site->getIdentifier(), $configuration);
foreach (['setup.typoscript', 'constants.typoscript'] as $file) {
    @unlink(Environment::getConfigPath() . '/sites/' . $site->getIdentifier() . '/' . $file);
}

// The uids differ between TYPO3 versions, so screenshots.mjs reads them here
$uids = ['root' => 1];
foreach (array_keys($examples) as $key) {
    $uids[$key] = $dataHandler->substNEWwithIDs['NEW' . $key];
}
GeneralUtility::mkdir_deep(Environment::getVarPath());
file_put_contents(Environment::getVarPath() . '/screenshot-records.json', json_encode($uids, JSON_PRETTY_PRINT) . "\n");
