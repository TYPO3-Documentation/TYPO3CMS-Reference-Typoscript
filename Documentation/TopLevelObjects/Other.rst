.. include:: /Includes.rst.txt

.. _top-level-objects-bcd:
.. _top-level-objects-other:

=======================
Other Top-level objects
=======================


.. container:: table-row

   Property
         ...

   Data type
         *(whatever)*

   Description
         If a top-level object is not a PAGE object it could be used as a
         temporary repository for setup. In this case you should use the "temp"
         or "styles" objects.

         "tt\_..." is normally used to define the setup of content-records. E.g.
         "tt\_content" would be used for the tt\_content-table as default. See
         the :ref:`"CONTENT" cObject <cobj-content>`.


.. _top-level-objects-includelibs:
.. _includelibs:

includeLibs
"""""""""""

.. container:: table-row

   Property
         includeLibs

   Data type
         *Array of strings*

   Description
         With this you can include PHP files with function libraries for use in
         your include script in TYPO3.

         Please see the PAGE object, which has the same property.

         **Note:** This property was deprecated and has been removed with TYPO3
         7! If you only need the included files inside a certain scope, e.g.
         inside a COA_INT or USER_INT cObject, use the includeLibs functionalities
         of this cObject instead. You can also use hooks during the Frontend set
         up to execute custom PHP code.



.. _top-level-objects-other-reserved-tlo-s:

Other reserved TLO's:
"""""""""""""""""""""

.. container:: table-row

   Property
         Other reserved TLO's:

         plugin

         tt\_\*

         temp

         styles

         lib

         \_GIFBUILDER

   Data type
         *(whatever)*

   Description
         These top-level object names are reserved. That means you can risk
         static\_templates to use them:

         "**plugin**" is used for rendering of special content like boards,
         e-commerce solutions, guestbooks and so on. Normally set from
         static\_templates.

         "**tt\_\***", e.g. tt\_content (from "content (default)") is used to
         render content from tables.

         "**temp**" and "**styles**" are used for code-libraries you can
         copy during parse-time, but they are not saved with the template in
         cache. **"temp" and "styles" are unset** before the template is
         cached! Therefore use these names to store temporary data.

         "**lib**" can be used for a "library" of code, you can reference in
         TypoScript (unlike "styles" which is unset).



.. _top-level-objects-resources:

resources
"""""""""

.. container:: table-row

   Property
         resources

   Data type
         readonly

   Description
         Resources in list (internal)



.. _top-level-objects-sitetitle:

sitetitle
"""""""""

.. container:: table-row

   Property
         sitetitle

   Data type
         readonly

   Description
         SiteTitle (internal)



.. _top-level-objects-types:

types
"""""

.. container:: table-row

   Property
         types

   Data type
         readonly

   Description
         Types (internal)

         type=99 reserved for plaintext display


.. ###### END~OF~TABLE ######
