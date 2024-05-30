..  include:: /Includes.rst.txt
..  index:: Wizards

..  _page-mod-wizard:

=======
wizards
=======

The `wizards` section allows to customize the *New record wizard* and the
*New content element wizard*.

..  contents::
    :local:

..  index:: Wizards; new content element
..  _pagenewcontentelementwizard:

newContentElement.wizardItems
=============================

..  confval-menu::
    :display: tree

    ..  confval:: newContentElement.wizardItems
        :name: mod-wizards-newContentElement-wizardItems
        :type: array
        :Path: mod.wizards.newContentElement.wizardItems

        In the new content element wizard, content element types are grouped
        together by type. Each such group can be configured independently. The
        four default groups are: `common`, `special`, `forms` and `plugins`.

        The configuration options below apply to any group.

        ..  confval:: [group].before
            :name: mod-wizards-newContentElement-wizardItems-group-before
            :type: string
            :Path: mod.wizards.newContentElement.wizardItems.[group].before

            Sorts [group] in front of the group given.

        ..  confval:: [group].after
            :name: mod-wizards-newContentElement-wizardItems-group-after
            :type: string
            :Path: mod.wizards.newContentElement.wizardItems.[group].after

            Sorts [group] after the group given.

        ..  confval:: [group].header
            :name: mod-wizards-newContentElement-wizardItems-group-header
            :type: string | localized string
            :Path: mod.wizards.newContentElement.wizardItems.[group].header

            Name of the group.

        ..  confval:: [group].show
            :name: mod-wizards-newContentElement-wizardItems-group-show
            :type: string, comma-separated list of items
            :Path: mod.wizards.newContentElement.wizardItems.[group].show

            Name of the group.

            Comma-separated list of items to show in the group. Use `*` to show
            all, example:

            ..  code-block:: typoscript
                :caption: EXT:site_package/Configuration/page.tsconfig

                # Hide bulletList
                mod.wizards.newContentElement.wizardItems.common.show := removeFromList(bullets)
                # Only show text and textpic in common
                mod.wizards.newContentElement.wizardItems.common.show = text,textpic


        ..  confval:: [group].elements
            :name: mod-wizards-newContentElement-wizardItems-group-elements
            :type: array
            :Path: mod.wizards.newContentElement.wizardItems.[group].elements

            List of items in the group.

            ..  confval:: [name]
                :name: mod-wizards-newContentElement-wizardItems-group-elements-name
                :type: array
                :Path: mod.wizards.newContentElement.wizardItems.[group].elements.[name]

                Configuration for a single item.

                ..  confval:: iconIdentifier
                    :name: mod-wizards-newContentElement-wizardItems-group-elements-name-iconIdentifier
                    :type: string
                    :Path: mod.wizards.newContentElement.wizardItems.[group].elements.[name].iconIdentifier

                    The icon identifier of the icon you want to display.

                ..  confval:: iconOverlay
                    :name: mod-wizards-newContentElement-wizardItems-group-elements-name-iconOverlay
                    :type: string
                    :Path: mod.wizards.newContentElement.wizardItems.[group].elements.[name].iconOverlay

                    The icon identifier of the overlay icon you want to use.

                ..  confval:: title
                    :name: mod-wizards-newContentElement-wizardItems-group-elements-name-title
                    :type: string | localized string
                    :Path: mod.wizards.newContentElement.wizardItems.[group].elements.[name].title

                    Name of the item.

                ..  confval:: description
                    :name: mod-wizards-newContentElement-wizardItems-group-elements-name-description
                    :type: string | localized string
                    :Path: mod.wizards.newContentElement.wizardItems.[group].elements.[name].description

                    Description text for the item.

                ..  confval:: tt_content_defValues
                    :name: mod-wizards-newContentElement-wizardItems-group-elements-name-tt_content_defValues
                    :type: array
                    :Path: mod.wizards.newContentElement.wizardItems.[group].elements.[name].tt_content_defValues

                    Default values for tt_content fields.

                ..  confval:: saveAndClose
                    :name: mod-wizards-newContentElement-wizardItems-group-elements-name-saveAndClose
                    :type: bool
                    :Path: mod.wizards.newContentElement.wizardItems.[group].elements.[name].saveAndClose
                    :Default: `false`

                    If `true`, directs the user back to the :guilabel:`Page` module
                    directly instead of showing the FormEngine.

..  _pageexample1:

Example: Add a new element to the "common" group
------------------------------------------------

..  literalinclude:: _newContentElementWizard.tsconfig
    :language: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

..  _pageexample2:

Example: Create a new group and add an element to it
----------------------------------------------------

..  literalinclude:: _newContentElementWizardGroup.tsconfig
    :language: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

With the second example, the bottom of the new content element wizard shows:

..  figure:: /Images/ManualScreenshots/List/PageTsModWizardsNewContentElementExample2.png
    :alt: Added entry in the new content element wizard

    Added entry in the new content element wizard

..  index::
    Wizards; record
    New Record wizard; order
..  _mod-wizards-newRecord-order:

newRecord.order
===============

..  confval:: newRecord.order
    :name: mod-wizards-newRecord-order
    :type: list of values

    Define an alternate order for the groups of records in the new records
    wizard. Pages and content elements will always be on top, but the
    order of other record groups can be changed.

    Records are grouped by extension keys, plus the special key "system"
    for records provided by the TYPO3 Core.

..  _mod-wizards-newRecord-order-example:

Example: Place the tt_news group at the top of the new record dialog
--------------------------------------------------------------------

Place the tt_news group at the top (after pages and content
elements), other groups follow unchanged:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.wizards.newRecord.order = tt_news

..  figure:: /Images/ManualScreenshots/List/NewRecordWizardNewOrder.png
    :alt: The position of News changed after modifying the New record screen

    The position of News changed after modifying the New record screen


..  index::
    Wizards; record
    New Record wizard; After page button
    New Record wizard; Inside page button
..  _mod-wizards-newRecord-pages:

newRecord.pages
===============

..  confval:: newRecord.pages
    :name: mod-wizards-newRecord-pages
    :type: boolean

    Use the following sub-properties to show or hide the specified links.
    Setting any of these properties to 0 will hide the corresponding link,
    but setting to 1 will leave it visible.

    show.pageAfter
        Show or hide the link to create new pages after the selected page.

    show.pageInside
        Show or hide the link to create new pages inside the selected page.

    show.pageSelectPosition
        Show or hide the link to create new pages at a selected position.

..  _mod-wizards-newRecord-pages-example:

Example: Hide the "Page (inside)" link in the "New Record" dialog
-----------------------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.wizards.newRecord.pages.show {
        # Hide the "Page (inside)" link.
        pageInside = 0
    }

..  figure:: /Images/ManualScreenshots/List/PageTsModWizardsNewRecordHideInside.png
    :alt: The modified New record screen without Page (inside)

    The modified new record screen without page (inside)
