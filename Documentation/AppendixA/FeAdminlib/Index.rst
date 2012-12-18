.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _appendix-fe-adminlib:

fe\_adminLib.inc
^^^^^^^^^^^^^^^^


Files:
""""""

.. t3-field-list-table::
 :header-rows: 1

 - :File:
         File

   :Description:
         Description

 - :File:
         fe\_adminLib.inc

   :Description:
         Main class used to display the frontend administration forms.

         Call it from a USER\_INT cObject with 'userFunc =
         user\_feAdmin->init'. See the static\_templates for examples.

         **Note:** Using the USER\_INT cObject allows the script to work
         regardless of the page-cache which is necessary!

 - :File:
         fe\_admin\_dmailsubscrip.tmpl

   :Description:
         Example template file for subscription to newsletters of users to the
         tt\_address table. This template is used by the static\_template
         'plugin.feadmin.dmailsubscription'.

 - :File:
         fe\_admin\_fe\_users.tmpl

   :Description:
         Example template file for creating new frontend users (fe\_users).
         This template is used by the static\_template
         'plugin.feadmin.fe\_users'.


.. _appendix-fe-adminlib-description:

Description
"""""""""""

This class is used to create forms for database-administration in the
frontend *independently of the backend (BE)*. Thus you may want to
use this, if you like frontend users to edit database content.

Authentication either goes through fe\_user login in which case you
can stamp the records with the fe\_user\_uid so a record belongs to a
certain fe\_user. The other authentication option is email
authentication. In this case you have access to the record if your
email is found in a certain field. By fe\_user authentication you can
get a menu of items to edit when you're logged in. With email-
authentication, you can request an email to be sent to your email
address. This email contains a list of the available records.

It is all based on HTML-template files which you have to design by
yourself, so there is some design work to do. On the other hand you get
total freedom to design your forms.


Example:
~~~~~~~~

See static\_templates 'plugin.feadmin.\*' for various examples. Test
them configured on the TYPO3 test site.


.. _appendix-fe-adminlib-template:

Static template
"""""""""""""""

plugin.feadmin.\*


.. _appendix-fe-adminlib-get-post:

Incoming GET or POST vars:
""""""""""""""""""""""""""

.. ### BEGIN~OF~SIMPLE~TABLE ###

============  ===================
   Name:         Description:
============  ===================
   cmd           Command
   preview       Preview flag
   backURL       Back URL
   rU            Record UID
   aC            Authentication Code
   fD            Fixed Data (array of fields)
   FE            Frontend Edit data array. Syntax: FE[*table name*][*field name*] = value
============  ===================

.. ###### END~OF~SIMPLE~TABLE ######


.. _appendix-fe-adminlib-properties:

