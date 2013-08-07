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
         search

   Data type
         string /stdWrap

   Description
         Defines the string that shall be replaced.


.. container:: table-row

   Property
         replace

   Data type
         string /stdWrap

   Description
         Defines the string to be used for the replacement.


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


.. container:: table-row

   Property
         useOptionSplitReplace

   Data type
         boolean /stdWrap

   Description
         (Since TYPO3 6.2) This property allows to use :ref:`objects-optionsplit`
         for the replace property. That way the replace property can be different
         depending on the occurrence of the string (first/middle/last part,
         ...). This works for both normal and regular expression replacements.
         For examples see below.

   Default
         0


.. ###### END~OF~TABLE ######

[tsref:->replacement]


.. _replacement-examples:

Examples:
"""""""""

::

   10 = TEXT
   10 {
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


The following examples demonstrate the use of :ref:`objects-optionsplit`:

::

   20 = TEXT
   20.value = There_are_a_cat,_a_dog_and_a_tiger_in_da_hood!_Yeah!
   20.replacement.10 {
     search = _
     replace = 1 || 2 || 3
     useOptionSplitReplace = 1
   }

This returns: "There1are2a3cat,3a3dog3and3a3tiger3in3da3hood!3Yeah!"

::

   30 = TEXT
   30.value = There are a cat, a dog and a tiger in da hood! Yeah!
   30.replacement.10 {
     search = #(a) (Cat|Dog|Tiger)#i
     replace = ${1} tiny ${2} || ${1} midsized ${2} || ${1} big ${2}
     useRegExp = 1
     useOptionSplitReplace = 1
   }

This returns: "There are a tiny cat, a midsized dog and a big tiger in da hood! Yeah!"

