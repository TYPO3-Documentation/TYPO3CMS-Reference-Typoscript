..  include:: /Includes.rst.txt
..  index::
    RTE
    Rich text editor
    see: Rich text editor; RTE
..  _pageTsRte:

===
RTE
===

The `RTE` prefix key is used for configuration of the Rich Text Editor.
Please refer to the :ref:`RTE chapter <t3coreapi:rte>` in Core API document
for more general information on RTE configuration and data processing.

The order in which the configuration for the RTE is loaded is (the first one which
is set will be used, see :ref:`example <pageTsRteOverridePreset>` below):

1.  preset defined for a specific field via page TSconfig
2.  :ref:`richtextConfiguration <t3tca:columns-text-properties-richtextConfiguration>`
    defined for a specific field via TCA
3.  general preset defined via page TSconfig (:typoscript:`RTE.default.preset`)
4.  default (the preset "default", e.g. as defined by EXT:rte_ckeditor or overridden
    in :file:`ext_localconf.php`)

The full property path building is a bit more complex than for other
property segments. The goal is that global options can be set that can
also be overridden in more specific situations:

Configure all RTE for all tables, fields and types:
    `RTE.default`

Configure RTE for a specific field in a table
    `RTE.config.[tableName].[fieldName]`

Configure RTE for a specific field in a table for a specific :ref:`record type <t3tca:types>`
    `RTE.config.[tableName].[fieldName].types.[type]`

Configuring RTE via page TSconfig is general and not specific to a
particular rich-text editor. However, TYPO3 comes with EXT:rte_ckeditor, so this one
will usually be used. This page covers only the general configuration, for
more information about configuring EXT:rte_ckeditor, see the
:ref:`rte_ckeditor configuration <ext_rte_ckeditor:configuration>`.

..  contents::
    :local:

..  _pageTsRte-examples:

Examples
========

..  _pageTsRte-example-disable:

Example: Disable RTE
--------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Disable all RTEs
    RTE.default.disabled = 1

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Disable all RTEs
    RTE.default.disabled = 1
    # Enable RTE for the tt_content bodytext field only
    RTE.config.tt_content.bodytext.disabled = 0

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Disable all RTEs
    RTE.default.disabled = 1
    # Enable RTE for the tt_content bodytext field only
    RTE.config.tt_content.bodytext.disabled = 0
    # But disable RTE for tt_content bodytext again if the record type is "text"
    RTE.config.tt_content.bodytext.types.text.disabled = 1

..  _pageTsRteOverridePreset:

Example: Override preset
------------------------

Refer to the description of the order above for details of which setting has priority over which.

Summary:

*   Setting the preset via page TSconfig *for a specific field* overrides all,
    else
*   TCA richtextConfiguration (for a specific field) overrides the page TSconfig
    default preset (:typoscript:`RTE.default.preset`)

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # set a default preset to use as fallback
    RTE.default.preset = custom_preset_default

    # Override preset for field "description" in table "tt_address"
    RTE.config.tt_address.description.preset = custom_preset_fancy

..  _pageTsRte-properties:

Properties
==========

..  contents::
    :depth: 2
    :local:

..  index:: RTE; disable

disabled
--------

..  confval:: disabled
    :name: rte-disabled
    :type: boolean

    If set, the editor is disabled. This option is evaluated in :php:`\TYPO3\CMS\Backend\Form\FormEngine`
    where it determines whether the RTE is rendered or not. Note that a backend user can also ultimately
    disable RTE's in his user settings.

..  index::
    RTE; Configuration
    RTE; config


buttons
-------

..  _buttons-link-options-removeitems:

buttons.link.options.removeItems
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: buttons.link.options.removeItems
    :name: rte-buttons-link-options-removeItems
    :type: list of strings

    List of tab items to remove from the dialog of the link button.
    Possible tab items are: page, file, url, email, folder, telephone.

    Note: More tabs may be provided by extensions.

