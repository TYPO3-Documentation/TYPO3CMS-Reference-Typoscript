:navigation-title: fluid_styled_content
..  include:: /Includes.rst.txt
..  _using-fluid-styled-content:

============================
Using fluid\_styled\_content
============================

It is worth taking a deeper look at the TypoScript of the system extension
:composer:`typo3/cms-fluid-styled-content`. It comes with
more than 900 lines of TypoScript code containing definitions for each type of
content element.

Although it may seem daunting, it is very instructive to review all this code,
as there is much to learn by example. To view the raw code, place yourself on
the root page of your website and move to the
:guilabel:`Sites > TypoScript` module. Then
choose the submodule :guilabel:`Included TypoScript` from the drop-down.

You should see a list of all used TypoScript records and files and how they possibly
include one another. All TypoScript is evaluated by TYPO3 CMS from top to
bottom.

..  figure:: /Images/ManualScreenshots/IncludedTypoScript.png
    :alt: Screenshot of the module Sites > TypoScript > Included TypoScript

    Click on the :guilabel:`{ }`,  "show code", button to see the code

With a click on the :guilabel:`{ }`,  "show code", button, you can view the content
of that TypoScript file.

As the TypoScript is split up in several files you can also use the
:guilabel:`{ + }`,  "show resolved code", button to show the code including all
its includes.

You will see that the set `set:typo3/fluid-styled-content` adds rendering
definitions for all
content elements. When rendering special content like file relations or menus
the concept of data processors is used. You can find out more about data
processors in the :doc:`manual of fluid_styled_content
<typo3/cms-fluid-styled-content:Index>`.

HTML purists may find that the set `set:typo3/fluid-styled-content` generates
too much markup.

It is perfectly possible to trim down this setup or write one's own entirely.
However this is not recommended for beginners.
