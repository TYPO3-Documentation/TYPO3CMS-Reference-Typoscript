.. include:: /Includes.rst.txt


.. _gmenuitem:


GMENUITEM
^^^^^^^^^

Additional properties for Menu item states
""""""""""""""""""""""""""""""""""""""""""

These properties are additionally available for the GMENU item states
although the main object is declared to be GIFBUILDER.

It is evident that it is an unclean solution to introduce these
properties on the same level as the GIFBUILDER object in a single
situation like this. However this is how it irreversibly is and has
been for a long time.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         noLink

   Data type
         boolean

   Description
         If set, the item is **not** linked!


.. container:: table-row

   Property
         imgParams

   Data type
         params

   Description
         Parameters for the <img>-tag


.. container:: table-row

   Property
         altTarget

   Data type
         string

   Description
         Alternative target which overrides the target defined for the GMENU


.. container:: table-row

   Property
         altImgResource

   Data type
         imgResource

   Description
         Defines an alternative image to use. If an image returns here, it will
         override any GIFBUILDER configuration.


.. container:: table-row

   Property
         ATagParams

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Additional parameters


.. container:: table-row

   Property
         ATagTitle

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         which defines the title attribute of the a-tag. (See TMENUITEM also)


.. container:: table-row

   Property
         additionalParams

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Define parameters that are added to the end of the URL. This must be
         code ready to insert after the last parameter.

         For details, see typolink->additionalParams


.. container:: table-row

   Property
         wrap

   Data type
         wrap

   Description
         Wrap of the menu item.


.. container:: table-row

   Property
         allWrap

   Data type
         wrap /:ref:`stdWrap <stdwrap>`

   Description
         Wraps the whole item.


.. container:: table-row

   Property
         subst\_elementUid

   Data type
         boolean

   Default
         0 (false)

   Description
         If set, "{elementUid}" is substituted with the item uid.



.. container:: table-row

   Property
         allStdWrap

   Data type
         ->stdWrap

   Description
         stdWrap of the whole item


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj).GMENUITEM]

