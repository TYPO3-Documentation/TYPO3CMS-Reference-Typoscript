..  include:: /Includes.rst.txt


..  _guide-why-typoscript:

===============
Why TypoScript?
===============

Strictly speaking, TypoScript is a configuration language. We cannot
program with it, but can configure a TYPO3 CMS website in a
very comprehensive way. With TypoScript, we define the rendering of the
website, including navigation, generic content, and how individual
content elements are rendered on a page.

TYPO3 CMS is a content management system that clearly separates content
and design. TypoScript is the glue that joins these two together again.
TypoScript reads content which is stored in the database, prepares it
for display and then renders it in the frontend.

To render a website, we only need to define what content to display and
how it will be rendered.

* The "what" is controlled by the backend - where pages and content
  are generated.
* The "how" is controlled by TypoScript.

With TypoScript, we can define how the individual content elements are
rendered in the frontend. For example, we can use TypoScript to add a
:html:`<div>` tag to an element, or the :html:`<h1>` tag to a headline.
