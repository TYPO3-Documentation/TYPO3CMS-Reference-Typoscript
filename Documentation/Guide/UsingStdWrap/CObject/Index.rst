.. include:: /Includes.rst.txt
.. _guide-stdwrap-cobject:

=======
cObject
=======

The `stdWrap` property ":ref:`cObject <stdwrap-cobject>`" can be
used to replace the content with a TypoScript object. This can be a
:ref:`COA <cobj-coa>`, a plugin or a text like in this
example::

   10.typolink.title.cObject = TEXT
   10.typolink.title.cObject {
      value = Copyright
      case = upper
   }

