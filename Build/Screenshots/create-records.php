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
use TYPO3\CMS\Core\Cache\CacheManager;
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

// The backend layouts of the exclude example, which names them by uid, so
// they are created first, as uid 1 and 2
$layout = static fn(int $columns): string => "backend_layout {\n  colCount = $columns\n  rowCount = 1\n  rows.1.columns {\n"
    . implode('', array_map(static fn(int $column): string => "    $column {\n      name = Column $column\n      colPos = " . ($column - 1) . "\n    }\n", range(1, $columns)))
    . "  }\n}\n";
$dataHandler = $process(['pages' => ['NEWlayouts' => ['pid' => 1, 'title' => 'Backend layouts', 'doktype' => 254]]]);
$layouts = $dataHandler->substNEWwithIDs['NEWlayouts'];
$process(['backend_layout' => [
    'NEWlayout1' => ['pid' => $layouts, 'title' => 'myLayout01', 'config' => $layout(1)],
]]);
$process(['backend_layout' => [
    'NEWlayout2' => ['pid' => $layouts, 'title' => 'myLayout02', 'config' => $layout(2)],
]]);

// One page per TSconfig example, below the root page of "typo3 setup". The
// value is the snippet the documentation includes, or null for a page that
// shows the default.
$examples = [
    'allowedNewTables' => ['Allowed new tables', 'PageTsconfig/Mod/_codesnippets/_pageTsConfigWebListAllowedNewTable.typoscript'],
    'altLabels' => ['Page type labels', 'PageTsconfig/_codesnippets/_altLabels.typoscript'],
    'newRecordHideInside' => ['New record without page inside', 'PageTsconfig/Mod/_newRecordPages.typoscript'],
    'newContentElementGroup' => ['New content element group', 'PageTsconfig/Mod/_newContentElementWizardGroup.tsconfig'],
    'invalidValue' => ['Invalid value', null],
    'invalidValueLabel' => ['Invalid value with a label', 'PageTsconfig/_codesnippets/_noMatchingValueLabel.typoscript'],
    'invalidValueDisabled' => ['Invalid value disabled', 'PageTsconfig/_codesnippets/_pageFormEngineDisableNoMatchingElement.typoscript'],
    'singleTableView' => ['Single table view', 'PageTsconfig/Mod/_codesnippets/_listOnlyInSingleTableView.typoscript'],
    'backendLayoutExclude' => ['Excluded backend layouts', 'PageTsconfig/_codesnippets/_backendLayoutExclude.typoscript'],
    'description' => ['Field description', 'PageTsconfig/_codesnippets/_description.typoscript'],
    'csvExport' => ['CSV download', 'CodeSnippets/PageTSconfig/Mod/CsvExport.typoscript'],
    'exportButtons' => ['Export button', null],
    'noExportButtons' => ['No export button', 'CodeSnippets/PageTSconfig/Mod/noExportRecordsLinks.typoscript'],
];
$data = ['pages' => []];
foreach ($examples as $key => [$title, $path]) {
    $data['pages']['NEW' . $key] = [
        'pid' => 1,
        'title' => $title,
        'TSconfig' => $path === null ? '' : $snippet($path),
    ];
}
$dataHandler = $process($data);
$uids = ['root' => 1, 'backendLayouts' => $layouts];
foreach (array_keys($examples) as $key) {
    $uids[$key] = $dataHandler->substNEWwithIDs['NEW' . $key];
}

// Records the examples act on
$dataHandler = $process([
    'pages' => [
        'NEWsubpage1' => ['pid' => $uids['singleTableView'], 'title' => 'Subpage 1'],
        'NEWsubpage2' => ['pid' => $uids['singleTableView'], 'title' => 'Subpage 2'],
    ],
    'tt_content' => [
        'NEWcontent1' => ['pid' => $uids['singleTableView'], 'CType' => 'text', 'header' => 'Welcome'],
        'NEWcontent2' => ['pid' => $uids['singleTableView'], 'CType' => 'text', 'header' => 'About us'],
        'NEWheader' => ['pid' => $uids['description'], 'CType' => 'header', 'header' => 'Our services'],
        'NEWcsv' => ['pid' => $uids['csvExport'], 'CType' => 'text', 'header' => 'Welcome'],
        'NEWexport' => ['pid' => $uids['exportButtons'], 'CType' => 'text', 'header' => 'Welcome'],
        'NEWnoExport' => ['pid' => $uids['noExportButtons'], 'CType' => 'text', 'header' => 'Welcome'],
    ],
]);
$uids['headerContent'] = $dataHandler->substNEWwithIDs['NEWheader'];

