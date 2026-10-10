// Takes the backend screenshots of the TypoScript Reference from a running
// TYPO3 instance with the pages of create-records.php.
//
// Usage: node screenshots.mjs [name ...]
// Without names, all screenshots are taken. A name is the path of the image
// below Documentation/Images/GeneratedScreenshots, without ".png". With DUMP set,
// the HTML of each screen is also written to var/, to look up selectors.

import { readFileSync, writeFileSync } from 'node:fs';
import { chromium } from 'playwright';

const baseUrl = process.env.TYPO3_BASE_URL ?? 'http://localhost:8080';
const target = process.env.SCREENSHOT_TARGET ?? '../../Documentation/Images/GeneratedScreenshots';
const username = process.env.TYPO3_USERNAME ?? 'admin';
const password = process.env.TYPO3_PASSWORD ?? 'Screenshots-2026!';

const editUrl = (table, uid) => `${baseUrl}/typo3/record/edit?edit[${table}][${uid}]=edit`;
const moduleUrl = (path, id) => `${baseUrl}/typo3/module/${path}?id=${id}`;
// Space around an element, so its border does not touch the edge
const margin = 12;
// The innermost form group with the field name, which debug mode shows
const field = (name) => `.form-group:has(code:text-is("[${name}]"))`;

// The uids of the pages that create-records.php created
const {
  root, backendLayouts, allowedNewTables, altLabels, newRecordHideInside, newContentElementGroup,
  invalidValue, invalidValueLabel, invalidValueDisabled, singleTableView, backendLayoutExclude, description,
  headerContent, csvExport, exportButtons, noExportButtons, templatePage,
  staticIncludes, staticIncludesRecord, syntaxError, permissionsEverybody, permissionsGroup,
  permissionsGroupid, permissionsUserid, testUser, layoutPage, textmedia, rootTemplate, setsRoot, copies, copyOriginal, labels, labelLast, site,
} =
  JSON.parse(readFileSync('../../var/screenshot-records.json', 'utf8'));

// The new record wizard: the title and the lists of record types
const newRecordWizard = (id) => ({
  // Narrow, so that the lists do not stretch across the whole window
  width: 900,
  url: `${baseUrl}/typo3/record/new?id=${id}`,
  from: 'h1',
  // A list that the TSconfig empties stays in the page, but invisible
  to: '.list-group >> visible=true',
});

// The Content > Records module in single-table view, the only view with the
// Export button of the import/export extension
const exportButtonView = (id) => ({
  url: `${moduleUrl('content/records', id)}&table=tt_content`,
  window: true,
  until: '.recordlist',
});

// Opens a panel of the Active TypoScript module. The module remembers which
// panels are open, so a panel an earlier screenshot opened is open already.
const openPanel = async (frame, id) => {
  const closed = frame.locator(`#${id}[aria-expanded="false"]`);
  if (await closed.count() > 0) {
    await closed.click();
    await frame.page().waitForTimeout(500);
  }
};

// The permissions of a page and its subpages, with the page "Community"
// that the example created marked
const permissionsView = (id) => ({
  // Wide, so that the table fits next to the page tree
  width: 1600,
  url: moduleUrl('users/permissions', id),
  prepare: async (frame) => {
    await frame.locator('tr:has-text("Community")').first()
      .evaluate((row) => { row.style.outline = '3px solid #ff8700'; row.style.outlineOffset = '-3px'; });
  },
  element: '#typo3-permissionList',
});

// A page in the page tree, which is outside of the module frame
const node = (uid) => `.node[data-id="${uid}"]`;
// Opens pages in the page tree, from the top down: the tree opens only the
// path to the selected page, not the page itself
const expand = (...uids) => async (frame) => {
  for (const uid of uids) {
    // The page tree loads after the module
    await frame.page().locator(node(uid)).waitFor();
    const toggle = frame.page().locator(`${node(uid)}[aria-expanded="false"] .node-toggle`);
    if (await toggle.count() > 0) {
      await toggle.click();
      await frame.page().waitForTimeout(1000);
    }
  }
  // A clicked node would look selected
  await frame.page().evaluate(() => document.activeElement?.blur());
};