..  _buttons-link-targetselector-disabled:

buttons.link.targetSelector.disabled
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: buttons.link.targetSelector.disabled
    :name: rte-buttons-link-targetselector-disabled
    :type: boolean
    :Default: 0

    If set, the selection of link target is removed from the link
    insertion/update dialog.

..  _buttons-link-pageidselector-enabled:

buttons.link.pageIdSelector.enabled
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: buttons.link.pageIdSelector.enabled
    :name: rte-buttons-link-pageidselector-enabled
    :type: boolean
    :Default: 0

    If set, the specification of a page id, without using the page tree,
    is enabled in the link insertion/update dialog.

    Note: This feature is intended for authors who have to deal with a
    very large page tree. Note that the feature is disabled by default.

..  _buttons-link-queryparametersselector-enabled:

buttons.link.queryParametersSelector.enabled
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: buttons.link.queryParametersSelector.enabled
    :name: rte-buttons-link-queryparametersselector-enabled
    :type: boolean
    :Default: 0

    If set, an additional field is enabbled in the link insertion/update
    dialogue allowing authors to specify query parameters to be added on
    the link

..  _buttons-link-relattribute-enabled:

buttons.link.relAttribute.enabled
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: buttons.link.relAttribute.enabled
    :name: rte-buttons-link-relattribute-enabled
    :type: boolean
    :Default: 0

    If set, an additional field is enabled in the link insertion/update
    dialogue allowing authors to specify a rel attribute to be added to
    the link.

..  _buttons-link-properties-class-allowedclasses:

buttons.link.properties.class.allowedClasses
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: buttons.link.properties.class.allowedClasses
    :name: rte-buttons-link-properties-class-allowedclasses
    :type: list of id-strings

    Classes available in the Insert/Modify link dialogue.

..  _buttons-link-properties-class-required:

buttons.link.properties.class.required
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: buttons.link.properties.class.required
    :name: rte-buttons-link-properties-class-required
    :type: boolean

    If set, a class must be selected for any link. Therefore, the empty
    option is removed from the class selector.

..  _buttons-link-type-properties-class-required:

buttons.link.[ *type* ].properties.class.required
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: buttons.link.[type].properties.class.required
    :name: rte-buttons-link-type-properties-class-required
    :type: boolean

    If set, a class must be selected for any link of the given type.
    Therefore, the empty option is removed from the class selector.
    Possible types are: page, file, url, email, folder, telephone.

..  _buttons-link-properties-target-default:

buttons.link.properties.target.default
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: buttons.link.properties.target.default
    :name: rte-buttons-link-properties-target-default
    :type: string

    This sets the default target for new links in the RTE.


..  _buttons-link-type-properties-target-default:

buttons.link.[ *type* ].properties.target.default
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: buttons.link.[type].properties.target.default
    :name: rte-buttons-link-type-properties-target-default
    :type: string

    Specifies a default target for links of the given type.
    Possible types are: page, file, url, mail, spec. More types may be
    provided by extensions.

..  index::
    RTE; Content language direction
    RTE config; contentsLanguageDirection
..  _rte-config-contentsLanguageDirection:

config.contentsLanguageDirection
--------------------------------

..  confval:: config.contentsLanguageDirection
    :name: rte-config-contentsLanguageDirection
    :type: string

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

..  index::
    RTE; Server processing
    RTE; proc
..  _rte-proc:

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


..  index::
    RTE; Classes allowed
..  _rte-proc-allowedClasses:

allowedClasses
~~~~~~~~~~~~~~

..  confval:: proc.allowedClasses
    :name: rte-proc-allowedClasses
    :type: string with comma separated values

    Applies for `ts_transform` and `css_transform` only.

    Direction: From RTE to database, saving a record.

    Allowed general class names when content is stored in database. Could be a list matching the
    number of defined classes you have. Class names are case insensitive.

    This might be a really good idea to do, because when pasting in content from MS word for
    instance there are a lot of `<SPAN>` and `<P>` tags which may have class names in. So by
    setting a list of allowed classes, such foreign class names are removed.

    If a class name is not found in this list, the default is to remove the class.

