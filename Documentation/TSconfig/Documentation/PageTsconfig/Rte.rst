.. include:: /Includes.rst.txt
.. index::
   RTE
   Rich text editor
   see: Rich text editor; RTE
.. _pageTsRte:

===
RTE
===

The `RTE` prefix key is used for configuration of the Rich Text Editor.
Please refer to the :ref:`RTE chapter <t3coreapi:rte>` in Core API document
for more general information on RTE configuration and data processing.

The order in which configuration for the RTE is loaded is:

1. preset defined for a specific field via PageTS
2. richtextConfiguration defined for a specific field via TCA
3. general preset defined via PageTS
4. default

The full property path building is a bit more complex than for other
property segments. The goal is that global options can be set that can
also be overridden in more specific situations:

Configure all RTE for all tables, fields and types:
    `RTE.default`

Configure RTE for a specific field in a table
    `RTE.config.[tableName].[fieldName]`

Configure RTE for a specific field in a table for a specific :ref:`record type <t3tca:types>`
    `RTE.config.[tableName].[fieldName].types.[type]`

Consider the following Page TSconfig examples:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/page.tsconfig

   # Disable all RTEs
   RTE.default.disabled = 1

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/page.tsconfig

   # Disable all RTEs
   RTE.default.disabled = 1
   # Enable RTE for the tt_content bodytext field only
   RTE.config.tt_content.bodytext.disabled = 0

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/page.tsconfig

   # Disable all RTEs
   RTE.default.disabled = 1
   # Enable RTE for the tt_content bodytext field only
   RTE.config.tt_content.bodytext.disabled = 0
   # But disable RTE for tt_content bodytext again if the record type is "text"
   RTE.config.tt_content.bodytext.types.text.disabled = 1

Properties
==========

.. contents::
   :depth: 2
   :local:

.. index:: RTE; disable

disabled
--------

:aspect:`Datatype`
    boolean

:aspect:`Description`
    If set, the editor is disabled. This option is evaluated in :php:`\TYPO3\CMS\Backend\Form\FormEngine`
    where it determines whether the RTE is rendered or not. Note that a backend user can also ultimately
    disable RTE's in his user settings.

.. index::
   RTE; Configuration
   RTE; config


buttons
-------



.. _buttons-link-options-removeitems:

buttons.link.options.removeItems
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         buttons.link.options.removeItems

   Data type
         list of strings

   Description
         List of tab items to remove from the dialog of the link button.
         Possible tab items are: page, file, url, email, folder, telephone.

         Note: More tabs may be provided by extensions.



.. _buttons-link-targetselector-disabled:

buttons.link.targetSelector.disabled
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         buttons.link.targetSelector.disabled

   Data type
         boolean

   Description
         If set, the selection of link target is removed from the link
         insertion/update dialog.

         Default : 0



.. _buttons-link-pageidselector-enabled:

buttons.link.pageIdSelector.enabled
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         buttons.link.pageIdSelector.enabled

   Data type
         boolean

   Description
         If set, the specification of a page id, without using the page tree,
         is enabled in the link insertion/update dialog.

         Note: This feature is intended for authors who have to deal with a
         very large page tree. Note that the feature is disabled by default.

         Default: 0



.. _buttons-link-queryparametersselector-enabled:

buttons.link.queryParametersSelector.enabled
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         buttons.link.queryParametersSelector.enabled

   Data type
         boolean

   Description
         If set, an additional field is enabbled in the link insertion/update
         dialogue allowing authors to specify query parameters to be added on
         the link

         Default: 0



.. _buttons-link-relattribute-enabled:

buttons.link.relAttribute.enabled
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         buttons.link.relAttribute.enabled

   Data type
         boolean

   Description
         If set, an additional field is enabled in the link insertion/update
         dialogue allowing authors to specify a rel attribute to be added to
         the link.

         Default: 0



.. _buttons-link-properties-class-allowedclasses:

buttons.link.properties.class.allowedClasses
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         buttons.link.properties.class.allowedClasses

   Data type
         list of id-strings

   Description
         Classes available in the Insert/Modify link dialogue.





.. _buttons-link-properties-class-required:

buttons.link.properties.class.required
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         buttons.link.properties.class.required

   Data type
         boolean

   Description
         If set, a class must be selected for any link. Therefore, the empty
         option is removed from the class selector.



.. _buttons-link-type-properties-class-required:

buttons.link.[ *type* ].properties.class.required
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         buttons.link.[ *type* ].properties.class.required

   Data type
         boolean

   Description
         If set, a class must be selected for any link of the given type.
         Therefore, the empty option is removed from the class selector.
         Possible types are: page, file, url, email, folder, telephone.





