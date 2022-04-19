.. include:: /Includes.rst.txt
.. index:: Backend; Redirect after login

====
auth
====

The `auth` key is used for configuration of authentication services.

auth.BE.redirectToURL
    Specifies a URL to redirect to after login is performed in the backend login form. This
    has been used in the past to redirect a backend user to the frontend to use frontend editing.

auth.mfa.required
    Require multi-factor authentication for a user. This overrules the global configuration
    and can therefore also be used to unset the requirement by using `0` as value.

     .. code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        auth.mfa.required = 1

auth.mfa.disableProviders
    Disable multi-factor authentication providers for the current user or group.
    It overrules the configuration from the Backend usergroup "Access List". This
    means, if a provider is allowed in "Access List" but disallowed with TSconfig,
    it will be disallowed for the user or user group.

     .. code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        auth.mfa.disableProviders := addToList(totp)

auth.mfa.recommendedProvider
   Set a recommended multi-factor authentication provider on a per user or user group basis, which overrules
   the global configuration.

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      auth.mfa.recommendedProvider = totp
