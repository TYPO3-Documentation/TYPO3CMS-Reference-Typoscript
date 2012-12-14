.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _makelinks:

makelinks
^^^^^^^^^

makelinks substitutes all appearances of

http://www.webaddress.rld

mailto:name@email.rld

... with a real link-tag.


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
         http.extTarget

   Data type
         target

   Description
         The target of the link.

   Default
         \_top


.. container:: table-row

   Property
         http.wrap

   Data type
         wrap /stdWrap

   Description
         Wrap around the link.


.. container:: table-row

   Property
         http.ATagBeforeWrap

   Data type
         boolean

   Description
         If set, the link is first wrapped with *http.wrap* and then the
         <A>-tag.

   Default
         0


.. container:: table-row

   Property
         http.keep

   Data type
         list: "scheme","path","query"

   Description
         As default the link-text will be the full domain-name of the link.

         **Examples** ::

            http://www.webaddress.rld/test/doc.php?id=3
            "":           www.webaddress.rld
            "scheme":             http://www.webaddress.rld
            "scheme,path":        http://www.webaddress.rld/test/doc.php
            "scheme,path,query": http://www.webaddress.rld/test/doc.php?id=3


.. container:: table-row

   Property
         http.ATagParams

   Data type
         <A>-params /stdWrap

   Description
         Additional parameters

         **Example:** ::

            class="board"


.. container:: table-row

   Property
         mailto.wrap

   Data type
         wrap /stdWrap

   Description
         Wrap around the link.


.. container:: table-row

   Property
         mailto.ATagBeforeWrap

   Data type
         boolean

   Description
         If set, the link is first wrapped with mailto *.wrap* and then the
         <A>-tag.

   Default
         0


.. container:: table-row

   Property
         mailto.ATagParams

   Data type
         <A>-params /stdWrap

   Description
         Additional parameters

         **Example:** ::

            class="board"


.. ###### END~OF~TABLE ######


[tsref:->makelinks]

