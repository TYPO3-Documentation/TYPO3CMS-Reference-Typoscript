..  include:: /Includes.rst.txt
..  index:: Backend; Redirect after login
..  _user-auth:

====
auth
====

The `auth` key is used for configuration of authentication services.

..  _user-auth-properties:

Properties
==========

..  contents::
    :depth: 2
    :local:

..  _user-auth-be-redirectToURL:

auth.BE.redirectToURL
---------------------

..  confval:: auth.BE.redirectToURL
    :name: user-auth-be-redirectToURL
    :type: string

    Specifies a URL to redirect to after login is performed in the backend login form. This
    has been used in the past to redirect a backend user to the frontend to use frontend editing.

..  _user-auth-mfa-required:

auth.mfa.required
-----------------

..  confval:: auth.mfa.required
    :name: user-auth-mfa-required
    :type: boolean

    Require multi-factor authentication for a user. This overrules the global configuration
    and can therefore also be used to unset the requirement by using `0` as value.

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        auth.mfa.required = 1

..  _user-auth-mfa-disableProviders:

auth.mfa.disableProviders
-------------------------

..  confval:: auth.mfa.disableProviders
    :name: auth.mfa.disableProviders
    :type: string, comma separated list of strings

    Disable multi-factor authentication providers for the current user or group.
    It overrules the configuration from the Backend usergroup "Access List". This
    means, if a provider is allowed in "Access List" but disallowed with TSconfig,
    it will be disallowed for the user or user group.

..  _user-auth-mfa-disableProviders-example:

Example: Disable a multi-factor authentication provider
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/user.tsconfig

    auth.mfa.disableProviders := addToList(totp)

..  _user-auth-mfa-recommendedProvider:

auth.mfa.recommendedProvider
----------------------------

..  confval:: auth.mfa.recommendedProvider
    :name: auth.mfa.recommendedProvider
    :type: string

    Set a recommended multi-factor authentication provider on a per user or user group basis, which overrules
    the global configuration.

..  _user-auth-mfa-recommendedProvider-example:

Example: Set a recommended multi-factor authentication provider
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/user.tsconfig

    auth.mfa.recommendedProvider = totp
