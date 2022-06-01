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
also be overriden in more specific situations:

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
`ts_css` imply other transformations :ref:`as explained in the overview <transformations-overview-meta>`.
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

