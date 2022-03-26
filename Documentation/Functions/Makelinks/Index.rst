.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: /Includes.rst.txt


.. _makelinks:

makelinks
^^^^^^^^^

makelinks substitutes all appearances of web addresses or mail links
with a real link-tag. Web addresses and mail links must be contained in
the text in the following form::

   https://example.org

   mailto:name@example.org


.. ### BEGIN~OF~TABLE ###

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
         wrap /:ref:`stdWrap <stdwrap>`

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

         **Example:**

         With the URL :samp:`https://example.org/test/doc.php?id=3` in our text we will
         get the following results::

            http.keep = "":                   example.org
            http.keep = "scheme":             https://example.org
            http.keep = "scheme,path":        https://example.org/test/doc.php
            http.keep = "scheme,path,query":  https://example.org/test/doc.php?id=3


.. container:: table-row

   Property
         http.ATagParams

   Data type
         <A>-params /:ref:`stdWrap <stdwrap>`

   Description
         Additional parameters

         **Example:** ::

            http.ATagParams = class="board"


.. container:: table-row

   Property
         mailto.wrap

   Data type
         wrap /:ref:`stdWrap <stdwrap>`

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
         <A>-params /:ref:`stdWrap <stdwrap>`

   Description
         Additional parameters

         **Example:** ::

            mailto.ATagParams = class="board"


.. ###### END~OF~TABLE ######


[tsref:->makelinks]

