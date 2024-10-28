.. include:: /Includes.rst.txt


.. _guide-function-split:

split
^^^^^

The :ref:`split <split>` function can be used to split given data at a predefined
character and process the single pieces afterwards. At every
iteration, the current index key `SPLIT-COUNT` is stored (starting
with 0).

By using `split`, we could, for example, read a table field and wrap
every single line with a certain code (e.g. generate an HTML table,
which can be used to show the same content on more than one page)::

     20 = TEXT

     # The content of the field "bodytext" is imported (from $cObj->data-array).
     20.stdWrap.field = bodytext
     20.stdWrap.split {

       # The separation character is defined (char = 10 is the newline character).
       token.char = 10

       # We define which element will be used.
       # By using optionSplit we can distinguish between elements.
       # Corresponding elements with the numbers must be defined!
       # For rendering, the numbers 1 and 2 are used in alternation.
       # In this example, the classes "odd" and "even" are used so we
       # can zebra style a table.
       cObjNum = |*|1||2|*|

       # The first element is defined (which is referenced by cObjNum).
       # The content is imported using stdWrap->current.
       1.current = 1

       # The element is wrapped.
       1.wrap = <tr class="odd"><td> | </td></tr>

       # The 2nd element is determined and wrapped.
       2.current = 1
       2.wrap = <tr class="even"><td> | </td></tr>
     }

     # A general wrap to create a valid table markup.
     20.stdWrap.wrap = <table> | </table>

