.. include:: ../Includes.txt
.. index:: Functions; replacement
.. _replacement:

===========
replacement
===========

This object performs an ordered search and replace operation on the
current content with the possibility of using PCRE regular expressions.
An array with numeric indices defines the order of actions and thus
allows multiple replacements at once.

.. _replacement-search:

search
======

:aspect:`Property`
   search

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description`
   Defines the string that shall be replaced.

.. _replacement-replace:

replace
=======

:aspect:`Property`
   replace

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description`
   Defines the string to be used for the replacement.

.. _replacement-useregexp:

useRegExp
=========

:aspect:`Property`
   useRegExp

:aspect:`Data type`
   :ref:`data-type-bool` / :ref:`stdwrap`

:aspect:`Description`
   Defines that the search and replace strings are considered as PCRE
   regular expressions.

:aspect:`Default`
   0

:aspect:`Example`
   ::

      10 {
            search = #(a )CAT#i
            replace = \1cat
            useRegExp = 1
      }

.. _replacement-useoptionsplitreplace:

useOptionSplitReplace
=====================

:aspect:`Property`
   useOptionSplitReplace

:aspect:`Data type`
   :ref:`data-type-bool` / :ref:`stdwrap`

:aspect:`Description`
   This property allows to use :ref:`objects-optionsplit` for the replace
   property. That way the replace property can be different depending on the
   occurrence of the string (first/middle/last part, ...). This works for
   both normal and regular expression replacements. For examples see below.

:aspect:`Default`
   0

.. _replacement-examples:

Examples
========

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
   20.stdWrap.replacement.10 {
       search = _
       replace = 1 || 2 || 3
       useOptionSplitReplace = 1
   }

This returns: "There1are2a3cat,3a3dog3and3a3tiger3in3da3hood!3Yeah!"

::

   30 = TEXT
   30.value = There are a cat, a dog and a tiger in da hood! Yeah!
   30.stdWrap.replacement.10 {
       search = #(a) (Cat|Dog|Tiger)#i
       replace = ${1} tiny ${2} || ${1} midsized ${2} || ${1} big ${2}
       useRegExp = 1
       useOptionSplitReplace = 1
   }

This returns: "There are a tiny cat, a midsized dog and a big tiger in da hood! Yeah!"
