.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _appendix-submitting-data:

Submitting data to index.php
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can submit data to index.php for several reasons. These are the
standard features included in the script:


Login/Logout:
"""""""""""""

Detected by class "TYPO3\CMS\Core\Authentication\AbstractUserAuthentication"
(t3lib\_userauth) looking for the var "logintype". If this is set,
authentication is done.

Input may be of both GET and POST method.

Login:

logintype = "login"

pass = the password

user = the username

pid = the id of the page where the user-archive is found. You don't
need this value if $TYPO3\_CONF\_VARS['FE']['checkFeUserPid'] is set.

(redirect = Not used)

Logout:

logintype = "logout"

See the cObject FORMS for an in-depth description