fe\_adminLib.inc properties
"""""""""""""""""""""""""""

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:

   Data type
         Data type:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Property
         templateFile

   Data type
         resource

   Description
         The template file.


.. container:: table-row

   Property
         templateContent

   Data type
         string

   Description
         Alternatively you can set this property directly to the value of the
         template.


.. container:: table-row

   Property
         table

   Data type
         string

   Description
         The name of the table to edit.

         **Note:** The ultimate list of fields allowed to be edited for the table
         is defined in TCA with the key ["feInterface"]["fe\_admin\_fieldList"]
         for each table in question. For an example, see the table definition
         for fe\_users which is a good example.


.. container:: table-row

   Property
         defaultCmd

   Data type
         string

   Description
         Defines which action should be default (if &cmd= is not set when
         calling the page)


.. container:: table-row

   Property
         clearCacheOfPages

   Data type
         *(list of integers)*

   Description
         This is a list of page-ids for which to clear the cache on any
         successful operation be it EDIT, CREATE or DELETE.


.. container:: table-row

   Property
         debug

   Data type
         boolean

   Description
         If set, debug information will be output from fe\_adminLib which helps
         to track errors.


.. container:: table-row

   Property
         **Actions:**


.. container:: table-row

   Property
         edit

   Data type
         boolean /actionObject

   Description
         If set, editing is basically allowed.

         But you need to specify:

         **.fields:** List of field names. Determines the fields allowed
         for editing. Every field in this list must be found as well in the
         ["feInterface"]["fe\_admin\_fieldList"] found in the TCA array which
         ultimately determines which fields can be edited by the fe\_adminLib.

         **.overrideValues.[field name]:** Value string. Defines values for
         specific fields which will override ANY input from the form.
         Overriding values happens after the outside values has been parsed by
         the .parseValues-property of fe\_adminLib but before the evaluation by
         .required and .evalValues below. For example this may be useful if you
         wish to hide a record which is being edited, because you want to
         preview it first.

         **.required:** List of field names, subset of .fields.
         Determines which fields are required to return a true value. The valid
         fields entered here will have the subpart ###SUB\_REQUIRED\_FIELD\_
         *[field name]* ### removed from the templates if they evaluates to
         being true and thereby OK. See below for information about this
         subpart.

         **.evalValues.[field name]:** List of eval-codes. Defines specific
         evaluation forms for the individual fields of the form. See below.

         **.preview:** Boolean. Will enable the form submitted to be previewed
         first. This requires a template for preview to be found in the
         template file. See below for subpart marker names.

         **.menuLockPid:** Boolean. Will force the menu of editable items to be
         locked to the .pid (edit only).

         **.userFunc\_afterSave:** Function name. The function to be called after
         the record is saved. The content passed is an array with the current
         (and previous) record in.


.. container:: table-row

   Property
         create

   Data type
         boolean /actionObject

   Description
         The same as .edit above except where otherwise stated.

         Plus there is these additional properties:

         **.noSpecialLoginForm:** Boolean. If set, fe\_adminLib does **not**
         look for the subpart marker TEMPLATE\_CREATE\_LOGIN but always for
         TEMPLATE\_CREATE

         **.defaultValues.[field name]:** Value string. Like .overrideValues
         but this sets the default values the first time the form is displayed.


.. container:: table-row

   Property
         delete

   Data type
         boolean

   Description
         Whether or not records may be deleted. Still regular authentication
         (ownership or email authCode) is required. Setting the var "preview"
         lets you make a delete-preview before actually deleting the record.


.. container:: table-row

   Property
         infomail

   Data type
         boolean

   Description
         Infomails are plaintext mails based on templates found in the template
         file. They may be used for such as sending a forgotten password to a
         user, but what goes into the infomail is totally up to your design of
         the template.

         Normally you may have only a default infomail (infomail.default) for
         instance for sending the password. But you can use other keys also.
         See below.


.. container:: table-row

   Property
         infomail.[key]

   Data type
         (configuration of infomail properties)

   Description
         In order to make fe\_adminLib send an infomail, you must specify these
         vars in your GET vars or HTML-form.

         **fetch:** If integer, it searches for the uid being the value of
         'fetch'. If not, it searches for the email-field (defined by a
         property of fe\_adminLib, see below).

         **key:** Points to the infomail.[key] configuration to use.

         **Properties:**

         **.dontLockPid:** Boolean. Selects only records from the .pid of
         fe\_adminLib.

         **.label:** String. The suffix for the markers, see 'Email Markers'
         beneath.


.. container:: table-row

   Property
         setfixed

   Data type
         boolean /properties

   Description
         Allows set-fixed input, probably coming from a link in an infomail or
         notification mail.

         **Syntax:**

         **.[fixkey].[field name] = fieldvalue** Used to setup a
         setfixed-link insertable in the infomail by the
         SYS\_SETFIXED\_\*-markers. See above (setfixed-property of
         fe\_adminLib).

         Special fixkey 'DELETE' is just a boolean.

         **.userFunc\_afterSave:** Function name. Called after the record is
         saved. The content passed is an array with the current (and previous)
         record in.

         **Concept:**

         The 'setfixed' concept is best explained by describing a typical
         scenario - in fact the most common situation of its use:

         Imagine you have some users submitting information on your website.
         But before that information enters the database, you would like to
         moderate it - simply preview it and then either delete it or approve
         it. In the 'create' configuration of fe\_adminLib, you set up the
         hidden field of the record to be overridden to 1. Thus the record is
         hidden by default. Then you configure a setfixed-fixkey to set the
         hidden field to 0. This set up generates a list of parameters for use
         in an URL and those parameters are finally inserted by a corresponding
         marker in the email template. The link includes all necessary
         authentication to perform the change of values and thus a single click
         on that link is enough to change the field values. So this will - by a
         single click of a link in a notification mail sent to an admin -
         enable the record! Or of course a similar link with a cmd=delete link
         will delete it...

         There is a special "field name" you can use, which is '\_FIELDLIST"
         and that lets you specify a list of fields in the record to base the
         auth-code on. If nothing is specified the md5-hash is based on the
         whole record which means that any changes will disable the setfixed
         link. If on the other hand, you set \_FIELDLIST = uid,pid then that
         record will be editable as long as the uid and pid values are intact.

         **Example:**

         This is a common configuration of the email-properties with a simple
         setfixed setting::

            email.from = kasper@typo3.org
            email.fromName = Kasper Skårhøj
            email.admin = kasper@typo3.org
            setfixed.approve {
              hidden = 0
              _FIELDLIST = uid,pid
            }
            setfixed.DELETE = 1
            setfixed.DELETE._FIELDLIST = uid

         Now, if you insert this marker in your email template ::

            ###SYS_SETFIXED_approve###

         it will get substituted with something like these parameters::

            &cmd=setfixed&rU=9&fD[hidden]=0&aC=5c403d90

         Now, all you need is to point that to the correct URL (where
         fe\_adminLib is invoked!), e.g.::

            ###THIS_URL######FORM_URL######SYS_SETFIXED_approve###

         and for deletion::

            ...###SYS_SETFIXED_DELETE###


.. container:: table-row

   Property
         **Others**


.. container:: table-row

   Property
         authcodeFields

   Data type
         *(list of fields)*

   Description
         Comma-separated list of fields to base the authCode generation on.
         Basically this list would include "uid" only in most cases. If the
         list includes more fields, you should be aware that the authCode will
         change when the value of that field changes. And then the user will
         have to re-send an email to himself with a new code.

         **.addKey:** String. Adds the string to the md5-hash of the authCode.
         Just enter any random string here. Point is that people from outside
         do not know this code and therefore are not able to reconstruct the
         md5-hash solely based on the uid.

         **.addDate:** Date-config. You can use this to make the code time-
         disabled. Say if you enter "d-m-Y" here as value, the code will work
         until midnight and then a new code will be valid.

         **.codeLength:** Integer. Defines how long the authentication code
         should be. Default is 8 characters.

         In any case $TYPO3\_CONF\_VARS['SYS']['encryptionKey'] is prepended.

         **Advice:**

         If you want to generate authCodes compatible with the standard
         authCodes (used by the direct mailer by
         TYPO3\CMS\Core\Utility\GeneralUtility::stdAuthCode() or
         t3lib\_div::stdAuthCode()), please set
         $TYPO3\_CONF\_VARS['SYS']['encryptionKey'] to a unique and
         secret key (like you should in any case) and add "uid" as
         authcodeField ONLY. This is secure enough.


.. container:: table-row

   Property
         email

   Data type
         *(array of keys)*

   Description
         Available sub-properties:

         **.from:** String. Defines the sender email address of mails sent
         out.

         **.fromName:** String. Defines the name of the sender. If set, this
         will be used on the form NAME <EMAIL>.

         **.admin:** Email address of the administrator which is notified of
         changes.

         **.field:** String / Integer. Defines the field name of the record where
         the email address to send to is found. If the field content happens to
         be an integer, this is assumed to be the uid of the fe\_user owning
         the record and the email address of that user is fetched for the
         purpose instead.


.. container:: table-row

   Property
         pid

   Data type
         positive integer

   Description
         The pid in which to store/get the records.

   Default
         Current page


.. container:: table-row

   Property
         fe\_userOwnSelf

   Data type
         boolean

   Description
         If set, fe\_users created by this module has their fe\_cruser\_id-
         field set to their own uid which means they 'own' their own record and
         can thus edit their own data.

         All other tables which has a fe\_cruser\_id field configured in the
         'ctrl' section of their $TCA-configuration will automatically get this
         field set to the current fe\_user id.


.. container:: table-row

   Property
         fe\_userEditSelf

   Data type
         boolean

   Description
         If set, fe\_users - regardless of whether they own themselves or not -
         will be allowed to edit himself.


.. container:: table-row

   Property
         allowedGroups

   Data type
         *(list of integers)*

   Description
         List of fe\_groups uid numbers which are allowed to edit the records
         through this form. Normally only the owner fe\_user is allowed to do
         that.


.. container:: table-row

   Property
         evalFunc

   Data type
         function name

   Description
         Function with which you can manipulate the dataArray before it is saved.

         The dataArray is passed to the function as $content and MUST be
         returned again from the function.

         The property "parentObj" is a hardcoded reference to the fe\_adminLib
         object.


.. container:: table-row

   Property
         formurl

   Data type
         ->typolink

   Description
         Contains typolink properties for the URL (action tag) of the form.


.. container:: table-row

   Property
         parseValues.[field]

   Data type
         *(list of parseCodes)*

   Description
         **ParseCodes:**

         **int:** Returns the integer value of the input.

         **lower:** Returns lowercase version of the input.

         **upper:** Returns uppercase version of the input.

         **nospace:** Strips all spaces.

         **alpha, num, alphanum, alphanum\_x:** Only alphabetic (a-z) and/or
         numeric chars. alphanum\_x also allows \_ and -.

         **trim:** Trims whitespace at the beginning and the end of the string.

         **setEmptyIfAbsent:** Will make sure the field is set to empty if the
         value is not submitted. This ensures a field to be updated an is handy
         with checkboxes.

         **random[x]:** Returns a random number between 0 and x.

         **files[semicolon-list(!) of extensions, none=all][maxsize in kb,
         none=no limit]:** Defining the field to hold files. See below for
         details!

         **multiple:** Set this, if the input comes from a multiple-selector
         box. (Remember to add ...[] to the field name so the values come in an
         array!)

         **checkArray:** Set this, if you want several checkboxes to set bits
         in a single field. In that case you must prepend every checkbox with
         [x] where x is the bitnumber to set starting with zero. The default
         values of the checkbox form elements must be false.

         **uniqueHashInt[semicolon-list(!) of other fields]:** This makes a
         unique hash (32 bit integer) of the content in the specified fields.
         The values of those fields are first converted to lowercase and only
         alphanum chars are preserved.


.. container:: table-row

   Property
         userFunc\_updateArray

   Data type
         function name

   Description
         Points to a user function which will have the value-array passed to it
         before the value array is used to construct the update-JavaScript
         statements.


.. container:: table-row

   Property
         evalErrors.[field].[evalCode]

   Data type
         *(array of keys)*

   Description
         This lets you specify the error messages inserted in the
         ###EVAL\_ERROR\_FIELD\_[field name]### markers upon an evaluation
         error.

         See description of evaluation below.


.. container:: table-row

   Property
         cObjects.[marker\_name]

   Data type
         cObject

   Description
         This is cObjects you can insert by markers in the template.

         **Example:**

         Say, you set up a cObject like this::

            cObject.myHeader = TEXT
            cObject.myHeader.value = This is my header

         then you can include this cObject in most of the templates through a
         marker named ###CE\_myHeader### or ###PCE\_myHeader### (see below for
         details on the difference).


.. container:: table-row

   Property
         wrap1

   Data type
         ->stdWrap

   Description
         Global Wrap 1. This will be split into the markers ###GW1B### and
         ###GW1E###. Don't change the input value by the settings, only wrap it
         in something.

         **Example:** ::

            wrap1.wrap = <b> |</b>


.. container:: table-row

   Property
         wrap2

   Data type
         ->stdWrap

   Description
         Global Wrap 2 (see above)


.. container:: table-row

   Property
         color1

   Data type
         string /stdWrap

   Description
         Value for ###GC1### marker (Global color 1)


.. container:: table-row

   Property
         color2

   Data type
         string /stdWrap

   Description
         Value for ###GC2### marker (Global color 2)


.. container:: table-row

   Property
         color3

   Data type
         string /stdWrap

   Description
         Value for ###GC3### marker (Global color 3)


.. ###### END~OF~TABLE ######

[tsref:(script).fe\_adminLib]


.. _appendix-fe-adminlib-subparts:

Main subparts
"""""""""""""

There is a certain system in the naming of the main subparts of the
template file. The markers below are used when an action results in
"saving". The *[action]* code may be DELETE, EDIT or CREATE depending
on the cmd value.

.. t3-field-list-table::
 :header-rows: 1

 - :Subpart marker:
         Subpart marker:

   :Description:
         Description:

 - :Subpart marker:
         ###TEMPLATE\_[action]\_SAVED###

   :Description:
         Used for HTML output with "[action]" being an action.

 - :Subpart marker:
         ###TEMPLATE\_SETFIXED\_OK### (general)

         ###TEMPLATE\_SETFIXED\_OK\_[*fixkey*]###

   :Description:
         Used for a successful setfixed-link.

 - :Subpart marker:
         ###TEMPLATE\_SETFIXED\_FAILED###

   :Description:
         Used for an unsuccessful setfixed-link. Notice that if you click a
         setfixed link twice, the second time it will fail. This is because the
         setfixed link is bound to the original record and if that changes in
         any way the authentication code will be invalid!

 - :Subpart marker:
         ###EMAIL\_TEMPLATE\_[action]\_SAVED###

   :Description:
         Used for an email message sent to the website user.

 - :Subpart marker:
         ###EMAIL\_TEMPLATE\_[action]\_SAVED-ADMIN###

   :Description:
         Used for an email message sent to the admin.

 - :Subpart marker:
         ###EMAIL\_TEMPLATE\_SETFIXED\_[fixkey]###

   :Description:
         Used for notification messages in the event of successful setfixed
         operations.

 - :Subpart marker:
         ###EMAIL\_TEMPLATE\_SETFIXED\_[fixkey]-ADMIN###

   :Description:
         Ditto, for admin email


Likewise there is a system in the subpart markers used for the EDIT
and CREATE actions to display the initial forms:

###TEMPLATE\_ *[action]* ### or if a fe\_user is logged in (only
CREATE): ###TEMPLATE\_ *[action]\_LOGIN* ###

... and if the &preview-flag is sent as well (including DELETE)

###TEMPLATE\_ *[action]\_PREVIEW* ###


.. _appendix-fe-adminlib-must-have:

Must-have subparts:

These are subparts that should exist in any template.

.. t3-field-list-table::
 :header-rows: 1

 - :Subpart marker:
         Subpart marker:

   :Description:
         Description:

 - :Subpart marker:
         ###TEMPLATE\_AUTH###

   :Description:
         Displayed if the authentication - either of fe\_user or email
         authentication code - failed. You must design the error display to
         correctly reflect the problem!

 - :Subpart marker:
         ###TEMPLATE\_NO\_PERMISSIONS###

   :Description:
         This error message is displayed if you were authenticated but did not
         posses the right to edit or delete a record due to other reasons (like
         wrong fe\_user/group ownership).


.. _appendix-fe-adminlib-email:

'infomail' Email subparts
"""""""""""""""""""""""""

All email subparts can be sent as HTML. This is done if the first and
last word of the templates is <html> and </html> respectively. In
addition the Swiftmailer (in older versions of TYPO3 the t3lib\_htmlmail
class) must be loaded.

.. t3-field-list-table::
 :header-rows: 1

 - :Subpart:
         Subpart:

   :Description:
         Description:

 - :Subpart:
         ###EMAIL\_TEMPLATE\_NORECORD###

   :Description:

 - :Subpart:
         ###EMAIL\_TEMPLATE\_[infomail\_key]###

   :Description:

 - :Subpart:
         ###SUB\_RECORD###

   :Description:


'infomail' Email markers
""""""""""""""""""""""""

.. t3-field-list-table::
 :header-rows: 1

 - :Marker:
         Marker:

   :Description:
         Description:

 - :Marker:
         ###SYS\_AUTHCODE###

   :Description:

 - :Marker:
         ###SYS\_SETFIXED\_[fixkey]###

   :Description:


.. _appendix-fe-admin-form:

FORM conventions
""""""""""""""""

