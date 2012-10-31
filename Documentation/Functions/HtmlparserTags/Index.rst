.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _htmlparser-tags:

HTMLparser\_tags
^^^^^^^^^^^^^^^^


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:

   Data type
         Data type:

   Description
         Description:


.. container:: table-row

   Property
         overrideAttribs

   Data type
         string

   Description
         If set, this string is preset as the attributes of the tag.


.. container:: table-row

   Property
         allowedAttribs

   Data type


   Description
         '0' (zero) = no attributes allowed, '[commalist of attributes]' = only
         allowed attributes. If blank/not set, all attributes are allowed.


.. container:: table-row

   Property
         fixAttrib.[attribute].set

   Data type
         string

   Description
         Force the attribute value to this value.


.. container:: table-row

   Property
         fixAttrib.[attribute].unset

   Data type
         boolean

   Description
         If set, the attribute is unset.


.. container:: table-row

   Property
         fixAttrib.[attribute].default

   Data type
         string

   Description
         If no attribute exists by this name, this value is set as default
         value (if this value is not blank)


.. container:: table-row

   Property
         fixAttrib.[attribute].always

   Data type
         boolean

   Description
         If set, the attribute is always processed. Normally an attribute is
         processed only if it exists


.. container:: table-row

   Property
         fixAttrib.[attribute].trim

         fixAttrib.[attribute].intval

         fixAttrib.[attribute].upper

         fixAttrib.[attribute].lower

   Data type
         boolean

   Description
         If any of these keys are set, the value is passed through the
         respective PHP-functions.


.. container:: table-row

   Property
         fixAttrib.[attribute].range

   Data type
         [low],[high]

   Description
         Setting integer range.


.. container:: table-row

   Property
         fixAttrib.[attribute].list

   Data type
         list of values, trimmed

   Description
         Attribute value must be in this list. If not, the value is set to the
         first element.


.. container:: table-row

   Property
         fixAttrib.[attribute].removeIfFalse

   Data type
         boolean/"blank" string

   Description
         If set, then the attribute is removed if it is "false". If this value
         is set to "blank" then the value must be a blank string (that means a
         "zero" value will not be removed)


.. container:: table-row

   Property
         fixAttrib.[attribute].removeIfEquals

   Data type
         string

   Description
         If the attribute value matches the value set here, then it is removed.


.. container:: table-row

   Property
         fixAttrib.[attribute].casesensitiveComp

   Data type
         boolean

   Description
         If set, the comparison in .removeIfEquals and .list will be case-
         sensitive. At this point, it's insensitive.


.. container:: table-row

   Property
         fixAttrib.[attribute].prefixLocalAnchors

   Data type
         integer

   Description
         If the first char is a "#" character (anchor of fx. <a> tags) this
         will prefix either a relative or absolute path.

         If the value is "1" you will get the absolute path
         (TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3\_REQUEST\_URL')
         or t3lib\_div::getIndpEnv('TYPO3\_REQUEST\_URL')).

         If the value is "2" you will get the relative path (stripping of
         TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3\_SITE\_URL')
         or t3lib\_div::getIndpEnv('TYPO3\_SITE\_URL')).

         **Example:** ::

            ...fixAttrib.href.prefixLocalAnchors = 1


.. container:: table-row

   Property
         fixAttrib.[attribute].prefixRelPathWith

   Data type
         string

   Description
         If the value of the attribute seems to be a relative URL (no scheme
         like "http" and no "/" as first char) then the value of this property
         will be prefixed the attribute.

         **Example:**

         ...fixAttrib.src.prefixRelPathWith =
         http://192.168.230.3/typo3/32/dummy/


.. container:: table-row

   Property
         fixAttrib.[attribute].userFunc

   Data type
         function reference

   Description
         User function for processing of the attribute.

         **Example:**

         ...fixAttrib.href.userFunc = tx\_realurl->test\_urlProc


.. container:: table-row

   Property
         protect

   Data type
         boolean

   Description
         If set, the tag <> is converted to &lt; and &gt;


.. container:: table-row

   Property
         remap

   Data type
         string

   Description
         If set, the tagname is remapped to this tagname


.. container:: table-row

   Property
         rmTagIfNoAttrib

   Data type
         boolean

   Description
         If set, then the tag is removed if no attributes happend to be there.


.. container:: table-row

   Property
         nesting

   Data type


   Description
         If set true, then this tag must have starting and ending tags in the
         correct order. Any tags not in this order will be discarded. Thus
         '</B><B><I></B></I></B>' will be converted to '<B><I></B></I>'.

         Is the value "global" then true nesting in relation to other tags
         marked for "global" nesting control is preserved. This means that if
         <B> and <I> are set for global nesting then this string
         '</B><B><I></B></I></B>' is converted to '<B></B>'


.. ###### END~OF~TABLE ######


[page:->HTMLparser\_tags; tsref:->HTMLparser\_tags]

