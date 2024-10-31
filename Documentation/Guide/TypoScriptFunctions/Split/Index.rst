..  include:: /Includes.rst.txt

..  _guide-function-split:

=====
split
=====

The :ref:`split <split>` function can be used to split given data at a predefined
character and process the single pieces afterwards. At every
iteration, the current index key `SPLIT-COUNT` is stored (starting
with 0).

By using `split`, we could, for example, read a table field and wrap
every single line with a certain code (e.g. generate an HTML table,
which can be used to show the same content on more than one page):

..  literalinclude:: _split.typoscript
