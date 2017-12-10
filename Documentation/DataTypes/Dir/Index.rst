.. include:: ../../Includes.txt


.. _data-type-dir:

dir
===

.. container:: table-row

   Data type
         dir

   Examples
         *returns a list of all pdf, gif and jpg-files from
         fileadmin/files/ sorted by their name reversely and with the full
         path (with "fileadmin/files/" prepended).*

         **fileadmin/files/ \| pdf,gif,jpg \| name \| r \| true**

   Comment
         [path relative to the web root of the site] \| [list of valid
         extensions] \| [sorting: name, size, ext, date] \| [reverse: "r"] \|
         [return full path: boolean]

         Files matching are returned in a comma-separated string.




