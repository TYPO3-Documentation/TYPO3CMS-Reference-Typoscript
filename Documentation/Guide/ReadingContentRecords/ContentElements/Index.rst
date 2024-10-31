.. include:: /Includes.rst.txt


.. _content-objects:
.. _content-elements:
.. _the-various-content-objects:

============================
The various content elements
============================

The setup we just defined is pretty basic and will work only for content
elements containing text. But the content elements are varied and we also need
to render images, forms, etc. and we do not want to define everything in
TypoScript - using HTML templates would be more convenient.

The type of a content element is stored in the column
`CType` of table "tt\_content". We can use this information
with a :ref:`CASE <cobj-case>` object, which makes it possible to
differentiate how the individual content element types are rendered.

The following code is the default TypoScript rendering definition as taken from
the TYPO3 Core. The default `renderObj` of a table is a TypoScript
definition named after that table. In case of content in TYPO3 the table is
called `tt_content` therefore the default `renderObj` is also called
`tt_content`::

   # Content element rendering taken from typo3/sysext/frontend/ext_localconf.php
   tt_content = CASE
   tt_content {
      key {
         # The field CType will be used to differentiate.
         field = CType
      }
      # Render a error message in case no specific rendering definition is found
      default = TEXT
      default {
         field = CType
         htmlSpecialChars = 1
         wrap = <p style="background-color: yellow; padding: 0.5em 1em;"><strong>ERROR:</strong> Content Element with uid "{field:uid}" and type "|" has no rendering definition!</p>
         wrap.insertData = 1
      }
   }

The basic extension for rendering content in TYPO3 since TYPO3 v8 is
`fluid_styled_content`. The example shows how
`fluid_styled_content` is set up: It defines a basic content element based
on the content object `FLUIDTEMPLATE` which is able to render html
templates using the `fluid` templating engine. For every content element,
the basic template, layout and partial parts are defined. As you can see by
looking at the lines starting with `10 =` there is the possibility to
add your own templates by setting the corresponding `constant` (in the
`Constants` section of a TypoScript template)::

   # Taken from typo3/sysext/fluid_styled_content/Configuration/TypoScript/Helper/ContentElement.txt
   lib.contentElement = FLUIDTEMPLATE
   lib.contentElement {
      templateName = Default
      templateRootPaths {
         0 = EXT:fluid_styled_content/Resources/Private/Templates/
         10 = {$styles.templates.templateRootPath}
      }
      partialRootPaths {
         0 = EXT:fluid_styled_content/Resources/Private/Partials/
         10 = {$styles.templates.partialRootPath}
      }
      layoutRootPaths {
         0 = EXT:fluid_styled_content/Resources/Private/Layouts/
         10 = {$styles.templates.layoutRootPath}
      }
      # ...
   }


Each content element inherits that configuration. As an example take a look at
the content element definition of the content element of type `header`::

   # Header Only:
   # Adds a header only.
   #
   # CType: header
   # Taken from typo3/sysext/fluid_styled_content/Configuration/TypoScript/ContentElement/Header.txt
   tt_content.header =< lib.contentElement
   tt_content.header {
      templateName = Header
   }

First, all configuration options defined in `lib.contentElement` are
referenced. Then the `templateName` for rendering a content element of
type `header` is set - in this case `Header`. This tells fluid to
look for a
`Header.html` in the defined template path(s) (see above, by default in
`EXT:fluid_styled_content/Resources/Private/Templates/`).

To adjust how the default elements are rendered you can overwrite the templates
in your own site package extension and set the TypoScript constants defining
the paths (see above). In your own templates you have the data of the currently
rendered content element available in the {data} fluid variable. For example
take a look at how the text element is rendered:

.. code-block:: html

   # Taken from typo3/sysext/fluid_styled_content/Resources/Private/Templates/Text.html
   <html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers" data-namespace-typo3-fluid="true">
   <f:layout name="Default" />
   <f:section name="Main">
      <f:format.html>{data.bodytext}</f:format.html>
   </f:section>
   </html>

The database field `bodytext` from the `tt_content` table (which is
the main text input field for content elements of type `text`) is
available as `{data.bodytext}` in the fluid template. For more
information about `fluid_styled_content` see its :doc:`manual
<typo3/cms-fluid-styled-content:Index>`.
