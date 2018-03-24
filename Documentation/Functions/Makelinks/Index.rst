.. include:: ../../Includes.txt


.. _makelinks:

=========
makelinks
=========

makelinks substitutes all appearances of web addresses or mail links
with a real link-tag. Web addresses and mail links must be contained in
the text in the following form::

   http://www.example.com

   mailto:name@example.com


.. ### BEGIN~OF~TABLE ###

.. _makelinks-http-extTarget:

http.extTarget
==============

.. container:: table-row

   Property
         http.extTarget

   Data type
         :ref:`data-type-target`

   Description
         The target of the link.

   Default
         \_top

.. _makelinks-http-wrap:

http.wrap
=========

.. container:: table-row

   Property
         http.wrap

   Data type
         :ref:`data-type-wrap` / :ref:`stdwrap`

   Description
         Wrap around the link.

.. _makelinks-http-ATagBeforeWrap:

http.ATagBeforeWrap
===================

.. container:: table-row

   Property
         http.ATagBeforeWrap

   Data type
         :ref:`data-type-boolean`

   Description
         If set, the link is first wrapped with :ts:`http.wrap` and then the
         :html:`<a>`-tag.

   Default
         0

.. _makelinks-http-keep:

http.keep
=========

.. container:: table-row

   Property
         http.keep

   Data type
         list: "scheme","path","query"

   Description
         As default the link-text will be the full domain-name of the link.

         **Example:**

         With the URL http://www.example.com/test/doc.php?id=3 in our text we will
         get the following results::

            http.keep = "":                   www.example.com
            http.keep = "scheme":             http://www.example.com
            http.keep = "scheme,path":        http://www.example.com/test/doc.php
            http.keep = "scheme,path,query":  http://www.example.com/test/doc.php?id=3

.. _makelinks-http-ATagParams:

http.ATagParams
===============

.. container:: table-row

   Property
         http.ATagParams

   Data type
         <A>-params / :ref:`stdwrap`

   Description
         Additional parameters

         **Example:** ::

            http.ATagParams = class="board"

.. _makelinks-mailto.wrap:

mailto.wrap
===========

.. container:: table-row

   Property
         mailto.wrap

   Data type
         :ref:`data-type-wrap` / :ref:`stdwrap`

   Description
         Wrap around the link.

.. _makelinks-mailto.ATagBeforeWrap:

mailto.ATagBeforeWrap
=====================

.. container:: table-row

   Property
         mailto.ATagBeforeWrap

   Data type
         :ref:`data-type-boolean`

   Description
         If set, the link is first wrapped with mailto :ts:`wrap` and then the
         :html:`<a>`-tag.

   Default
         0

.. _makelinks-mailto.ATagParams:

mailto.ATagParams
=================

.. container:: table-row

   Property
         mailto.ATagParams

   Data type
         <A>-params / :ref:`stdwrap`

   Description
         Additional parameters

         **Example:** ::

            mailto.ATagParams = class="board"


.. ###### END~OF~TABLE ######


[tsref:->makelinks]
