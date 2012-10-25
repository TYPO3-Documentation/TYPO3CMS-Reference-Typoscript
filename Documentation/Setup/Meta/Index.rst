.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


"META"
^^^^^^


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:

   Data type
         Data type:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Property
         Array...

   Data type
         string /stdWrap

   Description
         Allows you to define meta tags.

         Use the scheme meta.key = value.

         The "key" can be the name of any meta tag, e.g. "description" or
         "keywords". If the key is "refresh" (case insensitive), then the
         "http-equiv" attribute is used in the meta tag instead of the "name"
         attribute.

         If the "value" is empty (after trimming), the meta tag is not
         generated.

         **Examples:** ::

            meta.description = This is the description of the content in this document.
            meta.keywords = These are the keywords.
            meta.refresh = [seconds]; [url, leave blank for same page]

         For each key the following sub-property is available:

         httpEquivalent: (Since TYPO3 4.7) If set to 1, the http-equiv
         attribute is used in the meta tag instead of the "name" attribute.
         Default: 0.

         **Example:** ::

            meta.X-UA-Compatible = IE=edge,chrome=1
            meta.X-UA-Compatible.httpEquivalent = 1

         This results in <meta http-equiv="X-UA-Compatible"
         content="IE=edge,chrome=1">.

   Default


.. ###### END~OF~TABLE ######


[tsref:->META]