The forms used with fe\_adminLib should be named after the table they
are supposed to edit. For instance if you are going to edit records in
the table 'fe\_users' you must use a FORM-tag like this::

   <FORM name="fe_users_form" method="POST" action="....">

The fields used to submit data for the records has this syntax:
FE[*table name*][*field name*]. This means, if you want to edit the
'city' field of a tt\_address record, you could use a form element
like this::

   <INPUT name="FE[tt_address][city]">

Submit buttons can be named as you like except using the name
"doNotSave" of a submit button will prevent saving. If you need a
Cancel button, please resort to JavaScript in an onClick even to
change document.location.


.. _appendix-fe-adminlib-common-markers:

Common markers
""""""""""""""

.. t3-field-list-table::
 :header-rows: 1

 - :Marker:
         Marker:

   :Description:
         Description:

 - :Marker:
         ###GW1B### / ###GW1E###

   :Description:
         Global wrap 1, begin and end (headers).

 - :Marker:
         ###GW2B### / ###GW2E###

   :Description:
         Global wrap 2, begin and end (bodytext).

 - :Marker:
         ###GC1### / ###GC2### / ###GC3###

   :Description:
         Global color 1 through 3.

 - :Marker:
         ###FORM\_URL###

   :Description:
         The URL used in the forms::

            index.php?id=page-id&type=page-type

 - :Marker:
         ###FORM\_URL\_ENC###

   :Description:
         As above, but rawurlencoded.

 - :Marker:
         ###BACK\_URL###

   :Description:
         The backUrl value. Set to the value of incoming "backURL" var.

 - :Marker:
         ###BACK\_URL\_ENC###

   :Description:
         As above, but rawurlencoded.

 - :Marker:
         ###REC\_UID###

   :Description:
         The UID of the record edited. Set to the value of incoming "rU" var.

 - :Marker:
         ###AUTH\_CODE###

   :Description:
         The "aC" incoming var.

 - :Marker:
         ###THE\_PID###

   :Description:
         The "thePid" value - where the records are stored.

 - :Marker:
         ###THIS\_ID###

   :Description:
         Set to the current page id.

 - :Marker:
         ###THIS\_URL###

   :Description:
         Set to the current script URL as obtained by
         TYPO3\CMS\Core\Utility\GeneralUtility::getThisUrl()
         (t3lib\_div::getThisUrl()).

 - :Marker:
         ###HIDDENFIELDS###

   :Description:
         A bunch of hiddenfields which are required to be inserted in the
         forms. These by default include 'cmd', 'aC' and 'backURL'.