const screenshots = {
  'List/PageTsModWebListAllowedNewTables': newRecordWizard(allowedNewTables),
  'List/PagesDoktypeDifferentLabels': {
    url: editUrl('pages', altLabels),
    prepare: async (frame) => {
      // A screenshot cannot show the native list of a select, so the select
      // shows all its items as a list box instead
      await frame.locator(`${field('doktype')} select`).evaluate((select) => {
        select.size = select.querySelectorAll('option, optgroup').length + 1;
      });
    },
    element: field('doktype'),
  },
  'TypoScriptModule/ActiveTypoScript': {
    height: 900,
    url: moduleUrl('typoscript/active', root),
    prepare: async (frame) => {
      const search = frame.getByRole('searchbox');
      await search.fill('shortcut');
      await search.press('Enter');
      await frame.waitForLoadState('networkidle');
      // The search opens the matching nodes, but not the panel around them
      await openPanel(frame, 'panel-tree-heading-setup');
      // A focused search field would show its focus ring
      await frame.locator('h1').click();
    },
    window: true,
    until: '.treelist-group:has-text("shortcutIcon")',
  },
  'List/PageTsModWizardsNewRecordHideInside': newRecordWizard(newRecordHideInside),
  'List/PageTsModWizardsNewContentElementExample2': {
    url: moduleUrl('web/layout', newContentElementGroup),
    prepare: async (frame) => {
      await frame.getByRole('button', { name: 'Create new content' }).first().click();
      await frame.page().locator('typo3-backend-modal dialog[open]').waitFor();
      await frame.page().waitForTimeout(1000);
    },
    modal: true,
  },
  'List/SelectInvalidValue': {
    url: editUrl('pages', invalidValue),
    element: field('doktype'),
  },
  'List/SelectInvalidValueDifferentLabel': {
    url: editUrl('pages', invalidValueLabel),
    element: field('doktype'),
  },
  'List/SelectNoInvalidValue': {
    url: editUrl('pages', invalidValueDisabled),
    element: field('doktype'),
  },
  'List/PageTsModWebListListOnlyInSingleTableView': {
    width: 900,
    url: moduleUrl('content/records', singleTableView),
    element: '.recordlist-heading, .recordlist',
  },
  'List/BackendLayoutID': {
    width: 900,
    url: `${moduleUrl('content/records', backendLayouts)}&table=backend_layout`,
    element: '.recordlist',
  },
  'List/BackendLayoutsExcluded': {
    url: editUrl('pages', backendLayoutExclude),
    tab: 'Appearance',
    element: field('backend_layout'),
  },
  Input1: {
    url: editUrl('tt_content', headerContent),
    element: field('header'),
  },
  'List/TcaTypeGroupSuggest': {
    url: editUrl('pages', description),
    tab: 'Appearance',
    prepare: async (frame) => {
      await frame.locator(`${field('content_from_pid')} input[type="search"]`).pressSequentially('Inval');
      await frame.locator(`${field('content_from_pid')} typo3-backend-formengine-suggest-result-container:not([hidden])`)
        .waitFor();
      await frame.page().waitForTimeout(500);
    },
    from: field('content_from_pid'),
    to: `${field('content_from_pid')} typo3-backend-formengine-suggest-result-container`,
  },
  'List/TSconfigPageInput': {
    url: editUrl('pages', allowedNewTables),
    tab: 'Resources',
    element: field('TSconfig'),
  },
  'List/PageCopyWithSuffix': {
    url: moduleUrl('web/layout', root),
    prepare: expand(root, copies),
    outside: true,
    // The nodes have no space between them, a margin would cut the next one
    margin: 0,
    from: node(copies),
    to: node(copyOriginal),
  },
  'List/optionsPageTreeLabel': {
    url: moduleUrl('web/layout', root),
    prepare: expand(root, labels),
    outside: true,
    margin: 0,
    from: node(labels),
    to: node(labelLast),
  },
  'List/PagesContextMenu': {
    url: moduleUrl('web/layout', root),
    prepare: async (frame) => {
      await expand(root, copies)(frame);
      await frame.page().locator(`${node(copyOriginal)} .node-contentlabel`).click({ button: 'right' });
      await frame.page().locator('.context-menu').first().waitFor();
      // The menu focuses its first item, which would look selected
      await frame.page().waitForTimeout(500);
      await frame.page().evaluate(() => document.activeElement?.blur());
    },
    outside: true,
    // The page tree behind the menu does not belong to the example
    margin: 0,
    element: '.context-menu >> visible=true',
  },
  'List/FileListPrimaryActions': {
    url: `${baseUrl}/typo3/module/file/list?id=1:/&viewMode=list`,
    prepare: async (frame) => {
      // Marks the buttons that the option sets, as in the former screenshot
      await frame.locator('tr[data-filelist-type="file"] .btn-group').first()
        .evaluate((group) => { group.style.outline = '3px solid #ff8700'; group.style.outlineOffset = '3px'; });
    },
    window: true,
    until: 'tr[data-filelist-type="file"]',
  },
  'List/SelectFlagIcon': {
    url: `${baseUrl}/typo3/module/site/configuration/edit?site=${site}`,
    tab: 'Languages',
    prepare: async (frame) => {
      // The language record loads when it is opened
      await frame.locator('.form-irre-object .panel-button').first().click();
      await frame.locator(field('flag')).first().waitFor();
    },
    // The language record around the field is a form group as well
    element: `${field('flag')}:not(:has(.form-group))`,
  },
  'WebList/ExportDialog': {
    url: moduleUrl('content/records', csvExport),
    prepare: async (frame) => {
      await frame.locator('typo3-recordlist-record-download-button').first().click();
      await frame.page().locator('typo3-backend-modal dialog[open]').waitFor();
      await frame.page().waitForTimeout(1000);
      // The file name field has the focus, which would look selected
      await frame.page().evaluate(() => document.activeElement?.blur());
    },
    modal: true,
  },
  'WebList/WithExportButtons': exportButtonView(exportButtons),
  'WebList/NoExportButtons': exportButtonView(noExportButtons),

  'TypoScriptModule/TypoScriptRecordsOverview': {
    url: moduleUrl('web/typoscript/records-overview', root),
    window: true,
    until: 'table',
  },
  'TypoScriptModule/EditTypoScriptRecord': {
    url: moduleUrl('web/typoscript/overview', templatePage),
    window: true,
    until: 'a:has-text("Edit the whole TypoScript record")',
  },
  // Opened from the TypoScript module, as the documentation describes it, so
  // the menu shows where the form comes from
  'TypoScriptModule/ConstantAndSetupRecord': {
    url: moduleUrl('web/typoscript/overview', templatePage),
    prepare: async (frame) => {
      await frame.getByRole('link', { name: 'Edit the whole TypoScript record' }).click();
      await frame.locator(field('config')).waitFor();
    },
    window: true,
    until: field('config'),
  },
  'TypoScriptModule/IncludeTypoScriptSet': {
    url: editUrl('sys_template', staticIncludesRecord),
    tab: 'Advanced Options',
    element: field('include_static_file'),
  },
  'TypoScriptModule/IncludeTypoScriptRecords': {
    url: editUrl('sys_template', staticIncludesRecord),
    tab: 'Advanced Options',
    element: field('basedOn'),
  },
  'TypoScriptModule/ConstantEditor': {
    url: moduleUrl('web/typoscript/constant-editor', staticIncludes),
    window: true,
    // The first constant is enough to show what the editor is like
    until: ':nth-match(.input-group:visible, 1)',
  },
  // The search opens the tree down to the matching key, but not the panel
  // around it
  'TypoScriptModule/ConstantsInActiveTypoScript': {
    url: moduleUrl('typoscript/active', templatePage),
    prepare: async (frame) => {
      const search = frame.getByRole('searchbox');
      await search.fill('bodyTag');
      await search.press('Enter');
      await frame.waitForLoadState('networkidle');
      await openPanel(frame, 'panel-tree-heading-setup');
      // A focused search field would show its focus ring
      await frame.locator('h1').click();
    },
    window: true,
    until: '.treelist-group:has-text("bodyTag")',
  },
  'TypoScriptModule/ConstantsDisplayActiveTypoScript': {
    url: moduleUrl('typoscript/active', templatePage),
    prepare: async (frame) => {
      const search = frame.getByRole('searchbox');
      await search.fill('toplogo');
      await search.press('Enter');
      await frame.waitForLoadState('networkidle');
      await openPanel(frame, 'panel-tree-heading-constant');
      await frame.locator('h1').click();
    },
    window: true,
    until: '#typoscript-active-constant-ast-body .treelist-group:has-text("toplogo")',
  },
  'TypoScriptModule/IncludedTypoScript': {
    url: moduleUrl('web/typoscript/analyzer', setsRoot),
    prepare: async (frame) => {
      // Opens the site and its sets, down to the files of each set
      for (const label of ['[site:sets]', 'site:sets:sets']) {
        await frame.locator(`#template-analyzer-setup-tree-body li:has(> .row :text("${label}")) > typo3-backend-tree-node-toggle[aria-expanded="false"]`)
          .first().click();
        await frame.page().waitForTimeout(300);
      }
    },
    window: true,
    until: '#template-analyzer-setup-tree-body .treelist-group:has-text("set:typo3/fluid-styled-content-css")',
  },
  'TypoScriptModule/IncludedTypoScriptWarnings': {
    url: moduleUrl('web/typoscript/analyzer', syntaxError),
    window: true,
    until: '#template-analyzer-setup-errors-body',
  },

  'Access/PermissionsEverybody': permissionsView(permissionsEverybody),
  'Access/PermissionsGroup': permissionsView(permissionsGroup),
  'Access/PermissionsGroupid': permissionsView(permissionsGroupid),
  'Access/PermissionsUserid': permissionsView(permissionsUserid),

  'BackendLayouts/PageModule': {
    url: moduleUrl('web/layout', layoutPage),
    window: true,
    until: '.t3-grid-container',
  },
  'BackendLayouts/PageProperties': {
    url: editUrl('pages', layoutPage),
    tab: 'Appearance',
    from: field('backend_layout'),
    to: field('backend_layout_next_level'),
  },
  'Info/PageTsModWebInfoFieldDefinitions': {
    url: moduleUrl('web/info/overview', root),
    prepare: async (frame) => {
      // A screenshot cannot show the native list of a select, so the select
      // of the field sets shows all its items as a list box instead
      await frame.locator('select#pages').evaluate((select) => {
        select.size = select.options.length;
      });
    },
    from: 'label[for="pages"]',
    to: 'select#pages',
  },
  'TypoScriptModule/RootlevelFlag': {
    url: editUrl('sys_template', rootTemplate),
    tab: 'Advanced Options',
    from: field('clear'),
    to: field('root'),
  },
  'Fluidtemplate/ImageOrientation': {
    url: editUrl('tt_content', textmedia),
    tab: 'Media',
    from: '.form-section-headline:text-is("Gallery Settings")',
    to: field('imagecols'),
  },
  'Fluidtemplate/MediaHeight': {
    url: editUrl('tt_content', textmedia),
    tab: 'Media',
    from: '.form-section-headline:text-is("Media Adjustments")',
    to: field('imageborder'),
  },
  'BackendUsers/TSconfigUserInput': {
    url: editUrl('be_users', testUser),
    tab: 'Options',
    element: field('TSconfig'),
  },
  'Configuration/UserTSconfigOverview': {
    // Short, the tree of the administrator is long
    height: 700,
    url: `${baseUrl}/typo3/module/system/config?tree=beUserTsConfig`,
    prepare: async (frame) => {
      await frame.locator('li:has(> .treelist-group .treelist-label:text-is("options.")) > typo3-backend-tree-node-toggle[aria-expanded="false"]')
        .first().click();
    },
    window: true,
    until: '.t3js-collapse-states-search-tree',
  },
  'UserSettings/UserSettings': {
    url: `${baseUrl}/typo3/module/user/setup`,
    tab: 'Personalization',
    window: true,
    until: ':nth-match(.form-group:visible, 3)',
  },

};

