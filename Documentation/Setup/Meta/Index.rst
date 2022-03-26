.. include:: /Includes.rst.txt


.. _meta:

====
meta
====


Properties
==========

.. container:: ts-properties

   ========================= ================================ ====================== =======
   Property                  Data Type                        :ref:`stdwrap`         Default
   ========================= ================================ ====================== =======
   `array of key names`_     string /:ref:`stdWrap <stdwrap>`
   ========================= ================================ ====================== =======


.. _REPLACE-ME-array-of-key-names:

array of key names
------------------

:aspect:`Property:`
   array of key names

:aspect:`Data type:`
   string /:ref:`stdWrap <stdwrap>`

:aspect:`Description:`
   To define meta tags.

   Use the scheme :ts:`meta.key = value`.

   :ts:`value` is the content of the meta tag. If the value is empty (after
   trimming), the meta tag is not generated.

   The :ts:`key` can be the name of any meta tag, for example :html:`description` or
   :html:`keywords`. If the key is :ts:`refresh` (case insensitive), then the
   :html:`http-equiv` attribute is used in the meta tag instead of the :html:`name`
   attribute.

   For each key the following sub-property is available:

   :aspect:`httpEquivalent:`
      If set to 1, the :html:`http-equiv` attribute is used in the meta
      tag instead of the :html:`name` attribute. Default: 0.


:aspect:`Examples:`
   Simple definition::

      meta.description = This is the description of the content in this document.
      meta.keywords = These are the keywords.

   Fetch data from the keywords field of the current or any parent page::

      meta.keywords.data = levelfield:-1, keywords, slide

   Make a meta.refresh entry::

      meta.refresh = [seconds]; [URL, leave blank for same page]

   Usage of :ts:`httpEquivalent`::

      meta.X-UA-Compatible = IE=edge
      meta.X-UA-Compatible.httpEquivalent = 1

   Result:

   .. code-block:: html

      <meta http-equiv="X-UA-Compatible" content="IE=edge">.

   Meta tags with a different attribute name are supported like the
   Open Graph meta tags::

      page {
         meta {
            X-UA-Compatible = IE=edge
            X-UA-Compatible.attribute = http-equiv
            keywords = TYPO3
            og:site_name = TYPO3
            og:site_name.attribute = property
            description = Inspiring people to share Normal
            dc.description = Inspiring people to share [DC tags]
            og:description = Inspiring people to share [OpenGraph]
            og:description.attribute = property
            og:locale = en_GB
            og:locale.attribute = property
            og:locale:alternate {
               attribute = property
               value {
                  1 = fr_FR
                  2 = de_DE
               }
            }
            refresh = 5; url=https://example.org/
            refresh.attribute = http-equiv
         }
      }

   They can be used like :ts:`property` used for OG tags in the example.
   You may also supply multiple values for one name, which results in
   multiple meta tags with the same name to be rendered.

   Result for :ts:`og:description`:

   .. code-block:: html

        <meta property="og:description"
              content="Inspiring people to share [OpenGraph]" />

   See https://ogp.me/ for more information about the Open Graph
   protocol and its properties.