// The copy examples: "Test" is copied once as TYPO3 does by default, then
// once more with the TSconfig of the example. Each copy goes on top. New
// pages are hidden by default, which only a copy should be.
$dataHandler = $process(['pages' => [
    'NEWcopies' => ['pid' => 1, 'title' => 'Copied pages', 'doktype' => 254, 'hidden' => 0],
]]);
$uids['copies'] = $dataHandler->substNEWwithIDs['NEWcopies'];
$dataHandler = $process(['pages' => ['NEWoriginal' => ['pid' => $uids['copies'], 'title' => 'Test', 'hidden' => 0]]]);
$uids['copyOriginal'] = $dataHandler->substNEWwithIDs['NEWoriginal'];
$copy = static function (int $uid, int $target): void {
    $dataHandler = GeneralUtility::makeInstance(DataHandler::class);
    $dataHandler->start([], ['pages' => [$uid => ['copy' => $target]]]);
    $dataHandler->process_cmdmap();
    if ($dataHandler->errorLog !== []) {
        throw new RuntimeException(implode("\n", $dataHandler->errorLog));
    }
};
$copy($uids['copyOriginal'], $uids['copies']);
$process(['pages' => [$uids['copies'] => ['TSconfig' => $snippet('PageTsconfig/_codesnippets/_disablehideatcopy.typoscript')]]]);
// The page TSconfig of the first copy is still cached
GeneralUtility::makeInstance(CacheManager::class)->getCache('runtime')->flush();
$copy($uids['copyOriginal'], $uids['copies']);

// The page tree label example, whose snippet names a page by uid
$dataHandler = $process(['pages' => [
    'NEWlabels' => ['pid' => 1, 'title' => 'Website', 'hidden' => 0],
]]);
$uids['labels'] = $dataHandler->substNEWwithIDs['NEWlabels'];
$dataHandler = $process(['pages' => [
    'NEWevents' => ['pid' => $uids['labels'], 'title' => 'Events', 'hidden' => 0],
]]);
$uids['labelLast'] = $dataHandler->substNEWwithIDs['NEWevents'];
$dataHandler = $process(['pages' => [
    'NEWblog' => ['pid' => $uids['labels'], 'title' => 'Blog', 'hidden' => 0],
]]);
$uids['labelPage'] = $dataHandler->substNEWwithIDs['NEWblog'];
$process(['pages' => [
    'NEWblogdata' => ['pid' => $uids['labels'], 'title' => 'Blog data', 'doktype' => 254, 'hidden' => 0],
]]);

// The user TSconfig examples, for the administrator
GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('be_users')->update(
    'be_users',
    ['TSconfig' => str_replace('label.296', 'label.' . $uids['labelPage'], $snippet('UserTsconfig/_codesnippets/_properties.typoscript'))
        . "\n" . $snippet('UserTsconfig/_codesnippets/_properties3.tsconfig')],
    ['username' => 'admin']
);

// An image for the file list
GeneralUtility::mkdir_deep(Environment::getPublicPath() . '/fileadmin');
copy(
    $documentation . 'Images/ManualScreenshots/FrontendOutput/Gifbuilder/typo3-gifbuilder-example.png',
    Environment::getPublicPath() . '/fileadmin/typo3-gifbuilder-example.png'
);

// A page type that does not exist, which the DataHandler would not save
$connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('pages');
foreach (['invalidValue', 'invalidValueLabel', 'invalidValueDisabled'] as $key) {
    $connection->update('pages', ['doktype' => 77], ['uid' => $uids[$key]]);
}

// The TypoScript module examples: a TypoScript record with the constants
// example of the manual, one with the static includes of Fluid Styled
// Content, which bring constants for the constant editor, and one with a
// syntax error
$dataHandler = $process(['pages' => [
    'NEWtemplatePage' => ['pid' => 1, 'title' => 'TypoScript record', 'hidden' => 0],
    'NEWstaticIncludes' => ['pid' => 1, 'title' => 'Static includes', 'hidden' => 0],
    'NEWsyntaxError' => ['pid' => 1, 'title' => 'Syntax error', 'hidden' => 0],
]]);
$uids['templatePage'] = $dataHandler->substNEWwithIDs['NEWtemplatePage'];
$uids['staticIncludes'] = $dataHandler->substNEWwithIDs['NEWstaticIncludes'];
$uids['syntaxError'] = $dataHandler->substNEWwithIDs['NEWsyntaxError'];
$dataHandler = $process(['sys_template' => [
    'NEWtemplateRecord' => [
        'pid' => $uids['templatePage'],
        'title' => 'TypoScript record',
        'constants' => $snippet('UsingSetting/_codesnippets/_typoscriptSyntaxUsingConstants.typoscript'),
        'config' => $snippet('UsingSetting/_codesnippets/_example2.typoscript'),
    ],
    'NEWstaticIncludesRecord' => [
        'pid' => $uids['staticIncludes'],
        'title' => 'Static includes',
        'include_static_file' => 'EXT:fluid_styled_content/Configuration/TypoScript/,EXT:fluid_styled_content/Configuration/TypoScript/Styling/',
    ],
    'NEWsyntaxErrorRecord' => [
        'pid' => $uids['syntaxError'],
        'title' => 'Syntax error',
        'config' => $fixture('syntaxError.typoscript'),
    ],
]]);
$uids['staticIncludesRecord'] = $dataHandler->substNEWwithIDs['NEWstaticIncludesRecord'];
// Includes the record with the constants example as well, so the field of
// included records is not empty
$process(['sys_template' => [$uids['staticIncludesRecord'] => [
    'basedOn' => (string)$dataHandler->substNEWwithIDs['NEWtemplateRecord'],
]]]);

