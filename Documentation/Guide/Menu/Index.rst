..  include:: /Includes.rst.txt
..  _guide-menu:

=============================
Create a menu with TypoScript
=============================

Until now, we learned how the page *content* is rendered; however, the
page *navigation* is missing.

TYPO3 provides a special data processor, the :ref:`menu data processor <MenuProcessor>`
to pass data to render a menu to the Fluid template.

Configure the data processor in TypoScript:

..  literalinclude:: _menu.typoscript
    :caption: TypoScript Setup

And render the menu in your Fluid template. You need at least a
:ref:`Minimal site package (see site package tutorial) <t3sitepackage:minimal-design>`
to keep your templates in its private resources folder, for example
:path:`/packages/site_package/Resources/Private/Templates`:

..  literalinclude:: _MenuTemplate.html
    :caption: /packages/site_package/Resources/Private/Templates/Pages/Default.html

Find more examples on how to configure and render menus with TypoScript and
Fluid in chapter
:ref:`Main menu of the Site Package Tutorial <t3sitepackage:main-menu-creation>`.

You can find more examples on how to output menus of different styles, including
multi-level menus, breadcrumbs, language menus, and sitemaps in the chapter
about the :ref:`menu data processor <MenuProcessor>`.

..  note::
    Before data processors were introduced it was common to use the TypoScript
    object :ref:`HMENU <t3tsref:cobj-hmenu>` to render a menu. It is still
    possible doing so and you might see it in older examples.
