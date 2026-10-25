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
use TYPO3\CMS\Core\Resource\StorageRepository;
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
    'linkCssClasses' => ['Link CSS classes', 'PageTsconfig/_codesnippets/_linkHandlerCssClassItems.tsconfig'],
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
        // The header link is a field of type link, whose link browser
        // suggests the CSS classes
        'NEWlinkCss' => ['pid' => $uids['linkCssClasses'], 'CType' => 'header', 'header' => 'Our services'],
    ],
]);
$uids['headerContent'] = $dataHandler->substNEWwithIDs['NEWheader'];
$uids['linkCssContent'] = $dataHandler->substNEWwithIDs['NEWlinkCss'];

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
        . "\n" . $snippet('UserTsconfig/_codesnippets/_properties3.tsconfig')
        . "\n" . $snippet('UserTsconfig/_codesnippets/_showDuplicate.tsconfig')],
    ['username' => 'admin']
);

// An image for the file list: the image of the GIFBUILDER example, under
// the name it had when it was taken by hand
GeneralUtility::mkdir_deep(Environment::getPublicPath() . '/fileadmin');
copy(
    $documentation . 'Images/GeneratedScreenshots/Gifbuilder/GifbuilderExample.png',
    Environment::getPublicPath() . '/fileadmin/typo3-gifbuilder-example.png'
);

// A page type that does not exist, which the DataHandler would not save
$connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('pages');
foreach (['invalidValue', 'invalidValueLabel', 'invalidValueDisabled'] as $key) {
    $connection->update('pages', ['doktype' => 77], ['uid' => $uids[$key]]);
}

// The permission examples: on a page of its own, two pages are created with
// the default permissions, then "Community" with the snippet in the TSconfig
// of the page above. The group and the user the snippets name by uid exist
// under other uids here.
$dataHandler = $process(['be_groups' => [
    'NEWeditors' => ['pid' => 0, 'title' => 'Editors'],
    'NEWtestGroup' => ['pid' => 0, 'title' => 'test_group'],
]]);
$testGroup = $dataHandler->substNEWwithIDs['NEWtestGroup'];
$dataHandler = $process(['be_users' => ['NEWtest' => [
    'pid' => 0,
    'username' => 'test',
    'password' => 'Screenshots-' . bin2hex(random_bytes(8)) . '!X',
    'usergroup' => (string)$dataHandler->substNEWwithIDs['NEWeditors'],
    // The example of importing user TSconfig from a site package
    'TSconfig' => "@import 'EXT:my_sitepackage/Configuration/TsConfig/User/my_editor.tsconfig'\n",
    // The static user TSconfig file of my_extension
    'tsconfig_includes' => 'EXT:my_extension/Configuration/TsConfig/User/editor.tsconfig',
]]]);
$testUser = $dataHandler->substNEWwithIDs['NEWtest'];
$uids['testUser'] = $testUser;
$permissions = [
    'permissionsEverybody' => ['everybody', 'PageTsconfig/_codesnippets/_everybody.typoscript'],
    'permissionsGroup' => ['group', 'PageTsconfig/_codesnippets/_group.typoscript'],
    'permissionsGroupid' => ['groupid', 'PageTsconfig/_codesnippets/_groupid.typoscript'],
    'permissionsUserid' => ['userid', 'PageTsconfig/_codesnippets/_userid.typoscript'],
];
foreach ($permissions as $key => [$property, $path]) {
    $dataHandler = $process(['pages' => [
        'NEWpermissions' => ['pid' => 1, 'title' => 'Permissions: ' . $property, 'hidden' => 0],
    ]]);
    $uids[$key] = $dataHandler->substNEWwithIDs['NEWpermissions'];
    foreach (['Page 1', 'Page 2'] as $title) {
        $process(['pages' => ['NEWpage' => ['pid' => $uids[$key], 'title' => $title, 'hidden' => 0]]]);
    }
    $tsconfig = str_replace(
        ['groupid = 3', 'userid = 2'],
        ['groupid = ' . $testGroup, 'userid = ' . $testUser],
        $snippet($path)
    );
    $process(['pages' => [$uids[$key] => ['TSconfig' => $tsconfig]]]);
    GeneralUtility::makeInstance(CacheManager::class)->getCache('runtime')->flush();
    $process(['pages' => ['NEWcommunity' => ['pid' => $uids[$key], 'title' => 'Community', 'hidden' => 0]]]);
}

