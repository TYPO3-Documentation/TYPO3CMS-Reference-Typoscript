.. include:: ../../Includes.txt
.. index:: Content objects; EDITPANEL
.. _cobj-editpanel:

=========
EDITPANEL
=========

A content object of type EDITPANEL is inserted only if a backend user is logged in
and if a FE-editing extension is installed and loaded. What gets
displayed exactly may depend on which FE-editing extension is used.
The reference below is related to EDITPANEL settings found in the TYPO3 core.
Different FE-editing extension may include their own settings that are not
present in this list. In such a case, it is advised to look up that extensions
documentation for more information.

In the case of the "feedit" extension, the EDITPANEL also requires that the
Admin Panel be displayed (config.admPanel = 1) and that the user has checked the
"Display Edit Icons" option. Whenever the edit panel is inserted, page
caching is disabled.

The edit panel inserts icons for moving, editing, deleting, hiding and
creating records.

An EDITPANEL will appear for each content element on the page. It is also
possible to insert an EDITPANEL as cObject in the template, using TypoScript.


.. note::

   A FE-editing extension needs to be installed for this to work. The
   former "feedit" system extension has been dropped from the TYPO3 core
   since v10, but is still available as third-party extension:

   `ext:feedit <https://extensions.typo3.org/extension/feedit/>`__

   There are other, more "up to date" FE-editing extensions, as well. For
   instance you can try out "frontend_editing":

   `ext:frontend_editing <https://extensions.typo3.org/extension/frontend_editing/>`__

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         label

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Title for the panel. You can insert the record title with %s

         **Example:** ::

            label = Section <b>%s</b>


.. container:: table-row

   Property
         allow

   Data type
         string

   Description
         Define which functions are accessible. Further this comma-separated
         list may be reduced, if the BE\_USER does not have permission to
         perform the action.

         Values should be listed separated by comma. These are the options you
         can choose from:

         * **toolbar:** is a list of icons regarding the page, so use this
           for page records only.
         * **edit:** edit element.
         * **new:** create new element.
         * **delete:** delete element.
         * **move:** move element.
         * **hide:** hide element.


.. container:: table-row

   Property
         newRecordFromTable

   Data type
         string

   Description
         Will display a panel for creation of new element (in the top of list)
         on the page from that table.


.. container:: table-row

   Property
         newRecordInPid

   Data type
         integer

   Description
         Define a page ID where new records (except new pages) will be created.


.. container:: table-row

   Property
         line

   Data type
         boolean / integer

   Description
         If set, a black line will appear after the panel. This value will
         indicate the distance from the black line to the panel.


.. container:: table-row

   Property
         onlyCurrentPid

   Data type
         boolean

   Description
         If set, only records with a pid matching the current id (TSFE->id)
         will be shown with the panel.


.. container:: table-row

   Property
         innerWrap

   Data type
         :ref:`wrap <data-type-wrap>` /:ref:`stdWrap <stdwrap>`

   Description
         Wraps the edit panel.


.. container:: table-row

   Property
         outerWrap

   Data type
         :ref:`wrap <data-type-wrap>` /:ref:`stdWrap <stdwrap>`

   Description
         Wraps the whole edit panel including the black line (if configured).


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


.. ###### END~OF~TABLE ######

[tsref:(cObject).EDITPANEL]


.. _cobj-editpanel-examples:

Example:
""""""""

::

   page = PAGE
   page.10 = EDITPANEL
   page.10 {
     ...
   }

Here the edit panel is inserted as a cObject. In such a case, there is
nothing to edit in the FE, but the panel can be used to create new
records, for example.

