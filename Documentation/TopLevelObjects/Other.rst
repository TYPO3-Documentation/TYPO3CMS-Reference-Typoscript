.. include:: /Includes.rst.txt

.. _top-level-objects-other-reserved-tlo-s:
.. _top-level-objects-temp:
.. _tlo-temp:
.. _top-level-objects-styles:
.. _tlo-styles:
.. _top-level-objects-lib:
.. _tlo-lib:

==================
temp, styles & lib
==================

.. container:: table-row

   Property
         temp

   Data type
         *(whatever)*

   Description
         This top-level object name is reserved.

         :typoscript:`temp` and :typoscript:`styles` are used for code-libraries you can
         copy during parse-time, but they are not saved with the template in
         cache. :typoscript:`temp` and :typoscript:`styles` are unset before the template is
         cached! Therefore use these names to store temporary data.

         :typoscript:`lib` can be used for a "library" of code, you can reference in
         TypoScript (unlike :typoscript:`styles` which is unset).

.. _tlo-tt:

====
tt_*
====

``tt_``, e.g. ``tt_content`` (from “content (default)”) is used to render content from tables.

.. _top-level-objects-resources:
.. _tlo-resources:

=========
resources
=========

.. container:: table-row

   Property
         resources

   Data type
         readonly

   Description
         Resources in list (internal)



.. _top-level-objects-sitetitle:
.. _tlo-sitetitle:

=========
sitetitle
=========

.. container:: table-row

   Property
         sitetitle

   Data type
         readonly

   Description
         SiteTitle (internal)



.. _top-level-objects-types:
.. _tlo-types:

=====
types
=====

.. container:: table-row

   Property
         types

   Data type
         readonly

   Description
         Types (internal)

         :typoscript:`type=99` reserved for plaintext display


.. ###### END~OF~TABLE ######