// A backend layout with three content areas in two rows, as in the site
// package tutorial, in the page TSconfig of a page that uses it. Only this
// page offers it, so the exclude example still excludes every layout.
$dataHandler = $process(['pages' => ['NEWlayoutPage' => [
    'pid' => 1,
    'title' => 'Page with backend layout',
    'hidden' => 0,
    'TSconfig' => "mod.web_layout.BackendLayouts.stageAndColumns {\n"
        . "  title = Stage and two columns\n"
        . "  config.backend_layout {\n    colCount = 2\n    rowCount = 2\n    rows {\n"
        . "      1.columns.1 {\n        name = Stage\n        colPos = 1\n        colspan = 2\n      }\n"
        . "      2.columns {\n        1 {\n          name = Normal\n          colPos = 0\n        }\n"
        . "        2 {\n          name = Right\n          colPos = 2\n        }\n      }\n    }\n  }\n}\n",
]]]);
$uids['layoutPage'] = $dataHandler->substNEWwithIDs['NEWlayoutPage'];
// The layout is only offered once the page has the TSconfig
GeneralUtility::makeInstance(CacheManager::class)->getCache('runtime')->flush();
$process(['pages' => [$uids['layoutPage'] => ['backend_layout' => 'pagets__stageAndColumns']]]);
$dataHandler = $process(['tt_content' => [
    'NEWstage' => ['pid' => $uids['layoutPage'], 'colPos' => 1, 'CType' => 'header', 'header' => 'Welcome', 'hidden' => 0],
    'NEWnormal' => ['pid' => $uids['layoutPage'], 'colPos' => 0, 'CType' => 'textmedia', 'header' => 'About us', 'bodytext' => '<p>Some text next to an image.</p>', 'hidden' => 0],
    'NEWright' => ['pid' => $uids['layoutPage'], 'colPos' => 2, 'CType' => 'menu_subpages', 'header' => 'Subpages', 'hidden' => 0],
]]);
$uids['textmedia'] = $dataHandler->substNEWwithIDs['NEWnormal'];

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
$dataHandler = $process(['sys_template' => ['NEWtemplate' => [
    'pid' => 1,
    'title' => 'Site package',
    'root' => 1,
    'clear' => 3,
    'constants' => $fixture('constants.typoscript'),
    'config' => $fixture('setup.typoscript'),
]]]);
$uids['rootTemplate'] = $dataHandler->substNEWwithIDs['NEWtemplate'];
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
    'dataProcSite' => ['title' => 'SiteProcessor', 'snippet' => 'SiteProcessor', 'CType' => 'myextension_dataprocsite'],
    'dataProcSiteLanguage' => ['title' => 'SiteLanguageProcessor', 'snippet' => 'SiteLanguageProcessor', 'CType' => 'myextension_dataprocsitelanguage'],
    'dataProcSplit' => [
        'title' => 'SplitProcessor',
        'snippet' => 'SplitProcessor',
        'CType' => 'myextension_dataprocsplit',
        'header_link' => 'https://docs.typo3.org/m/typo3/reference-typoscript/main/en-us/DataProcessing/SplitProcessor.html',
    ],
    'dataProcCsv' => [
        'title' => 'CommaSeparatedValueProcessor',
        'snippet' => 'CommaSeparatedValueProcessor',
        'CType' => 'myextension_dataproccsv',
        'bodytext' => implode("\n", array_map(
            static fn(int $row): string => implode(',', array_map(
                static fn(int $column): string => "\"This is row $row column $column\"",
                range(1, 3)
            )),
            range(1, 3)
        )),
        // The example keeps two of the three columns
        'imagecols' => 2,
        'tx_myextension_separator' => ',',
    ],
    'dataProcMenu' => ['title' => 'MenuProcessor', 'snippet' => 'MenuProcessor', 'CType' => 'myextension_dataprocmenu'],
    'dataProcLanguageMenu' => ['title' => 'LanguageMenuProcessor', 'snippet' => 'LanguageMenuProcessor', 'CType' => 'myextension_dataproclang'],
    'dataProcFiles' => ['title' => 'FilesProcessor', 'snippet' => 'FilesProcessor', 'CType' => 'myextension_dataprocfiles', 'images' => 2],
    'dataProcGallery' => [
        'title' => 'GalleryProcessor',
        'snippet' => 'GalleryProcessor',
        'CType' => 'myextension_dataprocgallery',
        'images' => 3,
        // The example takes the border from this field
        'imageborder' => 1,
    ],
    // The TypoScript of this example comes with the set of the example
    // extension in Documentation/CodeSnippets/my_extension
    'dataProcDb' => ['title' => 'DatabaseQueryProcessor', 'CType' => 'myextension_speakers'],
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
// The folder with the speakers that the database query example reads from
// the field "pages" of its content element
$dataHandler = $process(['pages' => [
    'NEWspeakers' => ['pid' => $uids['dataProcDb'], 'title' => 'Speakers', 'doktype' => 254, 'hidden' => 0],
]]);
$uids['speakers'] = $dataHandler->substNEWwithIDs['NEWspeakers'];
$examples['dataProcDb']['pages'] = (string)$uids['speakers'];
// The content element types exist only in the TypoScript of the examples,
// not in the TCA, so the DataHandler would refuse them
$contentConnection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tt_content');
$setup = "page = PAGE\npage.10 < styles.content.get\n\n"
    // TYPO3 refuses a path with "..", like the one in $documentation
    . 'lib.contentElement.templateRootPaths.200 = ' . realpath($documentation . 'CodeSnippets/DataProcessing/Template') . "/\n";
