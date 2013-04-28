.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt

.. _pagethetsconfigfield:

The "TSconfig" field
^^^^^^^^^^^^^^^^^^^^

This is an example of the TSconfig field with a snippet of
configuration for the Rich Text Editor. Precisely the Rich Text Editor
is quite a good example of the usefulness of 'Page TSconfig'. The
reason is that you may need the RTE to work differently in different
parts of the website. For instance you might need to offer other
style-classes in certain parts of the website. Or some options might
need to be removed in other parts. The 'Page TSconfig' is used to
configure this.

The "TSconfig" field here is available in the tab called "Resources":

.. figure:: ../../Images/manual_html_1194c6cf.png
   :alt: The Page TSconfig field inside the page properties


.. _pageoverwritingandmodifyingvalues:

Overwriting and modifying values
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Properties, which are set in Page TSconfig, are valid for the page, on
which they are set, and for all pages hierarchically below. You can
overwrite and :ref:`modify <t3tssyntax:syntax-value-modification>` them
in the Page TSconfig of the same page or a subpage.

**Example:**

* Add in Page TSconfig::

   RTE.default.showButtons = bold

* You get the value "bold".

* Add later in Page TSconfig::

   RTE.default.showButtons := addToList(italic)

* Finally you get the value "bold,italic".


Page TSconfig itself can be overwritten by User TSconfig.

.. IMPORTANT:: It is *not* possible to *modify* Page TSconfig in User
   TSconfig. Page TSconfig can only be :ref:`overwritten in User
   TSconfig <userrelationshiptovaluessetinpagetsconfig>`.


.. _pageverifyingthefinalconfiguration:

Verifying the final configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you need to check out the actual configuration for a certain branch
in the website, use the 'Web > Info' module (provided by the extension
"info\_pagetsconfig"):

.. figure:: ../../Images/manual_html_m7ed27f1e.png
   :alt: The Page TSconfig configuration for a page when using the Info module

.. _pagesettingdefaultpagetsconfig:

Setting default Page TSconfig
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Page TSconfig is designed to be individual for branches of the page
tree. However it can be very handy to set global values that will be
initialized from the root of the tree.

In extensions this is easily done by the extension API function,
t3lib\_extMgm::addPageTSConfig(). In the (ext\_)localconf.php file you
can call it like this to set default configuration::

   t3lib_extMgm::addPageTSConfig('
       RTE.default {
           proc.preserveTables = 1
           showButtons = cut,copy,paste,fontstyle,fontsize,textcolor
           hideButtons = class,user,chMode
       }
   ');

This API function simply adds the content to
$TYPO3\_CONF\_VARS['BE']['defaultPageTSconfig'].