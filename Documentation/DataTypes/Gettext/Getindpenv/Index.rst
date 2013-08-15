.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _gettext-getIndpEnv:

getIndpEnv
==========

Example: Show available values in a html table:

.. code-block:: typoscript

      # TypoScript setup code:

      page = PAGE
      page.10 = COA
      page.10 {
        wrap = <table style="border:1px solid #999"> | </table>
        111 = TEXT
        111.htmlSpecialChars = 1
        111.outerWrap = <tr>|</tr>
        112 < .111
        113 < .111
        114 < .111
        115 < .111
        116 < .111
        117 < .111
        118 < .111
        119 < .111
        120 < .111
        121 < .111
        122 < .111
        123 < .111
        124 < .111
        125 < .111
        126 < .111
        127 < .111
        128 < .111
        129 < .111
        130 < .111
        131 < .111
        132 < .111
        111.data = getIndpEnv:HTTP_ACCEPT_LANGUAGE
        111.wrap = <td>getIndpEnv:HTTP_ACCEPT_LANGUAGE</td><td> | </td>
        112.data = getIndpEnv:HTTP_HOST
        112.wrap = <td>getIndpEnv:HTTP_HOST</td><td> | </td>
        113.data = getIndpEnv:HTTP_REFERER
        113.wrap = <td>getIndpEnv:HTTP_REFERER</td><td> | </td>
        114.data = getIndpEnv:HTTP_USER_AGENT
        114.wrap = <td>getIndpEnv:HTTP_USER_AGENT</td><td> | </td>
        115.data = getIndpEnv:PATH_INFO
        115.wrap = <td>getIndpEnv:PATH_INFO</td><td> | </td>
        117.data = getIndpEnv:REMOTE_ADDR
        117.wrap = <td>getIndpEnv:REMOTE_ADDR</td><td> | </td>
        118.data = getIndpEnv:REMOTE_HOST
        118.wrap = <td>getIndpEnv:REMOTE_HOST</td><td> | </td>
        119.data = getIndpEnv:REQUEST_URI
        119.wrap = <td>getIndpEnv:REQUEST_URI</td><td> | </td>
        120.data = getIndpEnv:SCRIPT_FILENAME
        120.wrap = <td>getIndpEnv:SCRIPT_FILENAME</td><td> | </td>
        121.data = getIndpEnv:SCRIPT_NAME
        121.wrap = <td>getIndpEnv:SCRIPT_NAME</td><td> | </td>
        122.data = getIndpEnv:TYPO3_DOCUMENT_ROOT
        122.wrap = <td>getIndpEnv:TYPO3_DOCUMENT_ROOT</td><td> | </td>
        123.data = getIndpEnv:TYPO3_HOST_ONLY
        123.wrap = <td>getIndpEnv:TYPO3_HOST_ONLY</td><td> | </td>
        124.data = getIndpEnv:TYPO3_PORT
        124.wrap = <td>getIndpEnv:TYPO3_PORT</td><td> | </td>
        125.data = getIndpEnv:TYPO3_REQUEST_DIR
        125.wrap = <td>getIndpEnv:TYPO3_REQUEST_DIR</td><td> | </td>
        126.data = getIndpEnv:TYPO3_REQUEST_HOST
        126.wrap = <td>getIndpEnv:TYPO3_REQUEST_HOST</td><td> | </td>
        127.data = getIndpEnv:TYPO3_REQUEST_SCRIPT
        127.wrap = <td>getIndpEnv:TYPO3_REQUEST_SCRIPT</td><td> | </td>
        128.data = getIndpEnv:TYPO3_REQUEST_URL
        128.wrap = <td>getIndpEnv:TYPO3_REQUEST_URL</td><td> | </td>
        129.data = getIndpEnv:TYPO3_REV_PROXY
        129.wrap = <td>getIndpEnv:TYPO3_REV_PROXY</td><td> | </td>
        130.data = getIndpEnv:TYPO3_SITE_SCRIPT
        130.wrap = <td>getIndpEnv:TYPO3_SITE_SCRIPT</td><td> | </td>
        131.data = getIndpEnv:TYPO3_SITE_URL
        131.wrap = <td>getIndpEnv:TYPO3_SITE_URL</td><td> | </td>
        132.data = getIndpEnv:TYPO3_SSL
        132.wrap = <td>getIndpEnv:TYPO3_SSL</td><td> | </td>
      }