// Plain images for the examples with files, drawn here, so that nobody
// else holds a right to them
$storage = GeneralUtility::makeInstance(StorageRepository::class)->getDefaultStorage();
// In a folder below user_upload, so the root of fileadmin, which the file
// list screenshot shows, stays the same
$folder = $storage->createFolder('data-processors', $storage->getFolder('user_upload'));
$files = [];
foreach ([[0x1f6feb, 'Blue circle'], [0x2da44e, 'Green circle'], [0xfb8500, 'Orange circle']] as $i => [$color, $title]) {
    $image = imagecreatetruecolor(800, 600);
    imagefill($image, 0, 0, imagecolorallocate($image, 0xf6, 0xf8, 0xfa));
    imagefilledellipse($image, 400, 300, 400, 400, imagecolorallocate($image, $color >> 16, ($color >> 8) & 0xff, $color & 0xff));
    $path = Environment::getVarPath() . '/circle-' . $i . '.png';
    imagepng($image, $path);
    $files[] = [$storage->addFile($path, $folder, strtolower(str_replace(' ', '-', $title)) . '.png'), $title];
}
// The speakers of the example extension, the first one with a photo: a
// drawn silhouette
$image = imagecreatetruecolor(600, 600);
imagefill($image, 0, 0, imagecolorallocate($image, 0xdd, 0xe3, 0xea));
$grey = imagecolorallocate($image, 0x8c, 0x95, 0x9f);
imagefilledellipse($image, 300, 230, 220, 220, $grey);
imagefilledellipse($image, 300, 600, 440, 380, $grey);
imagepng($image, Environment::getVarPath() . '/speaker.png');
$photo = $storage->addFile(Environment::getVarPath() . '/speaker.png', $folder, 'speaker.png');
$speakers = [
    ['Alex Example', 'Example Agency', '<p>Alex builds extensions for <strong>public institutions</strong>.</p>'],
    ['Robin Sample', 'Sample Ltd', '<p>Robin maintains the TypoScript of several large sites.</p>'],
    ['Kai Muster', 'Muster AG', '<p>Kai teaches editors how to work with content elements.</p>'],
];
$dataHandler = $process(['tx_myextension_speaker' => array_combine(
    array_map(static fn(int $i): string => 'NEWspeaker' . $i, array_keys($speakers)),
    array_map(static fn(array $speaker): array => [
        'pid' => $uids['speakers'], 'name' => $speaker[0], 'company' => $speaker[1], 'bio' => $speaker[2],
    ], $speakers)
)]);
$process([
    'sys_file_reference' => ['NEWphoto' => [
        'pid' => $uids['speakers'],
        'uid_local' => $photo->getUid(),
        'uid_foreign' => $dataHandler->substNEWwithIDs['NEWspeaker0'],
        'tablenames' => 'tx_myextension_speaker',
        'fieldname' => 'photo',
    ]],
    'tx_myextension_speaker' => [$dataHandler->substNEWwithIDs['NEWspeaker0'] => ['photo' => 'NEWphoto']],
]);
foreach ($examples as $key => $example) {
    $contentConnection->insert('tt_content', array_merge(
        array_diff_key($example, ['title' => true, 'snippet' => true, 'images' => true]),
        ['pid' => $uids[$key], 'colPos' => 0, 'tstamp' => time(), 'crdate' => time(), 'image' => $example['images'] ?? 0]
    ));
    $content = (int)$contentConnection->lastInsertId();
    foreach (array_slice($files, 0, $example['images'] ?? 0) as $i => [$file, $title]) {
        $contentConnection->insert('sys_file_reference', [
            'pid' => $uids[$key],
            'uid_local' => $file->getUid(),
            'uid_foreign' => $content,
            'tablenames' => 'tt_content',
            'fieldname' => 'image',
            'sorting_foreign' => $i + 1,
            'title' => $title,
            'description' => 'An image drawn for this example',
            'tstamp' => time(),
            'crdate' => time(),
        ]);
    }
    if (isset($example['snippet'])) {
        $setup .= "\n" . $snippet('CodeSnippets/DataProcessing/TypoScript/' . $example['snippet'] . '.typoscript');
    }
}
$configuration['rootPageId'] = $uids['dataProcessors'];
$configuration['base'] = 'http://localhost:8080/data-processors/';
$configuration['dependencies'] = ['typo3/fluid-styled-content', 'myvendor/my-extension'];
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

