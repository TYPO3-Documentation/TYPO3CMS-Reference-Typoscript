

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


Emailforms
^^^^^^^^^^

Detected by the mainscript "index.php" looking for the var
"formtype\_mail" to be set (could be the submit-button).

Input MUST be POST method. And the REFERER and HTTP\_HOST must match.
Also the locationData var must be sent and at least point to the uid
of a readable page.

