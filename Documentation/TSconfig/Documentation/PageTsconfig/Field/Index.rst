
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

.. figure:: ../../Images/PageTsconfigField.png
   :alt: The Page TSconfig field inside the page properties


.. _pageoverwritingandmodifyingvalues:

Overwriting and modifying values
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Properties, which are set in Page TSconfig, are valid for the page, on
which they are set, and for all pages hierarchically below. You can
overwrite and :ref:`modify <t3tssyntax:syntax-value-modification>` them
in the Page TSconfig of the same page or a subpage.

**Example:**

* Add in Page TSconfig

.. code-block:: typoscript

	RTE.default.showButtons = bold

* You get the value "bold".

* Add later in Page TSconfig

.. code-block:: typoscript

	RTE.default.showButtons := addToList(italic)

* Finally you get the value "bold,italic".


Page TSconfig itself can be overwritten by User TSconfig.

.. important::

   It is *not* possible to *modify* Page TSconfig in User
   TSconfig. Page TSconfig can only be
   :ref:`overwritten in User TSconfig <userrelationshiptovaluessetinpagetsconfig>`.


.. _pageverifyingthefinalconfiguration:

Verifying the final configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you need to check out the actual configuration for a certain branch
in the website, use the 'Web > Info' module:

.. figure:: ../../Images/PageTsconfigVerification.png
   :alt: The Page TSconfig configuration for a page when using the Info module

.. _pagesettingdefaultpagetsconfig:

Setting default Page TSconfig
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Page TSconfig is designed to be individual for branches of the page
tree. However it can be very handy to set global values that will be
initialized from the root of the tree.

In extensions this is easily done by the extension API function,
:code:`\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig()`.
In the :file:`ext_localconf.php` file you
can call it like this to set default configuration::

   \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
      RTE.default {
         showButtons = cut,copy,paste,fontstyle,fontsize,textcolor
         hideButtons = class,user,chMode
      }
   ');

This API function simply adds the content to
:code:`$TYPO3_CONF_VARS['BE']['defaultPageTSconfig']`.



Register static Page TSconfig files
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Register PageTS config files in :file:`Configuration/TCA/Overrides/pages.php` of any extension,
which will be shown in the page properties (the same way as TypoScript static templates are included)::

   \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
      'extension_name',
      'Configuration/PageTS/myPageTSconfigFile.txt',
      'My special config'
   );

.. note::

   The included files from the pages in the rootline are included after the default
   page TSconfig and before the normal TSconfig from the pages in the rootline.