// The color palette example, last so that the uids above stay the same: a
// folder whose TSconfig holds the colors and palettes of the documentation
// and assigns a palette to the color field of a track of the example
// extension. A standard page does not allow the records of that table.
$dataHandler = $process(['pages' => ['NEWcolorPalettes' => [
    'pid' => 1,
    'title' => 'Color palettes',
    'doktype' => 254,
    'hidden' => 0,
    'TSconfig' => $snippet('PageTsconfig/_syntax2.typoscript') . "\n"
        . $snippet('PageTsconfig/_basicSyntax.typoscript') . "\n"
        . "TCEFORM.tx_myextension_track.color.colorPalette = key_colors\n",
]]]);
$uids['colorPalettes'] = $dataHandler->substNEWwithIDs['NEWcolorPalettes'];
$dataHandler = $process(['tx_myextension_track' => ['NEWtrack' => [
    'pid' => $uids['colorPalettes'],
    'title' => 'Main hall',
    'color' => '#ff8700',
]]]);
$uids['track'] = $dataHandler->substNEWwithIDs['NEWtrack'];

// The function menu of the page module, which only offers its views on a
// page with a translation: a site of its own with a second language, so
// that the other sites keep a single language
$dataHandler = $process(['pages' => [
    'NEWfunctionMenu' => ['pid' => 0, 'title' => 'Translated page', 'is_siteroot' => 1, 'hidden' => 0],
]]);
$uids['functionMenu'] = $dataHandler->substNEWwithIDs['NEWfunctionMenu'];
$configuration['rootPageId'] = $uids['functionMenu'];
$configuration['base'] = 'http://localhost:8080/translated-page/';
unset($configuration['dependencies']);
GeneralUtility::makeInstance(SiteWriter::class)->write('translated-page', $configuration);
$dataHandler = GeneralUtility::makeInstance(DataHandler::class);
$dataHandler->start([], ['pages' => [$uids['functionMenu'] => ['localize' => 2]]]);
$dataHandler->process_cmdmap();
if ($dataHandler->errorLog !== []) {
    throw new RuntimeException(implode("\n", $dataHandler->errorLog));
}

// The preview preset example: the module shows the frontend of the page, so
// it goes below the data processors, the only site that renders content.
// Hidden in menus, so that the menu examples stay the same.
$dataHandler = $process(['pages' => ['NEWpreviewPreset' => [
    'pid' => $uids['dataProcessors'],
    'title' => 'Preview preset',
    'hidden' => 0,
    'nav_hide' => 1,
    'TSconfig' => $snippet('PageTsconfig/Mod/_new.typoscript'),
]]]);
$uids['previewPreset'] = $dataHandler->substNEWwithIDs['NEWpreviewPreset'];
$process(['tt_content' => ['NEWpreviewContent' => [
    'pid' => $uids['previewPreset'],
    'CType' => 'text',
    'header' => 'Welcome',
    'bodytext' => '<p>Some text to preview at different screen sizes.</p>',
]]]);