// A second site, whose TypoScript comes from site sets instead of a record
$dataHandler = $process(['pages' => [
    'NEWsetsRoot' => ['pid' => 0, 'title' => 'Site with sets', 'is_siteroot' => 1, 'hidden' => 0],
]]);
$uids['setsRoot'] = $dataHandler->substNEWwithIDs['NEWsetsRoot'];

// Two more sites, whose frontend shows the errors of a missing TypoScript
// configuration: one has no TypoScript at all, the other one has a
// TypoScript record without a PAGE object
$dataHandler = $process(['pages' => [
    'NEWnoTypoScript' => ['pid' => 0, 'title' => 'Site without TypoScript', 'is_siteroot' => 1, 'hidden' => 0],
    'NEWnoPage' => ['pid' => 0, 'title' => 'Site without a page', 'is_siteroot' => 1, 'hidden' => 0],
]]);
$uids['noTypoScript'] = $dataHandler->substNEWwithIDs['NEWnoTypoScript'];
$uids['noPage'] = $dataHandler->substNEWwithIDs['NEWnoPage'];

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
// The record of the site without a page, created after the one of the root
// page, so the uids that the screenshots show stay the same
$process(['sys_template' => ['NEWnoPageRecord' => [
    'pid' => $uids['noPage'],
    'title' => 'Main TypoScript',
    'root' => 1,
    'clear' => 3,
]]]);

// Without site sets and the TypoScript file that "typo3 setup" writes next
// to the site configuration, the TypoScript of the root page comes from the
// sys_template record alone
$site = GeneralUtility::makeInstance(SiteFinder::class)->getSiteByRootPageId(1);
$uids['site'] = $site->getIdentifier();
$configuration = $site->getConfiguration();
unset($configuration['dependencies']);
GeneralUtility::makeInstance(SiteWriter::class)->write($site->getIdentifier(), $configuration);
foreach (['setup.typoscript', 'constants.typoscript'] as $file) {
    @unlink(Environment::getConfigPath() . '/sites/' . $site->getIdentifier() . '/' . $file);
}
// The second site takes the same configuration, with the sets of Fluid
// Styled Content
$configuration['rootPageId'] = $uids['setsRoot'];
$configuration['base'] = 'http://localhost:8080/sets/';
$configuration['dependencies'] = ['typo3/fluid-styled-content-css'];
GeneralUtility::makeInstance(SiteWriter::class)->write('sets', $configuration);
// The sites of the error examples, without sets
unset($configuration['dependencies']);
foreach (['noTypoScript' => 'no-typoscript', 'noPage' => 'no-page'] as $root => $identifier) {
    $configuration['rootPageId'] = $uids[$root];
    $configuration['base'] = 'http://localhost:8080/' . $identifier . '/';
    GeneralUtility::makeInstance(SiteWriter::class)->write($identifier, $configuration);
}

