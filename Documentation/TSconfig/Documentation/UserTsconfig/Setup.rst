.. include:: /Includes.rst.txt
.. index::
   User settings; override
   User settings; default
.. _usersetup:

=====
setup
=====

Default values and override values for the :guilabel:`User Settings` module.

The :guilabel:`User > User settings` module may only represent a subset of the options from the table below.

.. figure:: /Images/ManualScreenshots/UserSettings/UserSettings.png
    :alt: Default values and overriding values in the "User > User settings" module

    Default values and overriding values in the :guilabel:`User > User settings` module

Properties from the list below are available the different prefixes `setup.default` and `setup.override`,
and there is another prefix to hide single fields:

setup.default.[someProperty]
    This sets *default* values of the property. A user may override these
    using its :guilabel:`User Settings` module. This affects only *new* users who did
    not login yet. It is not usually not possible to set new defaults for users
    who already logged in at least once. The only way to apply new defaults to
    existing users is by :guilabel:`Reset Backend User Preferences` in the
    :guilabel:`Admin tools > Maintenance` section of the install tool.

    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/user.tsconfig

       [backend.user.isAdmin]
          # Some settings an administrator might find helpful
          setup.default {
             recursiveDelete = 1
             copyLevels = 99
             moduleData {
                # Defaulting some options of the Template/TypoScript backend module
                web_ts {
                   # Pre-select 'Object browser' instead of 'Constant editor'
                   function = TYPO3\CMS\Tstemplate\Controller\TypoScriptTemplateObjectBrowserModuleFunctionController
                   # Pre-select 'Setup' instead of 'Constants'
                   ts_browser_type = setup
                   # The other settings
                   ts_browser_const = subst
                   ts_browser_fixedLgd = 0
                   ts_browser_showComments = 1
                }
             }
          }
       [END]

setup.override.[someProperty]
    This forces values for the properties of the list below, a user can not override these
    setting in its :guilabel:`User settings` module. So, overriding values will be impossible for the
    user to change himself and no matter what the current value is, the overriding
    value will overrule it.

    .. attention::

        There is a tricky aspect to these `setup.override`: If first you have set a
        value by `setup.override` and then remove it again, you will experience
        that the value persists to exist. This is because it is saved in the
        backend user's profile. Therefore, if you have once set a value, do
        *not* remove it again but rather set it blank if you want to disable
        the effect again!

setup.fields.[fieldName].disabled
    On top of being able to set default values or override them, it is also possible to
    hide fields in the :guilabel:`User Settings` module, using `setup.fields.[fieldName].disabled = 1`.
    You can find the names of the fields in the :guilabel:`Configuration` module by browsing the "User Settings" array, example:

    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/user.tsconfig

       # Do not show the 'emailMeAtLogin' field to the user in "User Settings" module
       setup.fields.emailMeAtLogin.disabled = 1

       # And force the value of this field to be set to 1
       setup.override.emailMeAtLogin = 1


.. index::
   User settings; Format of window title in backend

backendTitleFormat
==================

:aspect:`Datatype`
   string

:aspect:`Description`
   Format of window title in backend. Possible values:

   `titleFirst`
      [title] · [sitename]
   `sitenameFirst`
      [sitename] · [title]


.. index::
   User settings; Copy levels

copyLevels
==========

:aspect:`Datatype`
    positive integer

:aspect:`Description`
    Recursive Copy: Enter the number of page sub-levels to include, when a page is copied


.. index:: File upload; In doc module

edit_docModuleUpload
====================

:aspect:`Datatype`
    boolean

:aspect:`Description`
    File upload directly in Doc. module


.. index:: Email me at login

emailMeAtLogin
==============

:aspect:`Datatype`
    boolean

:aspect:`Description`
    Notify me by email, when somebody logs in from my account


.. index:: Backend; Language

lang
====

:aspect:`Datatype`
    language-key

:aspect:`Description`
    One of the language-keys. For current options see
    :file:`typo3/sysext/core/Classes/Localization/Locales.php`, e.g. `dk`, `de`, `es` etc.


.. index:: Records; Hide at copy

neverHideAtCopy
===============

:aspect:`Datatype`
    boolean

:aspect:`Description`
    If set, then the hideAtCopy feature for records in TCE will not be used.


.. index:: Start module

startModule
===========

:aspect:`Datatype`
    string

:aspect:`Description`
    Name of the module that is called when the user logs into the Backend


.. index:: Title length, max

titleLen
========

:aspect:`Datatype`
    positive integer

:aspect:`Description`
    Max. Title Length
