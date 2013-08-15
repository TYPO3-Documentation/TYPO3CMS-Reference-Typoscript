.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _data-type-gettext:

getText
=======

.. container:: table-row

   Data type
         getText

   Examples
         .. For help about t3-field-list-table see
            http://mbless.de/4us/typo3-oo2rest/06-The-%5Bfield-list-table%5D-directive/1-demo.rst.html

         .. t3-field-list-table::
          :header-rows: 1

          - :dt:
                Example

            :dd:
                Comment

          - :dt:
            :dd:
                This returns a value from somewhere in a PHP array, as defined by the
                type. The syntax is "type : pointer". The type is case-insensitive.

          - :dt:
               **= field : header**

               *get content from the $cObj->data-array[header]*

            :dd:
                **field:** [field name from the current *$cObj* ->data-array in the
                cObject.]

                As default the *$cObj* ->data-array is $GLOBALS['TSFE']->page (record
                of the current page!)

                In TMENU: *$cObj* ->data is set to the page-record for each menu
                item.

                In CONTENT/RECORDS *$cObj* ->data is set to the actual record

                In GIFBUILDER *$cObj* ->data is set to the data GIFBUILDER is
                supplied with.

          - :dt:
                **= parameters : color**

                *get content from the $cObj->parameters-array[color]*

            :dd:
                **parameters:** [field name from the current *$cObj* ->parameters-
                array in the cObject.]

                See ->parseFunc!

          - :dt:
                **= register : color**

                *get content from the $GLOBALS['TSFE']->register[color]*

            :dd:
                **register:** [field name from the $GLOBALS['TSFE']->register]

                See cObject "LOAD\_REGISTER"!

          - :dt:
                **= leveltitle : 1**

                *get the title of the page on the first level of the rootline*

                **= leveltitle : -2 , slide**

                *get the title of the page on the level right below the current page
                AND if that is not present, walt to the bottom of the rootline until
                there's a title*

                **= leveluid : 0**

                *get the id of the root-page of the website (level zero)*

            :dd:
                **leveltitle, leveluid, levelmedia:** [levelTitle, uid or media in
                rootLine, 0- , negative = from behind, " , slide" parameter forces a
                walk to the bottom of the rootline until there's a "true" value to
                return. Useful with levelmedia.]

          - :dt:
                **= levelfield : -1 , user\_myExtField , slide**

                *get the value of the user defined field "user\_myExtField" in the
                root line (requires additional configuration in $TYPO3\_CONF\_VARS to
                include field!)*

            :dd:
                **levelfield:** Like "leveltitle" et al. but where the second
                parameter is the rootLine field you want to fetch. Syntax: [pointer,
                integer], [field name], ["slide"]

          - :dt:
                **= global : HTTP\_COOKIE\_VARS \| some\_cookie**

                *get the env variable $HTTP\_COOKIE\_VARS[some\_cookie]*

            :dd:
                **global:** [GLOBAL-var, split with \| if you want to get from an
                array! Deprecated, use GP, TSFE or getenv]

          - :dt:
                **= date : d-m-y**

                *get the current time formatted dd-mm-yy*

            :dd:
                **date:** [date-conf]. Can also be used without colon and date
                configuration. Then the date will be formatted as "d/m Y".

          - :dt:
                **= page : title**

                *get the current page-title*

            :dd:
                **page:** [current page record]

          - :dt:
                **= current**

                *get the current value*

            :dd:
                **current** (gets the 'current' value)

          - :dt:
                **= level**

                *get the rootline level of the current page*

            :dd:
                **level** (gets the rootline level of the current page)

          - :dt:
                **= GP : stuff**

                *get input value from query string, (&stuff=)*

                **= GP : stuff \| key**

                *get input value from query string, (&stuff[key]=)*

            :dd:
                **GP:** Value from GET or POST method. Use this instead of global

                **GPvar: Usage of "GPvar" is deprecated. Use "GP" instead!**

          - :dt:
                **= getenv : HTTP\_REFERER**

                *get the env var HTTP\_REFERER*

            :dd:
                **getenv:** Value from environment variables

          - :dt:
                **= getIndpEnv : REMOTE\_ADDR**

                *get the client IP*

            :dd:
                **getIndpEnv:** Value from
                TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv() (t3lib\_div::getIndpEnv())

          - :dt:
                **= DB : tt\_content:234:header**

                *get the value of the header of record with uid 234 from table
                tt\_content*

            :dd:
                **DB:** Value from database, syntax is [table name] : [uid] : [field].
                Any record from a table in TCA can be selected here. Only marked-
                deleted records does not return a value here.

          - :dt:
                **= file : 17 : size**

                *(Since TYPO3 6.0) get the file size of the file with the
                sys\_file UID 17.*

            :dd:
                **file:** syntax is [uid] : [property]. Retrieves a property from a
                file object (FAL) by identifying it through its sys\_file UID. Note
                that during execution of the FILES cObject, you can also reference the
                current file with "current" as UID like "file : current : size".

                |

                The following properties are available:

                name, size, sha1, extension, MIME type, contents, publicUrl, localPath

                |

                Furthermore when manipulating references (such as images in content
                elements or media in pages), additional properties are available (not
                all are available all the time, it depends on the setup of *references*
                of the FILES cObject):

                title, description, link, alternative

                |

                See the :ref:`FILES cObject for usage examples <cobj-files-examples>`.

          - :dt:
                **= fullRootLine : -1, title**

                *get the title of the page right before the start of the current
                website*

            :dd:
                **fullRootLine:** syntax is [pointer, integer], [field name],
                ["slide"]

                This property can be used to retrieve values from "above" the current
                page's root. Take the below page tree and assume that we are on the
                page "Here you are!". Using the "levelfield" propertydescribed above,
                it is possible to goup only to the page "Site root", because it is the
                root of a new (sub-)site. With "fullRootLine" it is possible to go all
                the way up to page tree root. The numbers between square brackets
                indicate to which page each value of *pointer* would point to::

                  - Page tree root [-2]
                    |- 1. page before [-1]
                      |- Site root (root template here!) [0]
                        |- Here you are! [1]

                A "slide" parameter can be added just as for the "levelfield" property
                above.

          - :dt:
                **= LLL:EXT:css\_styled\_content/pi1/locallang.xlf:login.logout**

                *get localized label for logout button*

            :dd:
                **LLL:** Reference to a locallang (xlf, xml or php) label. Reference
                consists of [fileref]:[labelkey]

          - :dt:
                **= path:EXT:ie7/js/ie7-standard.js**

                *get path to file relative to siteroot possibly placed in an
                extension*

            :dd:
                **path:** path to a file, possibly placed in an extension, returns
                empty if the file does not exist.

          - :dt:
                **= cObj : parentRecordNumber**

                *get the number of the current cObject record*

            :dd:
                **cObj:** [internal variable from list: "parentRecordNumber"]: For
                CONTENT and RECORDS cObjects that are returned

                by a select query, this returns the row number (1,2,3,...) of the
                current cObject record.

          - :dt:
                **= debug : rootLine**

                *output the current root-line visually in HTML*

            :dd:
                **debug:** Returns HTML formatted content of the PHP variable defined
                by the keyword. Available keywords are "rootLine", "fullRootLine",
                "data", "register" and "page".

          - :dd:
                **Getting array/object elements**

                You can fetch the value of an array/object by splitting it with a pipe
                "\|".Example::

                   = TSFE:fe_user|user|username

          - :dd:
                **Getting more values**

                By separating the value of getText with "//" (double slash) you let
                getText fetch the first value. If it appears empty ("" or zero) the
                next value is fetched and so on. Example::

                   = field:header // field:title // field:uid

                This gets "title" if "header" is empty. If "title" is also empty it
                gets field "uid"


.. toctree::
   :maxdepth: 5
   :titlesonly:
   :glob:

   Getindpenv/Index
