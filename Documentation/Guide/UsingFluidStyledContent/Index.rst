..  include:: /Includes.rst.txt
..  _using-fluid-styled-content:

============================
Using fluid\_styled\_content
============================

It is worth taking a deeper look at "fluid\_styled\_content". It comes with
more than 600 lines of TypoScript code containing definitions for each type of
content element.

Although it may seem daunting, it is very instructive to review all this code,
as there is much to learn by example. To view the raw code, place yourself on
the root page of your website and move to the **WEB > Template** module. Then
choose the *Template Analyzer* function.

You should see a list of all used TypoScript templates and how they possibly
include one another. All templates are evaluated by TYPO3 CMS from top to
bottom.

..  include:: /Images/AutomaticScreenshots/TemplateAnalyzerStructure.rst.txt

With a click on "EXT:fluid\_styled\_content/static/", you can view the content
of that template (below the hierarchical view), first the constants, then the
setup (scroll down).

You will see that "fluid\_styled\_content" adds rendering definitions for all
content elements. When rendering special content like file relations or menus
the concept of data processors is used. You can find out more about data
processors in the :doc:`manual of fluid_styled_content
<typo3/cms-fluid-styled-content:Index>`.

HTML purists may find that "fluid\_styled\_content" generates too much markup.
It is perfectly possible to trim down this setup or write one's own entirely.
However this is not recommended for beginners.