.. _buttons-link-properties-target-default:

buttons.link.properties.target.default
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         buttons.link.properties.target.default

   Data type
         string

   Description
         This sets the default target for new links in the RTE.


.. _buttons-link-type-properties-target-default:

buttons.link.[ *type* ].properties.target.default
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         buttons.link.[ *type* ].properties.target.default

   Data type
         string

   Description
         Specifies a default target for links of the given type.
         Possible types are: page, file, url, mail, spec. More types may be
         provided by extensions.





config
------

.. index::
   RTE; Content language direction
   RTE config; contentsLanguageDirection

contentsLanguageDirection
~~~~~~~~~~~~~~~~~~~~~~~~~


:aspect:`Datatype`
    :typoscript:`rtl` or :typoscript:`ltr`

:aspect:`Description`

    The configuration `contentsLangDirection` of the ckeditor is used to define the
    direction of the content. It is filled by the direction defined in the site
    language of the current element.

    As fallback the following page TsConfig configuration can be used:

    ..  code-block:: typoscript
        :caption: EXT:my_sitepackage/Configuration/page.tsconfig

        # always use right to left
        RTE.config.contentsLanguageDirection = rtl

        # except for the following language:
        [siteLanguage("locale") == "en_US"]
            RTE.config.contentsLanguageDirection = ltr
        [END]

.. index::
   RTE; Server processing
   RTE; proc

proc
----

The `proc` section allows customization of the server processing of the content, see
the :ref:`transformation section <t3coreapi:transformations-tsconfig>` of the RTE chapter in
the core API document for more general information on server processing.

The `proc` properties are in :code:`\TYPO3\CMS\Core\Html\RteHtmlParser` and
are universal for all RTEs. The main objective of these options is to allow for minor
configuration of the transformations. For instance you may disable the mapping between
:code:`<b>-<strong>` and :code:`<i>-<em>` tags which is done by the `ts_transform` transformation.

Notice how many properties relate to specific transformations only! Also notice that the meta-transformations
`ts_css` imply other transformations.

This means that options limited to `ts_transform` will also work for `ts_css` of course.


.. index::
   RTE; Classes allowed

allowedClasses
~~~~~~~~~~~~~~

:aspect:`Datatype`
    string with comma separated values

:aspect:`Description`
    Applies for `ts_transform` and `css_transform` only.

    Direction: From RTE to database, saving a record.

    Allowed general class names when content is stored in database. Could be a list matching the
    number of defined classes you have. Class names are case insensitive.

    This might be a really good idea to do, because when pasting in content from MS word for
    instance there are a lot of `<SPAN>` and `<P>` tags which may have class names in. So by
    setting a list of allowed classes, such foreign class names are removed.

    If a class name is not found in this list, the default is to remove the class.


.. index::
   RTE; HTML tags allowed
   RTE; Tags allowed

allowTags
~~~~~~~~~

:aspect:`Datatype`
    string with comma separated values

:aspect:`Description`
    Applies for `ts_transform` and `css_transform` only.

    Tags to allow. Notice, this list is  *added* to the default list,
    which you see here:

    b,i,u,a,img,br,div,center,pre,font,hr,sub,sup,p,strong,em,li,ul,ol,blo
    ckquote,strike,span

.. index::
   RTE; Tags outside paragraphs

allowTagsOutside
~~~~~~~~~~~~~~~~

:aspect:`Datatype`
    string with comma separated values

:aspect:`Description`
    Applies for `ts_transform` and `css_transform` only.

    Enter tags which are allowed outside of `<P>` and `<DIV>` sections when converted back to database.

:aspect:`Default`
    address, article, aside, blockquote, footer, header, hr, nav, section, div

:aspect:`Example`
    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/page.tsconfig

       # Allow only hr tags outside of p and div
       RTE.default.proc.allowTagsOutside = hr

.. index::
   RTE; block elements

blockElementList
~~~~~~~~~~~~~~~~

:aspect:`Datatype`
    string with comma separated values

:aspect:`Description`
    Comma-separated list of uppercase tags (e.g. :code:`P,HR`) that overrides the list of HTML
    elements that will be treated as block elements by the RTE transformations.

.. index::
   RTE; tags denyed

denyTags
~~~~~~~~

:aspect:`Datatype`
    string with comma separated values

:aspect:`Description`
    Applies for `ts_transform` and `css_transform` only.

    Tags from above list to disallow.


.. index::
   RTE; HTMLparser DB entry

entryHTMLparser_db
~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
    boolean / :ref:`HTMLparser <t3tsref:htmlparser>`

