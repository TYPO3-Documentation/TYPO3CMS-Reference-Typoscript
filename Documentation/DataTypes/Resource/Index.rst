.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _data-type-resource:

resource
========

.. container:: table-row

   Data type
         resource

   Examples
         *Reference to a file in the file system:* ::

            fileadmin/picture.gif

         *Reference to a file from the resource field of the TypoScript
         template:* ::

            toplogo*.gif

         Note that the resource field and the possibility to reference files from
         it have been removed in TYPO3 6.0.

   Comment
         #. If the value contains a "/", it is expected to be a reference
            (absolute or relative) to a file in the file system. There is no
            support for wildcard characters in the name of the reference.

         #. If the value does not contain a "/", it is expected to be a reference
            to a file from the resource field in the template. You can write the
            exact filename or you can include an asterisk (\*) as wildcard. It is
            recommended to include an "\*" before the file extension (see the
            example). This will ensure that the file is still referenced
            correctly even if the template is copied (so that the file will have
            its name prepended with a number)!

            **Note:** The resource field in TypoScript templates has been removed
            in TYPO3 6.0. If you used this feature, move the referenced files to
            the folder fileadmin/ or similar and change your TypoScript to refer
            to these resources providing their path in the file system.



