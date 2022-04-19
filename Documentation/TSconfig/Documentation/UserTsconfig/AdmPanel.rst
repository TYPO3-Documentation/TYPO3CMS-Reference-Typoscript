.. include:: /Includes.rst.txt
.. index:: Admin panel
.. _useradmpanel:

admPanel
========

Configuration of the Admin Panel in the Frontend for the user. This is what
the Admin Panel looks like:

.. figure:: /Images/ManualScreenshots/AdminPanel/UserTsAdminPanel.png
    :alt: The TYPO3 admin panel

For more information about the Admin Panel, see the :ref:`Admin Panel manual
<ext_adminpanel:introduction>`.

The visibility of the Admin Panel depends on being configured in your
frontend TypoScript template for the website. You can do this by inserting this
string in the TypoScript Template:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/user.tsconfig

   # Note this is a frontend TypoScript template and not TSconfig!
   config.admPanel = 1

Example user TSconfig to disable the admin panel for a user:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/user.tsconfig

   admPanel.hide = 1


.. index:: Admin panel; enable

enable
------

:aspect:`Datatype`
    [object]

:aspect:`Description`
    Used to enable the various parts of the panel for users. All values are 0/1 booleans.

    Enable / disable all modules:

    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/user.tsconfig

       admPanel.enable.all = 1

    Enable / disable single parts of the admin panel:

    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/user.tsconfig

       admPanel.enable.cache = 1
       admPanel.enable.debug = 1
       admPanel.enable.edit = 1
       admPanel.enable.info = 1
       admPanel.enable.preview = 1
       admPanel.enable.publish = 1
       admPanel.enable.tsdebug = 1


:aspect:`Default`
    For admin users, `admPanel.enable.all = 1` is default.

    .. note::
       The admin panel is active for all admin users by default. If this does
       not fit the necessary setup, the different modules can be disabled.


.. index:: Admin panel; hide

hide
----

:aspect:`Datatype`
    boolean

:aspect:`Description`
    If set, the panel will not be displayed in the bottom of the page. This only has a visual effect.


.. index:: Admin panel; Settings override

override
--------

:aspect:`Datatype`
    [object]

:aspect:`Description`
    Override single admin panel settings:

    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/user.tsconfig

       admPanel.override.[modulename].[propertyname]

    You have to activate a module first by setting

    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/user.tsconfig

       admPanel.override.[modulename] = 1

    **Most common options**

    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/user.tsconfig

       admPanel.override.preview.showFluidDebug (boolean)
       admPanel.override.preview.showHiddenPages (boolean)
       admPanel.override.preview.showHiddenRecords (boolean)
       admPanel.override.preview.simulateDate (timestamp)
       admPanel.override.preview.simulateUserGroup (integer)
       admPanel.override.cache.noCache (boolean)
       admPanel.override.tsdebug.forceTemplateParsing (boolean)
