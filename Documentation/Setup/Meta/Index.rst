
.. include:: ../../Includes.txt


.. _meta:

meta
====

.. only:: html

   .. contents::
      :local:
      :depth: 1

Properties
^^^^^^^^^^

.. container:: ts-properties

   ========================= ================================ ====================== =======
   Property                  Data Type                        :ref:`stdwrap`         Default
   ========================= ================================ ====================== =======
   `(array of key names)`_   string /:ref:`stdWrap <stdwrap>`
   ========================= ================================ ====================== =======

Property details
^^^^^^^^^^^^^^^^

.. only:: html

   .. contents::
      :local:
      :depth: 1

.. ### BEGIN~OF~TABLE ###


.. _REPLACE-ME-array-of-key-names:

(array of key names)
""""""""""""""""""""

.. container:: table-row

   Property
         *(array of key names)*

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Allows you to define meta tags.

         Use the scheme *meta.key = value*.

         The "key" can be the name of any meta tag, e.g. "description" or
         "keywords". If the key is "refresh" (case insensitive), then the
         "http-equiv" attribute is used in the meta tag instead of the "name"
         attribute.

         "value" is the content of the meta tag. If the value is empty (after
         trimming), the meta tag is not generated.

         **Examples:** ::

            meta.description = This is the description of the content in this document.
            meta.keywords = These are the keywords.
            # Get value from "keywords" field of the current or any parent page
            meta.keywords.data = levelfield:-1, keywords, slide
            meta.refresh = [seconds]; [URL, leave blank for same page]

         For each key the following sub-property is available:

         **httpEquivalent:** If set to 1, the http-equiv attribute is used in the meta
         tag instead of the "name" attribute. Default: 0.

         **Example:** ::

            meta.X-UA-Compatible = IE=edge,chrome=1
            meta.X-UA-Compatible.httpEquivalent = 1

         This results in <meta http-equiv="X-UA-Compatible"
         content="IE=edge,chrome=1">.

         Meta tags with a different attribute name are supported like the Open Graph meta tags.

         **Example:** ::

            page {
               meta {
                  X-UA-Compatible = IE=edge,chrome=1
                  X-UA-Compatible.attribute = http-equiv

                  keywords = TYPO3

                  og:site_name = TYPO3
                  og:site_name.attribute = property

                  description = Inspiring people to share Normal

                  dc\.description = Inspiring people to share [DC tags]

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

                  refresh = 5; url=http://example.com/
                  refresh.attribute = http-equiv
               }
            }

         They can be used like :ts:`property` used for OG tags in the example.
         You may also supply multiple values for one name, which results in
         multiple meta tags with the same name to be rendered.

         **Result for og:description:** ::

            <meta property="og:description" content="Inspiring people to share [OpenGraph]" />

         See http://ogp.me/ for more information about the Open Graph
         protocol and its properties.






.. ###### END~OF~TABLE ######