:aspect:`Description`
    Applies to all kinds of processing.

    Allows to enable / disable the :ref:`HTMLparser <t3tsref:htmlparser>` *before* the
    content is processed with the predefined processors (e.g. ts_images or ts_transform).

.. index::
   RTE; HTMLparser RTE entry

entryHTMLparser_rte
~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
    boolean / :ref:`HTMLparser <t3tsref:htmlparser>`

:aspect:`Description`
    Applies to all kinds of processing.

    Allows to enable / disable the :ref:`HTMLparser <t3tsref:htmlparser>` *before* the
    content is processed with the predefined processors (e.g. ts_images or ts_transform).


.. index::
   RTE; HTMLparser DB exit

exitHTMLparser_db
~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
    boolean / :ref:`HTMLparser <t3tsref:htmlparser>`

:aspect:`Description`
    Applies to all kinds of processing.

    Allows to enable / disable the :ref:`HTMLparser <t3tsref:htmlparser>` *after* the
    content is processed with the predefined processors (e.g. ts_images or ts_transform).


.. index::
   RTE; HTMLparser RTE exit

exitHTMLparser_rte
~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
    boolean / :ref:`HTMLparser <t3tsref:htmlparser>`

:aspect:`Description`
    Applies to all kinds of processing.

    Allows to enable / disable the :ref:`HTMLparser <t3tsref:htmlparser>` *after* the
    content is processed with the predefined processors (e.g. ts_images or ts_transform).


.. index::
   RTE; HTMLparser DB
.. _pageTsRteProcHtmlParserDb:

HTMLparser_db
~~~~~~~~~~~~~

:aspect:`Datatype`
    :ref:`HTMLparser <t3tsref:htmlparser>`

:aspect:`Description`
    Applies for `ts_transform` and `css_transform` only.

    These are additional options to the HTML parser calls which strips of tags when the content is prepared
    *from the RTE to the database*, saving a record. It is possible to configure additional rules like which other
    tags to preserve, which attributes to preserve, which values are allowed as attributes of a certain tag etc.

    For the detailed list of properties, see the :ref:`section of the TypoScript reference <t3tsref:htmlparser>`.

    .. note::

       This configuration is similar in frontend TypoScript and Page TSconfig.
       This is why single properties can be looked up in the TypoScript reference.

       Also note the :ref:`HTMLparser <t3tsref:htmlparser>` options :code:`keepNonMatchedTags`
       and :code:`htmlSpecialChars` are *not* observed. They are preset internally.

Sanitization
''''''''''''

.. versionadded:: 9.5.29/10.4.19

An HTML sanitizer is available to sanitize and remove XSS from markup. It
strips tags, attributes and values that are not explicitly allowed.

Sanitization for persisting data is disabled by default and can be enabled
globally by using the corresponding feature flag in the :ref:`configuration
files <t3coreapi:configuration-files>`
:file:`config/system/settings.php` or
:file:`config/system/additional.php`:

.. code-block:: php

   $GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.backend.htmlSanitizeRte'] = true;

It can then be disabled per use case with a custom processing instruction:

.. code-block:: yaml
   :caption: EXT:site_package/Configuration/Processing.yaml

   processing:
     allowTags:
       # ...
     HTMLparser_db:
       # ...
       # disable individually per use case
       htmlSanitize: false

       # This is the default configuration,
       # the feature flag has to be enabled
       htmlSanitize:
         # use default builder as configured in
         # $GLOBALS['TYPO3_CONF_VARS']['SYS']['htmlSanitizer']
         build: default


.. index::
   RTE; HTMLparser RTE

HTMLparser_rte
~~~~~~~~~~~~~~

:aspect:`Datatype`
    :ref:`HTMLparser <t3tsref:htmlparser>`

:aspect:`Description`
    Applies for `ts_transform` and `css_transform` only.

    These are additional options to the HTML parser calls which strips of tags when the content is prepared
    *from the database to the RTE* rendering. It is possible to configure additional rules like which other
    tags to preserve, which attributes to preserve, which values are allowed as attributes of a certain tag etc.

    For the detailed list of properties, see the :ref:`section of the TypoScript reference <t3tsref:htmlparser>`.

    .. note::

       This configuration is similar in frontend TypoScript and Page TSconfig.
       This is why single properties can be looked up in the TypoScript reference.

       Also note the :ref:`HTMLparser <t3tsref:htmlparser>` options :code:`keepNonMatchedTags`
       and :code:`htmlSpecialChars` are *not* observed. They are preset internally.

.. index::
   RTE; Transformations overruled

overruleMode
~~~~~~~~~~~~

:aspect:`Datatype`
    Comma list of RTE transformations

:aspect:`Description`
    This can overrule the RTE transformation set from TCA. Notice, this is a  *comma list* of transformation keys.