..  index::
    RTE; HTML tags allowed
    RTE; Tags allowed
..  _rte-proc-allowTags:

allowTags
~~~~~~~~~

..  confval:: proc.allowTags
    :name: rte-proc-allowTags
    :type: string with comma separated values

    Applies for `ts_transform` and `css_transform` only.

    Tags to allow. Notice, this list is  *added* to the default list,
    which you see here:

    b,i,u,a,img,br,div,center,pre,figure,figcaption,font,hr,sub,sup,p,strong,em,li,ul,ol,blockquote,strike,span,abbr,acronym,dfn

..  index::
    RTE; Tags outside paragraphs
..  _rte-proc-allowTagsOutside:

allowTagsOutside
~~~~~~~~~~~~~~~~

..  confval:: proc.allowTagsOutside
    :name: rte-proc-allowTagsOutside
    :type: string with comma separated values
    :Default: `address, article, aside, blockquote, footer, header, hr, nav, section, div`

    Applies for `ts_transform` and `css_transform` only.

    Enter tags which are allowed outside of `<P>` and `<DIV>` sections when converted back to database.


Example: Allow only hr tags outside of p and div
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Allow only hr tags outside of p and div
    RTE.default.proc.allowTagsOutside = hr

..  index::
    RTE; block elements
..  _rte-proc-blockElementList:

blockElementList
~~~~~~~~~~~~~~~~

..  confval:: proc.blockElementList
    :name: rte-proc-blockElementList
    :type: string with comma separated values

    Comma-separated list of uppercase tags (e.g. :code:`P,HR`) that overrides the list of HTML
    elements that will be treated as block elements by the RTE transformations.

..  index::
    RTE; tags denyed
..  _rte-proc-denyTags:

denyTags
~~~~~~~~

..  confval:: proc.denyTags
    :name: rte-proc-denyTags
    :type: string with comma separated values

    Applies for `ts_transform` and `css_transform` only.

    Tags from above list to disallow.

..  index::
    RTE; HTMLparser DB entry
..  _rte-proc-entryHTMLparser_db:

entryHTMLparser_db
~~~~~~~~~~~~~~~~~~

..  confval:: proc.entryHTMLparser_db
    :name: rte-proc-entryHTMLparser_db
    :type: boolean / :ref:`HTMLparser <t3tsref:htmlparser>`

    Applies to all kinds of processing.

    Allows to enable / disable the :ref:`HTMLparser <t3tsref:htmlparser>` *before* the
    content is processed with the predefined processors (e.g. ts_images or ts_transform).

..  index::
    RTE; HTMLparser RTE entry
..  _rte-proc-entryHTMLparser_rte:

entryHTMLparser_rte
~~~~~~~~~~~~~~~~~~~

..  confval:: proc.entryHTMLparser_rte
    :name: rte-proc-entryHTMLparser_rte
    :type: boolean / :ref:`HTMLparser <t3tsref:htmlparser>`

    Applies to all kinds of processing.

    Allows to enable / disable the :ref:`HTMLparser <t3tsref:htmlparser>` *before* the
    content is processed with the predefined processors (e.g. ts_images or ts_transform).

..  index::
    RTE; HTMLparser DB exit
..  _rte-proc-exitHTMLparser_db:

exitHTMLparser_db
~~~~~~~~~~~~~~~~~

..  confval:: proc.exitHTMLparser_db
    :name: rte-proc-exitHTMLparser_db
    :type: boolean / :ref:`HTMLparser <t3tsref:htmlparser>`

    Applies to all kinds of processing.

    Allows to enable / disable the :ref:`HTMLparser <t3tsref:htmlparser>` *after* the
    content is processed with the predefined processors (e.g. ts_images or ts_transform).