// The custom data processor example: a content element with two categories,
// which the processor of the example extension reads through the MM table.
// Hidden in menus, so that the menu examples stay the same.
$dataHandler = $process([
    'pages' => ['NEWcustomProcessor' => [
        'pid' => $uids['dataProcessors'],
        'title' => 'CustomCategoryProcessor',
        'hidden' => 0,
        'nav_hide' => 1,
    ]],
    'sys_category' => [
        'NEWcategoryTypoScript' => ['pid' => $uids['dataProcessors'], 'title' => 'TypoScript'],
        'NEWcategoryFluid' => ['pid' => $uids['dataProcessors'], 'title' => 'Fluid'],
    ],
]);
$uids['customProcessor'] = $dataHandler->substNEWwithIDs['NEWcustomProcessor'];
$contentConnection->insert('tt_content', [
    'pid' => $uids['customProcessor'],
    'colPos' => 0,
    'CType' => 'myextension_dataproccustom',
    'categories' => 2,
    'tstamp' => time(),
    'crdate' => time(),
]);
$content = (int)$contentConnection->lastInsertId();
foreach (['NEWcategoryTypoScript', 'NEWcategoryFluid'] as $i => $category) {
    GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('sys_category_record_mm')->insert('sys_category_record_mm', [
        'uid_local' => $dataHandler->substNEWwithIDs[$category],
        'uid_foreign' => $content,
        'tablenames' => 'tt_content',
        'fieldname' => 'categories',
        'sorting_foreign' => $i + 1,
    ]);
}
$setup .= "\n" . $snippet('CodeSnippets/DataProcessing/TypoScript/CustomCategoryProcessor.typoscript');
file_put_contents(Environment::getConfigPath() . '/sites/data-processors/setup.typoscript', $setup);

// The GIFBUILDER example: a content element that renders the image of the
// example. Hidden in menus, so that the menu examples stay the same.
$dataHandler = $process(['pages' => ['NEWgifbuilder' => [
    'pid' => $uids['dataProcessors'],
    'title' => 'GIFBUILDER',
    'hidden' => 0,
    'nav_hide' => 1,
]]]);
$uids['gifbuilder'] = $dataHandler->substNEWwithIDs['NEWgifbuilder'];
$contentConnection->insert('tt_content', [
    'pid' => $uids['gifbuilder'],
    'colPos' => 0,
    'CType' => 'myextension_gifbuilder',
    'tstamp' => time(),
    'crdate' => time(),
]);
$setup .= "\n" . $snippet('Gifbuilder/_calc.typoscript') . "tt_content.myextension_gifbuilder < lib.example\n";