// A site for the examples of the data processors: each example gets a page
// with one content element of the type that its TypoScript snippet defines,
// rendered with the Fluid template of the documentation
$examples = [
    'dataProcSite' => ['title' => 'SiteProcessor', 'snippet' => 'SiteProcessor', 'CType' => 'examples_dataprocsite'],
    'dataProcSiteLanguage' => ['title' => 'SiteLanguageProcessor', 'snippet' => 'SiteLanguageProcessor', 'CType' => 'examples_dataprocsitelanguage'],
    'dataProcSplit' => [
        'title' => 'SplitProcessor',
        'snippet' => 'SplitProcessor',
        'CType' => 'examples_dataprocsplit',
        'header_link' => 'https://docs.typo3.org/m/typo3/reference-typoscript/main/en-us/DataProcessing/SplitProcessor.html',
    ],
    'dataProcCsv' => [
        'title' => 'CommaSeparatedValueProcessor',
        'snippet' => 'CommaSeparatedValueProcessor',
        'CType' => 'examples_newcontentcsv',
        'bodytext' => implode("\n", array_map(
            static fn(int $row): string => implode(',', array_map(
                static fn(int $column): string => "\"This is row $row column $column\"",
                range(1, 3)
            )),
            range(1, 3)
        )),
        // The example keeps two of the three columns
        'imagecols' => 2,
        'tx_examples_separator' => ',',
    ],
    'dataProcMenu' => ['title' => 'MenuProcessor', 'snippet' => 'MenuProcessor', 'CType' => 'examples_dataprocmenu'],
    'dataProcLanguageMenu' => ['title' => 'LanguageMenuProcessor', 'snippet' => 'LanguageMenuProcessor', 'CType' => 'examples_dataproclang'],
];
$dataHandler = $process(['pages' => [
    'NEWdataProcessors' => ['pid' => 0, 'title' => 'Data processors', 'is_siteroot' => 1, 'hidden' => 0],
]]);
$uids['dataProcessors'] = $dataHandler->substNEWwithIDs['NEWdataProcessors'];
$pages = [];
foreach (array_reverse($examples, true) as $key => $example) {
    $pages['NEW' . $key] = ['pid' => $uids['dataProcessors'], 'title' => $example['title'], 'hidden' => 0];
}
$dataHandler = $process(['pages' => $pages]);
foreach (array_keys($examples) as $key) {
    $uids[$key] = $dataHandler->substNEWwithIDs['NEW' . $key];
}
// The second level of the menu example, with a spacer between the pages,
// which the template shows as a divider
$process(['pages' => [
    'NEWmenuPage3' => ['pid' => $uids['dataProcMenu'], 'title' => 'Third page', 'hidden' => 0],
    'NEWmenuSpacer' => ['pid' => $uids['dataProcMenu'], 'title' => 'Spacer', 'doktype' => 199, 'hidden' => 0],
    'NEWmenuPage2' => ['pid' => $uids['dataProcMenu'], 'title' => 'Second page', 'hidden' => 0],
    'NEWmenuPage1' => ['pid' => $uids['dataProcMenu'], 'title' => 'First page', 'hidden' => 0],
]]);
// The content element types exist only in the TypoScript of the examples,
// not in the TCA, so the DataHandler would refuse them. The CSV example
// reads its separator from a field of the examples extension.
$contentConnection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tt_content');
$contentConnection->executeStatement('ALTER TABLE tt_content ADD COLUMN tx_examples_separator VARCHAR(1) DEFAULT \'\' NOT NULL');
$setup = "page = PAGE\npage.10 < styles.content.get\n\n"
    // TYPO3 refuses a path with "..", like the one in $documentation
    . 'lib.contentElement.templateRootPaths.200 = ' . realpath($documentation . 'CodeSnippets/DataProcessing/Template') . "/\n";
foreach ($examples as $key => $example) {
    $contentConnection->insert('tt_content', array_merge(
        array_diff_key($example, ['title' => true, 'snippet' => true]),
        ['pid' => $uids[$key], 'colPos' => 0, 'tstamp' => time(), 'crdate' => time()]
    ));
    $setup .= "\n" . $snippet('CodeSnippets/DataProcessing/TypoScript/' . $example['snippet'] . '.typoscript');
}
$configuration['rootPageId'] = $uids['dataProcessors'];
$configuration['base'] = 'http://localhost:8080/data-processors/';
$configuration['dependencies'] = ['typo3/fluid-styled-content'];
// Languages that the pages are not translated into, which the language
// menu example shows as unavailable
$language = $configuration['languages'][0];
$configuration['languages'][] = array_merge($language, [
    'title' => 'Dansk', 'languageId' => 1, 'base' => '/da/', 'locale' => 'da_DK.UTF-8', 'navigationTitle' => 'Dansk', 'flag' => 'dk',
]);
$configuration['languages'][] = array_merge($language, [
    'title' => 'Deutsch', 'languageId' => 2, 'base' => '/de/', 'locale' => 'de_DE.UTF-8', 'navigationTitle' => 'Deutsch', 'flag' => 'de',
]);
GeneralUtility::makeInstance(SiteWriter::class)->write('data-processors', $configuration);
file_put_contents(Environment::getConfigPath() . '/sites/data-processors/setup.typoscript', $setup);

// The uids differ between TYPO3 versions, so screenshots.mjs reads them here
GeneralUtility::mkdir_deep(Environment::getVarPath());
file_put_contents(Environment::getVarPath() . '/screenshot-records.json', json_encode($uids, JSON_PRETTY_PRINT) . "\n");
