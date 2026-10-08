// Takes the backend screenshots of the TypoScript Reference from a running
// TYPO3 instance with the pages of create-records.php.
//
// Usage: node screenshots.mjs [name ...]
// Without names, all screenshots are taken. A name is the path of the image
// below Documentation/Images/ManualScreenshots, without ".png". With DUMP set,
// the HTML of each screen is also written to var/, to look up selectors.

import { readFileSync, writeFileSync } from 'node:fs';
import { chromium } from 'playwright';

const baseUrl = process.env.TYPO3_BASE_URL ?? 'http://localhost:8080';
const target = process.env.SCREENSHOT_TARGET ?? '../../Documentation/Images/ManualScreenshots';
const username = process.env.TYPO3_USERNAME ?? 'admin';
const password = process.env.TYPO3_PASSWORD ?? 'Screenshots-2026!';

const editUrl = (table, uid) => `${baseUrl}/typo3/record/edit?edit[${table}][${uid}]=edit`;
const moduleUrl = (path, id) => `${baseUrl}/typo3/module/${path}?id=${id}`;
// Space around an element, so its border does not touch the edge
const margin = 12;
// The innermost form group with the field name, which debug mode shows
const field = (name) => `.form-group:has(code:text-is("[${name}]"))`;

// The uids of the pages that create-records.php created
const { root, allowedNewTables, altLabels } =
  JSON.parse(readFileSync('../../var/screenshot-records.json', 'utf8'));

const screenshots = {
  'List/PageTsModWebListAllowedNewTables': {
    // Narrow, so that the lists do not stretch across the whole window
    width: 900,
    url: `${baseUrl}/typo3/record/new?id=${allowedNewTables}`,
    from: 'h1',
    to: '.list-group',
  },
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
  // Only the visible part of the page can be cut out. The window is tall
  // enough for most forms; an area further down is scrolled into view.
  const end = await frame.locator(screenshot.to ?? screenshot.element).last().boundingBox();
  if (end.y + end.height + margin > viewportHeight) {
    await frame.locator(screenshot.to ?? screenshot.element).last()
      .evaluate((element) => element.scrollIntoView({ block: 'center' }));
    await page.waitForTimeout(300);
  }
  // Bounding boxes are relative to the page, also for elements in the frame
  const from = await frame.locator(screenshot.from ?? screenshot.element).first().boundingBox();
  const to = await frame.locator(screenshot.to ?? screenshot.element).last().boundingBox();
  const left = Math.max(Math.min(from.x, to.x) - margin, 0);
  const top = Math.max(from.y - margin, 0);
  await page.screenshot({
    path,
    clip: {
      x: left,
      y: top,
      width: Math.max(from.x + from.width, to.x + to.width) + margin - left,
      height: to.y + to.height + margin - top,
    },
  });
  console.log(`${name}.png`);
}
await browser.close();
