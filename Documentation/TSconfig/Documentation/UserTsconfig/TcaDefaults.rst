.. include:: ../Includes.txt

.. _userTsTcaDefaults:

===========
TCAdefaults
===========

This allows to set or override the `default` values of `TCA` fields that is available
for various TCA types, for instance for :ref:`type=input <t3tca:columns-input-properties-default>`.

The full path of a setting include the table and the field name: `TCAdefaults.[table name].[field]`

This key is also available on :ref:`Page TSconfig level <pageTsTcaDefaults>`, the order of default
values when creating new records in the backend is this:

#. Value from $GLOBALS['TCA']

#. Value from User TSconfig (these settings)

#. Value from :ref:`Page TSconfig <pageTsTcaDefaults>`

#. Value from "defVals" GET variables

#. Value from previous record based on 'useColumnsForDefaultValues'

However the order for default values used by :php:`\TYPO3\CMS\Core\DataHandling\DataHandler` if a certain
field is not granted access to for user will be:

#. Value from $GLOBALS['TCA']

#. Value from User TSconfig (these settings)

So these values will be authoritative if the user has no access to the field anyway.

Example:

    .. code-block:: typoscript

        # Sets the default hidden flag for pages to "clear".
        TCAdefaults.pages.hidden = 0

    .. important::

        This example will not work when creating the page from the context menu
        since this is triggered by the values listed in the `ctrl` section of
        :file:`typo3/sysext/core/Configuration/TCA/pages.php`::

            'ctrl' => [
                'useColumnsForDefaultValues' => 'doktype,fe_group,hidden',
                ...
            ]

        If 'hidden' is in the list, it gets overwritten with the "neighbor" record value (see
        :php:`\TYPO3\CMS\Backend\Form\FormDataProvider\DatabaseRowInitializeNew::setDefaultsFromNeighborRow`)
        and as the value is set - usually to '0' - it will not be overwritten
        again. To make it work as expected, that value must be overridden. This
        can be done for example in the :file:`Configuration/TCA/Overrides` folder
        of an extension::

            $GLOBALS['TCA']['pages']['ctrl']['useColumnsForDefaultValues'] = 'doktype,fe_group';