..  index::
    RTE; HTMLparser RTE exit
..  _rte-proc-exitHTMLparser_rte:

exitHTMLparser_rte
~~~~~~~~~~~~~~~~~~

..  confval:: proc.exitHTMLparser_rte
    :name: rte-proc-exitHTMLparser_rte
    :type: boolean / :ref:`HTMLparser <t3tsref:htmlparser>`

    Applies to all kinds of processing.

    Allows to enable / disable the :ref:`HTMLparser <t3tsref:htmlparser>` *after* the
    content is processed with the predefined processors (e.g. ts_images or ts_transform).


..  index::
    RTE; HTMLparser DB
..  _pageTsRteProcHtmlParserDb:

HTMLparser_db
~~~~~~~~~~~~~

..  confval:: proc.HTMLparser_db
    :name: rte-proc-HTMLparser_db
    :type: :ref:`HTMLparser <t3tsref:htmlparser>`

    Applies for `ts_transform` and `css_transform` only.

    These are additional options to the HTML parser calls which strips of tags when the content is prepared
    *from the RTE to the database*, saving a record. It is possible to configure additional rules like which other
    tags to preserve, which attributes to preserve, which values are allowed as attributes of a certain tag etc.

    For the detailed list of properties, see the :ref:`section of the TypoScript reference <t3tsref:htmlparser>`.

    ..  note::

        This configuration is similar in frontend TypoScript and Page TSconfig.
        This is why single properties can be looked up in the TypoScript reference.

        Also note the :ref:`HTMLparser <t3tsref:htmlparser>` options :code:`keepNonMatchedTags`
        and :code:`htmlSpecialChars` are *not* observed. They are preset internally.

..  _pageTsRteProcHtmlParserDb-Sanitization:

Sanitization
^^^^^^^^^^^^

..  versionadded:: 9.5.29/10.4.19

An HTML sanitizer is available to sanitize and remove XSS from markup. It
strips tags, attributes and values that are not explicitly allowed.

Sanitization for persisting data is disabled by default and can be enabled
globally by using the corresponding feature flag in the :ref:`configuration
files <t3coreapi:configuration-files>`
:file:`config/system/settings.php` or
:file:`config/system/additional.php`:

..  code-block:: php

    $GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.backend.htmlSanitizeRte'] = true;

It can then be disabled per use case with a custom processing instruction:

..  code-block:: yaml
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


..  index::
    RTE; HTMLparser RTE
..  _rte-proc-HTMLparser_rte:

HTMLparser_rte
~~~~~~~~~~~~~~

..  confval:: proc.HTMLparser_rte
    :name: rte-proc-HTMLparser_rte
    :type: :ref:`HTMLparser <t3tsref:htmlparser>`

    Applies for `ts_transform` and `css_transform` only.

    These are additional options to the HTML parser calls which strips of tags when the content is prepared
    *from the database to the RTE* rendering. It is possible to configure additional rules like which other
    tags to preserve, which attributes to preserve, which values are allowed as attributes of a certain tag etc.

    For the detailed list of properties, see the :ref:`section of the TypoScript reference <t3tsref:htmlparser>`.

    ..  note::

       This configuration is similar in frontend TypoScript and Page TSconfig.
       This is why single properties can be looked up in the TypoScript reference.

       Also note the :ref:`HTMLparser <t3tsref:htmlparser>` options :code:`keepNonMatchedTags`
       and :code:`htmlSpecialChars` are *not* observed. They are preset internally.

..  index::
    RTE; Transformations overruled
..  _rte-proc-:

overruleMode
~~~~~~~~~~~~

..  confval:: proc.overruleMode
    :name: rte-proc-overruleMode
    :type: Comma list of RTE transformations

    This can overrule the RTE transformation set from TCA. Notice, this is a  *comma list* of transformation keys.
