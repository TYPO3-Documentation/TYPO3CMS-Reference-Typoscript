:navigation-title: Page
..  include:: /Includes.rst.txt
..  _guide-page:

================================
Configure the PAGE in TypoScript
================================

A TypoScript object of type :ref:`PAGE <t3tsref:object-type-page>` is needed
to display anything in the frontend of TYPO3.

The :typoscript:`PAGE` object is used to define a certain view of the content that was
entered in the backend.

To display an HTML representation of your content usually a Fluid template
is used to define the output of the HTML body while the `PAGE` object can
additionally define meta data for the HTML head or even the HTTP response.

By default the top level variable `page` is used to define the main
:typoscript:`PAGE` object. The following would display the empty skeleton of
an HTML page:

..  code-block:: typoscript

    page = PAGE

If this line is missing, you get the error message
"No page configured for type=0.".

See also :ref:`Troubleshooting <t3tsref:guide-troubleshooting>`.

..  contents:: Overview

..  _guide-page-body:

Displaying the page body with TypoScript
========================================

Numeral indexes on the `PAGE` object are used to output the actual content of
the page. Many integrators like to use the index 10.

As we already saw in section :ref:`guide-first-steps`, the following code outputs
"Hello World!":

..  literalinclude:: _hello-world.typoscript
    :caption: TypoScript setup

In a more common use case you want to load the page content from a Fluid
template:

..  literalinclude:: _fluid-template.typoscript
    :caption: TypoScript setup

You need at least a
:ref:`Minimal site package (see site package tutorial) <t3sitepackage:minimal-design>`
to keep your templates in its private resources folder, for example
:path:`/packages/site_package/Resources/Private/Templates`:

..  literalinclude:: _Default.html
    :caption: /packages/site_package/Resources/Private/Templates/Pages/Default.html

..  note::
    Learn more about building site packages (website themes) with TypoScript and
    Fluid templates in the :ref:`TYPO3 site package tutorial <t3sitepackage:start>`.

..  _guide-page-loading-css:

Loading CSS in TypoScript
=========================

You can write inline CSS using property
:confval:`cssInline.[array] <t3tsref:page-cssinline>`, or place your CSS file
in the public resources of your :ref:`Minimal site package <t3sitepackage:minimal-design>`:

..  literalinclude:: _css-loading.typoscript
    :caption: TypoScript setup

..  _guide-page-loading-js:

Loading JavaScript in TypoScript
================================

You can write inline JavaScript using property
:confval:`jsFooterInline.[array] <t3tsref:page-jsfooterinline>`, or place your JavaScript file
in the public resources of your :ref:`Minimal site package <t3sitepackage:minimal-design>`:

..  literalinclude:: _javascript-loading.typoscript
    :caption: TypoScript setup

..  warning::
    If you are using inline JavaScript **never** pass any unescaped user input
    directly to the JavaScript.

    See also :ref:`Preventing Cross-site scripting (XSS)
    in TypoScript <t3coreapi:security-typoscript-xss>`.

..  _guide-page-favicon:

Favicon / shortcut icon definition in the TypoScript PAGE
=========================================================

Use property :confval:`shortcutIcon <t3tsref:page-shortcuticon>` to define
the favicon:

..  literalinclude:: _favicon.typoscript
    :caption: TypoScript setup

You need to have a
:ref:`Minimal site package (see site package tutorial) <t3sitepackage:minimal-design>`
and put the favicon file in the public resources folder of that site package.
If you followed the instruction from the site package tutorial that would be
path :path:`/packages/site_package/Resources/Public/Icons`.

..  _guide-page-tracking-code:

Tracking code: Add content to the end of your page
==================================================

You can use the property :confval:`footerData.[array] <t3tsref:page-footerdata>`
to enter some HTML code just before the closing `</body>` tag:

..  literalinclude:: _tracking-code.typoscript
    :caption: TypoScript setup

..  warning::
    The HTML is output directly. Never use any unescaped user input.

    See also :ref:`Preventing Cross-site scripting (XSS)
    in TypoScript <t3coreapi:security-typoscript-xss>`.