// The GIFBUILDER examples that mask an image onto the background image, each
// on a page of its own. The snippets read the images from fileadmin. Keyed
// by the target, since one source is copied twice.
foreach (
    [
        'backimage.jpg' => 'Backimage.jpg',
        'overlay.png' => 'Logo.png',
        'mask.png' => 'Mask_i.png',
        // The image that the shadow examples put a shadow under
        'image.jpg' => 'Backimage.jpg',
    ] as $target => $source
) {
    copy($documentation . 'Images/ThirdParty/GifbuilderExamples/' . $source, Environment::getPublicPath() . '/fileadmin/' . $target);
}
// The background image of the first shadow example: white, with a gray
// shadow that fades out towards its right and bottom edges
$image = imagecreatetruecolor(320, 240);
imagefill($image, 0, 0, imagecolorallocate($image, 0xff, 0xff, 0xff));
for ($i = 0; $i < 10; $i++) {
    $gray = 0x99 + (int)((0xff - 0x99) * $i / 10);
    imagerectangle($image, 10 + $i, 10 + $i, 319 - $i, 239 - $i, imagecolorallocate($image, $gray, $gray, $gray));
}
imagefilledrectangle($image, 20, 20, 309, 229, imagecolorallocate($image, 0x99, 0x99, 0x99));
imagepng($image, Environment::getPublicPath() . '/fileadmin/shadow.png');
$gifbuilderExamples = [
    'gifbuilderMask' => ['GIFBUILDER mask', 'myextension_gifbuildermask', '_maskingSemiTransparent', 'lib.test'],
    'gifbuilderBoxes' => ['GIFBUILDER boxes', 'myextension_gifbuilderboxes', '_creatingSemiTransparent', 'lib.header'],
    // Both define lib.shadowImage, which each content element copies, and
    // which is cleared before the next snippet
    'gifbuilderShadow1' => ['GIFBUILDER shadow 1', 'myextension_gifbuildershadow1', '_variant1Setup', 'lib.shadowImage'],
    'gifbuilderShadow2' => ['GIFBUILDER shadow 2', 'myextension_gifbuildershadow2', '_variant2Setup', 'lib.shadowImage'],
];
foreach ($gifbuilderExamples as $key => [$title, $cType, $snippetName, $object]) {
    $dataHandler = $process(['pages' => ['NEW' . $key => [
        'pid' => $uids['dataProcessors'],
        'title' => $title,
        'hidden' => 0,
        'nav_hide' => 1,
    ]]]);
    $uids[$key] = $dataHandler->substNEWwithIDs['NEW' . $key];
    $contentConnection->insert('tt_content', [
        'pid' => $uids[$key],
        'colPos' => 0,
        'CType' => $cType,
        'tstamp' => time(),
        'crdate' => time(),
    ]);
    $setup .= "\n$object >\n" . $snippet('Gifbuilder/_codesnippets/' . $snippetName . '.typoscript') . "tt_content.$cType < $object\n";
}
file_put_contents(Environment::getConfigPath() . '/sites/data-processors/setup.typoscript', $setup);
file_put_contents(Environment::getConfigPath() . '/sites/data-processors/constants.typoscript', $snippet('Gifbuilder/_codesnippets/_variant2Constants.typoscript'));

// Sites of their own for the page tree of a second administrator, whose user
// TSconfig changes the page tree: they have the names and domains an example
// would have, and are hidden from "admin", so that the page tree of the other
// screenshots stays the same. The second administrator has the password of
// "admin", which run.sh sets.
$pageConnection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('pages');
$otherRoots = array_map('intval', $pageConnection->select(['uid'], 'pages', ['pid' => 0, 'deleted' => 0])->fetchFirstColumn());
$exampleSites = [
    'company-website' => ['Company website', 'https://www.example.org/'],
    'online-shop' => ['Online shop', 'https://shop.example.org/'],
    'intranet' => ['Intranet', 'https://intranet.example.org/'],
];
$exampleRoots = [];
$siteConfiguration = GeneralUtility::makeInstance(SiteFinder::class)->getSiteByRootPageId(1)->getConfiguration();
// The DataHandler puts a new page first, so the last one is created first
foreach (array_reverse($exampleSites) as $identifier => [$title, $base]) {
    $dataHandler = $process(['pages' => ['NEWexample' => ['pid' => 0, 'title' => $title, 'is_siteroot' => 1, 'hidden' => 0]]]);
    $exampleRoots[] = $dataHandler->substNEWwithIDs['NEWexample'];
    $siteConfiguration['rootPageId'] = end($exampleRoots);
    $siteConfiguration['base'] = $base;
    GeneralUtility::makeInstance(SiteWriter::class)->write($identifier, $siteConfiguration);
}
$userConnection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('be_users');
$adminTsConfig = (string)$userConnection->select(['TSconfig'], 'be_users', ['username' => 'admin'])->fetchOne();
$userConnection->update(
    'be_users',
    ['TSconfig' => $adminTsConfig . "\noptions.hideRecords.pages = " . implode(',', $exampleRoots) . "\n"],
    ['username' => 'admin']
);
$process(['be_users' => ['NEWpageTree' => [
    'pid' => 0,
    'username' => 'pagetree',
    'password' => 'Screenshots-2026!',
    'admin' => 1,
    // New users are disabled by default
    'disable' => 0,
    'TSconfig' => $snippet('UserTsconfig/_codesnippets/_showDomainNameWithTitle.tsconfig')
        . 'options.hideRecords.pages = ' . implode(',', $otherRoots) . "\n",
]]]);

// The uids differ between TYPO3 versions, so screenshots.mjs reads them here
GeneralUtility::mkdir_deep(Environment::getVarPath());
file_put_contents(Environment::getVarPath() . '/screenshot-records.json', json_encode($uids, JSON_PRETTY_PRINT) . "\n");