In addition you can in most cases use markers like this::

   ###FIELD_[field name]###

where [field name] is the name of a field from the record. All fields
in the record are used.

Finally you can insert cObjects defined in TypoScript with this series
of markers (see .cObject property in table above)::

   ###CE_[cObjectName]###
   ###PCE_[cObjectName]###

(###PCE\_\* is different from the ###CE\_\* cObjects by the fact they
are rendered with a newly created cObj (as opposed to the parant cObj
of fe\_adminLib) where the data-array is loaded with the value of
->dataArr which is the array submitted into the script. This is useful
for presenting preview data. Finally both PCE\_ and CE\_ types cObject
markers may be used with each single element in an edit menu (list of
available records) by prefixing the marker with 'ITEM\_', e.g.
###ITEM\_PCE\_[cObjectName]###


.. _appendix-fe-adminlib-evaluation:

Evaluation of the form fields
"""""""""""""""""""""""""""""

Printing error messages for REQUIRED fields

When a form template is displayed all subparts with the markers ::

   ###SUB_REQUIRED_FIELDS_WARNING###

and ::

   ###SUB_REQUIRED_FIELD_[field name]###

are removed. If there is a simple "required"-error (a field is not
filled in) then the SUB\_REQUIRED\_FIELDS\_WARNING is not removed and
thus the error message contained herein is shown.

Let's say that more specifically it is the 'email' field in a form
which is not filled in. Then you can put in a subpart named ::

   ###SUB_REQUIRED_FIELD_email###

This is normally removed, but it will *not* be removed if the email
field fails and thus you are able to give a special warning for that
specific field.

Printing other error messages

However you may use other forms of evaluation than simple "required"
check. This is specifiedfor "create" and "edit" modes by the
properties ".evalValues.[field name] = [list of codes]". In
order to tell your website user *which* of the possible evaluations
went wrong, you can specify error messages by the property .evalErrors
which will be inserted as the marker named ###EVAL\_ERROR\_FIELD\_
[field name]###.

Lets say that you have put the code 'uniqueLocal' in the list of
evaluation code for the email field. You would do that if you want to
make sure that no email address is put into the database twice. Then
you may specify that as::

   create.evalValues {
     email = uniqueLocal, email
   }

Then you set the evaluation error messages like this::

   evalErrors.email {
     uniqueLocal = Apparently you're already registered with this email address!
     email = This is not a proper email address!
   }

If the error happens to be that the email address already exists, the
field ###EVAL\_ERROR\_FIELD\_email### will be substituted with the
error message "Apparently you're already registered with this email
address!".


.. _appendix-fe-adminlib-default-values:

Passing default values to a form
""""""""""""""""""""""""""""""""

You can pass default values to a form by the same syntax as you use in
the forms. For instance this would set the name and email address by
default::

   ...?FE[tt_address][name]=Mike%20Tyson&FE[tt_address][email]=mike@trex.us&doNotSave=1&noWarnings=1

Notice the blue value names are the field values (must be
rawurlencoded. In JavaScript this function is called escape()) and the
red values are necessary if you want to **not** save the record by this
action and **not** to display error messages, if some fields which are
required are not passed any value.


.. _appendix-fe-adminlib-eval:

List of eval-codes
""""""""""""""""""

.. t3-field-list-table::
 :header-rows: 1

 - :Eval-code:
         Eval-code:

   :Description:
         Description:

 - :Eval-code:
         uniqueGlobal

   :Description:
         This requires the value of the field to be globally unique, which
         means it must not exist in the same field of any other record in the
         current table.

 - :Eval-code:
         uniqueLocal

   :Description:
         This is like uniqueGlobal, but the value is required to be unique
         *only* in the PID of the record. Thus if two records has different pid
         values, they may have the same value of this field.

 - :Eval-code:
         twice

   :Description:
         This requires the value of the field to match the value of a secondary
         field name [field name]\_again sent in the incoming formdata. This is
         useful for entering password. Then if your password field is name
         "user\_pass" then you simple add a second field name
         "user\_pass\_again" and then set the 'twice' eval code.

 - :Eval-code:
         email

   :Description:
         Requires the field value to be an email address at least on the form
         [name]@\*[domain].[tld]

 - :Eval-code:
         required

   :Description:
         Just simple required (trimmed value). 0 (zero) will evaluate to false!

 - :Eval-code:
         atLeast

         atMost

   :Description:
         Specifies a minimum / maximum of characters to enter in the fields.

         **Example**, that requires at least 5 characters: atleast [5]

 - :Eval-code:
         inBranch

   :Description:
         inBranch requires the value (typically of a pid-field) to be among a
         list of page-id's (pid's) specified with the inBranch parameters. The
         parameters are given like *[root\_pid; depth; beginAt]*

         **Example**, which will return a list of pids one level deep from
         page 4 (included): inBranch [4;1]

 - :Eval-code:
         unsetEmpty

   :Description:
         This evaluation does not result in any error code. Only it simply
         unsets the field if the value of the field is empty. Thus it will not
         override any current value if the field value is not set.


[tsref:(script).fe\_adminLib.evalErrors.(field).(evalCode)]


.. _appendix-fe-adminlib-file-uploads:

Uploading files
"""""""""""""""

fe\_adminLib is able to receive files in the forms. However there
currently are heavy restrictions on how that is handled. Ideally the
proces would be handled by the TYPO3\CMS\Core\DataHandler\DataHandler
(t3lib\_tcemain) class used in the backend. In fact this could have
been deployed but is not at this stage. The good thing about
DataHandler.php is that it perfectly handles the copying/deletion of
files which goes into a certain field and even handles it independent
of the storing method be it a list of filenames or use MM-relations to
records (see tables.php section in 'Inside TYPO3').

This is how files are handled by fe\_adminLib and the restrictions
that apply currently:

- You can upload files ONLY using "create" mode of a record. In any case
  you cannot edit currently attached files (this may be improved in the
  future). You can however use 'delete' mode.

- However you can use PREVIEW mode with 'create'. Works like this: if
  the mode is preview the temporary uploaded file is copied to a unique
  filename (prepended with the table name) in typo3temp/ folder. Then the
  field value is set to the filenames in a list. When the user approves
  the content of the preview those temporary files are finally copied to
  the uploads/\* folder (or wherever specified in TCA). Limitations are
  that the temporary files in typo3temp/ are **not** deleted when copied to
  the real upload-folder (this may be improved) and certainly not if the
  user aborts (can't be improved because the user may go anywhere). If
  the user cancels the preview in order to change values, the files will
  need to be uploaded again (this may be improved).

- The TCA extensions allowed for the field is ignored! However you can
  specify a list of extensions of allowed for the files in the
  .parseValues property of fe\_adminLib

- The TCA filesize limitation for the field is ignored! However you can
  specify a max file size in kb in the .parseValues property of
  fe\_adminLib

- Works only on fields configured for comma-list representation of the
  filenames (non-MM, see "Inside TYPO3" document on MM relations for
  files).

It is recommended to use a dedicated folder for files administered by
the fe\_adminLib. The TYPO3 testsite does that by using the
uploads/photomarathon/ folder for images. This makes it much easier to
clean up the mess if files and their relations to the records are
broken.

field names for files

Lets say you have a field named "picture" of a table name
"user\_cars", the form-element should look like this::

   <input type="file" name="FE[user_cars][picture][]">

If you wish to upload multiple files to that field, the form-elements
should look like::

   <input type="file" name="FE[user_cars][picture][]">
   <input type="file" name="FE[user_cars][picture][]">
   <input type="file" name="FE[user_cars][picture][]">

Use blob-types for the file-fields and reserve a minimum of 32
characters pr. filename.

**Note:** Make sure to always add the last square brackets ('...[]')
to the field name! Otherwise it will not work!

