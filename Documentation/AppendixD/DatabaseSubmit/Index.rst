.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _appendix-db-submit:

Database Submit
^^^^^^^^^^^^^^^

Detected by the mainscript "index.php" looking for the variable
"formtype\_db" to be set (could be the submit button).

Input MUST be POST method. And the REFERER and HTTP\_HOST must match.
To setup a script to handle the input, refer to the FE\_DATA object.

See examples from the media/scripts/ in the statictemplates extension
or database submits of extensions, e.g. of tt\_guest.


