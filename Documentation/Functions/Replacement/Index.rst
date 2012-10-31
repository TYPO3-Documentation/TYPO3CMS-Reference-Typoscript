.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _replacement:

replacement
^^^^^^^^^^^

(Since TYPO3 4.6) This object performs an ordered search and replace
operation on the current content with the possibility of using PCRE
regular expressions. An array with numeric indices defines the order
of actions and thus allows multiple replacements at once.

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
         search

   Data type
         string /stdWrap

   Description
         Defines the string that shall be replaced.

   Default


.. container:: table-row

   Property
         replace

   Data type
         string /stdWrap

   Description
         Defines the string to be used for the replacement.

   Default


.. container:: table-row

   Property
         useRegExp

   Data type
         boolean /stdWrap

   Description
         Defines that the search and replace strings are considered as PCRE
         regular expressions.

         **Example:** ::

            10 {
              search = #(a )CAT#i
              replace = \1cat
              useRegExp = 1
            }

   Default
         0


.. ###### END~OF~TABLE ######

[tsref:->replacement]


((generated))
"""""""""""""

Example:
~~~~~~~~

::

   20 = TEXT
   20 {
     value = There_are_a_cat,_a_dog_and_a_tiger_in_da_hood!_Yeah!
     stdWrap.replacement {
       10 {
         search = _
         replace.char = 32
       }
       20 {
         search = in da hood
         replace = around the block
       }
       30 {
         search = #a (Cat|Dog|Tiger)#i
         replace = an animal
         useRegExp = 1
       }
     }
   }

This returns: "There are an animal, an animal and an animal around the
block! Yeah!".

