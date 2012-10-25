.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


Storing user-data or session-data
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Doing so is quite simple with TYPO3.

Userdata is data, that follows login users. As soon as a user, who is
logged in, logs out, this data is no more accessible and cannot be
altered.

Session data is data, that follows the user currently browsing the
site. This user may be a logged in user, but his session-data is bound
to the "browsing-session" and not to the user-id of his. This means,
that the very same person will carry this data still, even if he logs
out. As soon as he closes his browser, his data will be gone though.

Also you should know, that session-data has a default expire-time of
24 hours.

Retrieving and storing user-/session-data is done by these functions:


$GLOBALS['TSFE']->fe\_user->getKey(type, key)
"""""""""""""""""""""""""""""""""""""""""""""

"type" is either "user" or "ses", which defines the data-space, user-
data or session-data

"key" is the "name" under which your data is stored. This may be
arrays or normal scalars.

Note that the key "recs" is reserved for the built-in "shopping-
basket". As is "sys" (for TYPO3 standard modules and code)


Example:
~~~~~~~~

::

   if ($GLOBALS['TSFE']->loginUser) {
           $myData = $GLOBALS['TSFE']->fe_user->getKey('user', 'myData');
   } else {
           $myData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'myData');
   }

This gets the stored data with the key "myData" from the user-data,
but if no user is logged in, it's fetched from the session data
instead.


$GLOBALS['TSFE']->fe\_user->setKey(type, key, data)
"""""""""""""""""""""""""""""""""""""""""""""""""""

"type" is either "user" or "ses", which defines the data-space, user-
data or session-data

"key" is the "name" under which your data is stored.

Note that the key "recs" is reserved for the built-in "shopping-
basket". As is "sys" (for TYPO3 standard modules and code)

"data" is the variable, you want to store. This may be arrays or
normal scalars.


Example:
~~~~~~~~

::

   $myConfig['name'] = 'paul';
   $myConfig['address'] = 'Main street';
   $GLOBALS['TSFE']->fe_user->setKey('ses', 'myData', $myConfig);

This stores the array $myConfig under the key "myData" in the session-
data. This lasts as long as "paul" is surfing the site!

