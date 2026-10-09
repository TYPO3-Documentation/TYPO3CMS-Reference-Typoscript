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
  headerContent, csvExport, exportButtons, noExportButtons, copies, copyOriginal, labels, labelLast, site,
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
      await frame.locator('#panel-tree-heading-setup').click();
      await frame.page().waitForTimeout(500);
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