// Hides the page tree and collapses the groups of the module menu, except
// the one of the module that is open: the screenshot shows where to find
// the module and stays narrow enough for the documentation page
const collapseNavigation = async () => {
  const hideTree = page.locator('typo3-backend-content-navigation-toggle[action="collapse"]');
  if (await hideTree.isVisible()) {
    await hideTree.click();
  }
  const groups = page.locator(
    'button[data-modulemenu-collapsible="true"][aria-expanded="true"]:not(.modulemenu-action-active)',
  );
  while (await groups.count() > 0) {
    await groups.first().click();
  }
  // The group of the module stays as an earlier screenshot left it
  const active = page.locator('button[data-modulemenu-collapsible="true"][aria-expanded="false"].modulemenu-action-active');
  if (await active.count() > 0) {
    await active.first().click();
  }
  // The clicked buttons would look selected
  await page.evaluate(() => document.activeElement?.blur());
};

// Tall, so that most forms fit without scrolling
const viewportHeight = 2000;

const browser = await chromium.launch();
const page = await browser.newPage({ viewport: { width: 1280, height: viewportHeight } });
await page.goto(`${baseUrl}/typo3/`);
await page.fill('#t3-username', username);
await page.fill('#t3-password', password);
await page.click('#t3-login-submit');
await page.waitForURL(/\/typo3\/(main|module)/);

