..  include:: /Includes.rst.txt
..  index::
    User settings; override
    User settings; default
..  _usersetup:
..  _user-setup:

=====
setup
=====

Default values and override values for the :guilabel:`User Settings` module.

The :guilabel:`User > User settings` module may only represent a subset of the options from the table below.

..  figure:: /Images/ManualScreenshots/UserSettings/UserSettings.png
    :alt: Default values and overriding values in the "User > User settings" module

    Default values and overriding values in the :guilabel:`User > User settings` module

Properties from the list below are available the different prefixes `setup.default` and `setup.override`,
and there is another prefix to hide single fields:

..  _user-setup-properties:

Properties
==========

..  contents::
    :depth: 2
    :local:

..  _user-setup-default:

setup.default.[someProperty]
----------------------------

..  confval:: setup.default.[someProperty]
    :name: user-setup-default
    :type: any

    This sets *default* values of the property. A user may override these
    using its :guilabel:`User Settings` module. This affects only *new* users who did
    not login yet. It is not usually not possible to set new defaults for users
    who already logged in at least once. The only way to apply new defaults to
    existing users is by :guilabel:`Reset Backend User Preferences` in the
    :guilabel:`Admin tools > Maintenance` section of the install tool.

    ..  literalinclude:: _Setup/_user-setup-default.tsconfig
        :language: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig


..  _user-setup-override:

setup.override.[someProperty]
-----------------------------

..  confval:: setup.override.[someProperty]
    :name: user-setup-override
    :type: mixed

    This forces values for the properties of the list below, a user can not override these
    setting in its :guilabel:`User settings` module. So, overriding values will be impossible for the
    user to change himself and no matter what the current value is, the overriding
    value will overrule it.

    ..  attention::
        There is a tricky aspect to these `setup.override`: If first you have set a
        value by `setup.override` and then remove it again, you will experience
        that the value persists to exist. This is because it is saved in the
        backend user's profile. Therefore, if you have once set a value, do
        *not* remove it again but rather set it blank if you want to disable
        the effect again!

..  _user-setup-fields-fieldName-disabled:

setup.fields.[fieldName].disabled
---------------------------------

..  confval:: setup.fields.[fieldName].disabled
    :name: user-setup-fields-fieldName-disabled
    :type: boolean

    On top of being able to set default values or override them, it is also possible to
    hide fields in the :guilabel:`User Settings` module, using `setup.fields.[fieldName].disabled = 1`.
    You can find the names of the fields in the :guilabel:`Configuration` module by browsing the "User Settings" array, example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        # Do not show the 'emailMeAtLogin' field to the user in "User Settings" module
        setup.fields.emailMeAtLogin.disabled = 1

        # And force the value of this field to be set to 1
        setup.override.emailMeAtLogin = 1

..  index::  User settings; Format of window title in backend

..  _user-setup-backendTitleFormat:

backendTitleFormat
------------------

..  confval:: backendTitleFormat
    :name: user-setup-backendTitleFormat
    :type: string

    Format of window title in backend. Possible values:

    `titleFirst`
        [title] · [sitename]
    `sitenameFirst`
        [sitename] · [title]


..  index:: User settings; Copy levels

..  _user-setup-copyLevels:

copyLevels
----------

..  confval:: copyLevels
    :name: user-setup-copyLevels
    :type: positive integer

    Recursive Copy: Enter the number of page sub-levels to include, when a page is copied


..  index:: File upload; In doc module

..  _user-setup-edit-docModuleUpload:

edit_docModuleUpload
--------------------

..  confval:: edit_docModuleUpload
    :name: user-setup-edit-docModuleUpload
    :type: boolean

    Allow file upload directly from file reference fields within backend forms.

    ..  note::
        The uploaded file will be stored in the default upload folder,
        see :ref:`user TSconfig <useroptions-defaultUploadFolder>` and :ref:`page TSconfig <pagedefaultuploadfolder>`


..  index:: Email me at login

..  _user-setup-emailMeAtLogin:

emailMeAtLogin
--------------

..  confval:: emailMeAtLogin
    :name: user-setup-emailMeAtLogin
    :type:  boolean

    Notify me by email, when somebody logs into my account


..  index:: Backend; Language

..  _user-setup-lang:

lang
----

..  confval:: lang
    :name: user-setup-lang
    :type: language-key

    One of the language keys. For current options see
    :ref:`t3coreapi:i18n_languages`, for example `dk`, `de`, `es` etc.


..  index:: Records; Hide at copy

..  _user-setup-neverHideAtCopy:

neverHideAtCopy
---------------

..  confval:: neverHideAtCopy
    :name: user-setup-neverHideAtCopy
    :type: boolean

    If set, then the hideAtCopy feature for records in TCE will not be used.


..  index:: File list; Show hidden files and folders

..  _user-setup-showHiddenFilesAndFolders:

showHiddenFilesAndFolders
-------------------------

..  confval:: showHiddenFilesAndFolders
    :name: user-setup-showHiddenFilesAndFolders
    :type: boolean

    If set, hidden files and folders will be shown in the filelist.


..  index:: Start module

..  _user-setup-startModule:

startModule
-----------

..  confval:: startModule
    :name: user-setup-startModule
    :type: string

    Name of the module that is called when the user logs into the backend, for
    example `web_layout`, `web_list`, `web_view`, `web_info`, `web_ts` etc.


..  index:: Title length, max

..  _user-setup-titleLen:

titleLen
--------

..  confval:: titleLen
    :name: user-setup-titleLen
    :type: positive integer

    Maximum length of rendered record titles in the backend interface.
    It is used in several places: page tree, edit masks, workspace module, etc.

    ..  tip::
        To find out where this setting is applied, set it to a low number.
