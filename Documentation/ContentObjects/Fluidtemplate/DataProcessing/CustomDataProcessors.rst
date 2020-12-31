.. include:: /Includes.txt
.. _CustomDataProcessors:

=====================
Custom dataProcessors
=====================

Last but not least, it is possible to create your own data processors and
use them in a `FLUIDTEMPLATE` content object::

      my_custom_ctype = FLUIDTEMPLATE
      my_custom_ctype {
         templateName = CustomName
         templateRootPaths {
            10 = EXT:site_default/Resources/Private/Templates
         }
         settings {
            extraParam = 1
         }
         dataProcessing {
            1 = Vendor\YourExtensionKey\DataProcessing\MyFirstCustomProcessor
            2 = Vendor2\AnotherExtensionKey\DataProcessing\MySecondCustomProcessor
            2 {
               options {
                  myOption = SomeValue
               }
            }
         }
      }