const names = process.argv.length > 2 ? process.argv.slice(2) : Object.keys(screenshots);
for (const name of names) {
  const screenshot = screenshots[name];
  if (screenshot === undefined) {
    throw new Error(`Unknown screenshot "${name}"`);
  }
  await page.setViewportSize({
    width: screenshot.width ?? (screenshot.window ? 1000 : 1280),
    height: screenshot.height ?? viewportHeight,
  });
  await page.goto(screenshot.url);
  await page.waitForLoadState('networkidle');
  const frame = page.frame({ name: 'list_frame' });
  await frame.waitForLoadState('networkidle');
  // The backend remembers the last tab of a form, so every form opens a
  // tab of its own: General, unless the screenshot names another one
  const tab = frame.getByRole('tab', { name: screenshot.tab ?? 'General', exact: true });
  if (await tab.count() > 0) {
    await tab.click();
  }
  if (screenshot.prepare) {
    await screenshot.prepare(frame);
    await page.waitForTimeout(500);
  }
  if (screenshot.window) {
    await collapseNavigation();
  }
  // A hovered tab or button would look selected
  await page.mouse.move(0, 0);
  await page.waitForTimeout(300);
  if (process.env.DUMP) {
    writeFileSync(`../../var/${name.replaceAll('/', '_')}.html`, await frame.content());
    writeFileSync(`../../var/${name.replaceAll('/', '_')}-window.html`, await page.content());
  }
  const path = `${target}/${name}.png`;
  if (screenshot.modal) {
    // Only the dialog: the page behind it does not belong to the example
    await page.locator('typo3-backend-modal dialog[open]').screenshot({ path });
    console.log(`${name}.png`);
    continue;
  }
  if (screenshot.window) {
    // The whole backend, which also shows where the module is in the menu.
    // It ends below the element named in "until", so the image takes no more
    // room on the page than it needs.
    let clip;
    if (screenshot.until) {
      const until = await frame.locator(screenshot.until).last().boundingBox();
      const viewport = page.viewportSize();
      // A small gap only: a full margin would show a slice of the next line
      clip = { x: 0, y: 0, width: viewport.width, height: Math.min(until.y + until.height + 4, viewport.height) };
    }
    await page.screenshot({ path, clip });
    console.log(`${name}.png`);
    continue;
  }
  // The page tree and the context menu are outside of the module frame
  const scope = screenshot.outside ? page : frame;
  // Only the visible part of the page can be cut out. The window is tall
  // enough for most forms; an area further down is scrolled into view.
  const end = await scope.locator(screenshot.to ?? screenshot.element).last().boundingBox();
  if (end.y + end.height + margin > viewportHeight) {
    await scope.locator(screenshot.to ?? screenshot.element).last()
      .evaluate((element) => element.scrollIntoView({ block: 'center' }));
    await page.waitForTimeout(300);
  }
  // Bounding boxes are relative to the page, also for elements in the frame
  const from = await scope.locator(screenshot.from ?? screenshot.element).first().boundingBox();
  const to = await scope.locator(screenshot.to ?? screenshot.element).last().boundingBox();
  const space = screenshot.margin ?? margin;
  const left = Math.max(Math.min(from.x, to.x) - space, 0);
  const top = Math.max(from.y - space, 0);
  await page.screenshot({
    path,
    clip: {
      x: left,
      y: top,
      width: Math.max(from.x + from.width, to.x + to.width) + space - left,
      height: to.y + to.height + space - top,
    },
  });
  console.log(`${name}.png`);
}
await browser.close();
