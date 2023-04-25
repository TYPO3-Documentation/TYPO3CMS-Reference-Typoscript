.. include:: /Includes.rst.txt
.. index::
   Top-level objects; temp
   Top-level objects; styles
   Top-level objects; lib
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


.. index:: Top-level objects; tt_content
.. _tlo-tt:
.. _tlo-tt_content:


==========
tt_content
==========

The top level keyword :typoscript:`tt_content` is used to render content from the table :sql:`tt_content`.


.. index:: Top-level objects; resources
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



.. index:: Top-level objects; sitetitle
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



.. index:: Top-level objects; types
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
