.. include:: ../Includes.txt


.. _addparams:

=========
addParams
=========

Adds parameters to an HTML tag.

.. _addParams-\_offset:

\_offset
========

:aspect:`Property`
   \_offset

:aspect:`Data type`
   :ref:`data-type-integer`

:aspect:`Description`
   Use this to define which tag you want to manipulate.

   1 is the first tag in the input, 2 is the second, -1 is the last, -2
   is the second last.

:aspect:`Default`
   1

.. _addParams-*(array-of-strings)*:

*(array of strings)*
====================

:aspect:`Property`
   *(array of strings)*

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description`
   The name of the property defines the property to be added to the
   tag. The value is what will be set as content of the property.

   If the tag already has a property with this name (case-sensitive!),
   that property will be overridden!

   If the returned value is a blank string (but not zero!), then the
   property will not be set and (if it exists already) not be
   overridden.


.. _addparams-examples:

Example
=======

::

   page.13 = TEXT
   page.13.value = <tr><td>
   page.13.stdWrap.addParams.bgcolor = white
   page.13.stdWrap.addParams._offset = -1

Result example:

.. code-block:: html

   <tr><td bgcolor="white">

This example adds the :ts:`bgColor` property to the value of the :ref:`cobj-text`
:ref:`data-type-cobject`.
