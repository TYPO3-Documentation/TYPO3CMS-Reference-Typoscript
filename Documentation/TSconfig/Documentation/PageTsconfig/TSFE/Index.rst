.. include:: ../../Includes.txt

.. _pagetsfe:

->TSFE
^^^^^^

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         jumpUrl\_transferSession

   Data type
         boolean

   Description
         If set, the jumpUrl redirection to the URL will be prepended with a
         parameter that transfers the current fe\_users session to that URL.
         This URL should be the TYPO3 frontend in the same database, just at
         another domain (else it makes no sense).

         You can implement it in your own links if you like. This is how you
         do:

         You must send the parameter 'FE\_SESSION\_KEY' as GET or POST. The
         parameter looks like this: [fe\_user-session-id]-[a hash made to
         prevent misuse]

         The parameter can be calculated like this:

         .. code-block:: php

			$param = '&FE_SESSION_KEY=' . rawurlencode(
				$GLOBALS['TSFE']->fe_user->id . '-' .
				md5( $GLOBALS['TSFE']->fe_user->id. '/' . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'])
			);


.. container:: table-row

   Property
         constants

   Data type
         [TypoScript Frontend Constants defaults]

   Description
         Defaults for TypoScript Template constants!

         This feature allows you to pass some amount of information (in the
         form of TypoScript Template constants) to the frontend.

         The specific use of this should be information which you want to
         configure for both frontend and backend. For instance you could have a
         backend module which should act in a certain way depending on in which
         branch of the page tree it operates. The change of behavior is set by
         Page TSconfig as always, but since you need the same setting applied
         somewhere in the frontend you don't want the redundancy of specifying
         the value twice. In such a case you can use this feature.

         **Example:**

         .. code-block:: typoscript

			TSFE.constants.websiteConfig.id = 123

         In the TypoScript templates you can now insert this constant as
         {$websiteConfig.id}

         .. figure:: ../../Images/manual_html_me910706.png
            :alt: Showing TS constants with the TypoScript Object Browser

         In the backend module (in the Web main module) you can reach the value
         by a few lines of code like these

         .. code-block:: php

			$PageTSconfig = \TYPO3\CMS\Backend\Utility\BackendUtility::getPagesTSconfig($this->pObj->id);
			$websiteID = $PageTSconfig['TSFE.']['constants.']['websiteConfig.']['id'];

         .. note::

            In the frontend the setting of default constants will only
            apply to a branch of the tree *if* a template record is found on that
            page (or if a template record is set for "next level"). In other
            words: If you want the Page TSconfig constant defaults to affect only
            a certain branch of the page tree, make sure to create a template
            record (a blank one will do) on the page that carries the Page
            TSconfig information.


.. ###### END~OF~TABLE ######

[page:TSFE]