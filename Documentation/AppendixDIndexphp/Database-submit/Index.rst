

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


Database-submit
^^^^^^^^^^^^^^^

Detected by the mainscript "index.php" looking for the var
"formtype\_db" to be set. (could be the submit-button)

Input MUST be POST method. And the REFERER and HTTP\_HOST must match.
To setup a script to handle the input, refer to the FE\_DATA object.

See examples from the typo3/sysext/statictemplates/media/scripts/
folder or database submits of extensions, e.g. of tt\_guest.


