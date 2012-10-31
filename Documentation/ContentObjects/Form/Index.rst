.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-form:

FORM
^^^^

.. figure:: ../../Images/icon_note.png
   :alt: Note

**Note**

The following only applies, if the system extension "form" (which
comes with TYPO3 since version 4.6) is *not* installed. If it is, things
work as described in the documentation inside the system extension.

This object provides a way to create forms::

   textarea:  Label | [* = required][field name =] textarea[,cols,rows,"wrap= [eg. "OFF"]"] | [defaultdata] | Special evaluation configuration (see note below)
   input:          Label | [* = required][field name =] input[,size,max] | [defaultdata] | Special evaluation configuration (see note below)
   password:       Label | [* = required][field name =] input[,size,max] | [defaultdata]
   file:           Label | [* = required][field name (*1)=] file[,size]
   check:          Label | [* = required][field name =]check | [checked=1]
   select:         Label | [* = required][field name =]select[,size (int/"auto"), "m"=multiple] | label [=value] , ...
   radio:          Label | [* = required][field name =]radio | label [=value] , ...
   hidden:         |[field name =]hidden | value
   submit:         Label |[field name =]submit | Caption
   reset:             Label |[field name =]reset | Caption
   label:          Label | label | Label value
   property:               [Internal, see below]


.. _cobj-form-preselected-item:

Preselected item with type "select" and "radio":
""""""""""""""""""""""""""""""""""""""""""""""""

This is an example, where "Brown" is the preselected item of a
selector box::

      Haircolor: | *haircolor=select| Blue=blue , Red=red , *Brown=brown

You can enter multiple items to be preselected by placing an asterisk
in front of each preselected item.


.. _cobj-form-property-override:

Property override:
""""""""""""""""""

This can be done with the following properties from the table below:

type, locationData, goodMess, badMess, emailMess

syntax::

   |[property] =property | value

(\*1) (field name for files)

In order for files to be attached the mails, you must use the field
names:

*attachment, attachment1, ... , attachment10*


.. _cobj-form-displaying-the-form:

Displaying the form:
""""""""""""""""""""

**You must set the property "layout"** . If you do not set it, the
form will not be rendered! For more information see the example and
the table below.


Example:
~~~~~~~~

::

   temp.mailform = FORM
   temp.mailform {

     dataArray {
       10.label = Name:
       10.type = name=input

       20.label = Nachricht:
       20.type = nachricht=textarea,40,10

       100.type = submit=submit
       100.value = Absenden
     }
     recipient = info@example.com
     layout = <div class="some-class">###LABEL### ###FIELD###</div>
   }


.. _cobj-form-return-email:

Correct return-email:
"""""""""""""""""""""

In order for the mails to be attached with the email address of the
people that submits the mails, please use the field name "email", e.g::

   Email: | *email=input |


.. _cobj-form-evaluation:

Special evaluation
""""""""""""""""""

By prefixing a "\*" before the field name of most types you can have
the value of the field required. The check is done in JavaScript; It
will only submit the form if this field is filled in.

Alternatively you can evaluate a field value against a regular
expression or as an email address for certain types (textarea,
password, input).

This is done by specifying the "Special evaluation configuration" for
those types as part 4 in the configuration line (see examples above).

The special evaluation types are divided by a semicolon (":").

The first part defines the evaluation  **keyword** . Current options
are "EREG" (for regular expression) and "EMAIL" (for evaluation to an
email address).

If the "EREG" keyword is specified the 2 :sup:`nd` and 3 :sup:`rd`
parts are error message and regular expression respectively.


Examples:
~~~~~~~~~

::

   Your address: | address=textarea,40,10 |  | EREG : You can only enter the characters A to Z : ^[a-zA-Z]*$
   Your email: | *email=input |  | EMAIL

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
         data

   Data type
         string /stdWrap

   Description
         This is the data that sets up the form. See above.

         "\|\|" can be used instead of line breaks

   Default


.. container:: table-row

   Property
         dataArray

   Data type
         *[array of form elements]*

   Description
         This is an alternative way to define the form-fields. Instead of using
         the syntax with vertical separator bars suggested by the .data
         property, you can define the elements in regular TypoScript style
         arrays.

         .dataArray is  *added* to the input in .data if any.

         Every entry in the dataArray is numeric and has three main properties,
         *label* ,  *type* ,  *value* and  *required* . All of them have
         stdWrap properties.

         There is an alternative property to .value, which is .valueArray. This
         is also an array in the same style with numeric entries which has
         properties  *label* ,  *value* and  *selected* . All three of these
         properties have stdWrap properties.

         **Example:** ::

            dataArray {
              10.label = Name:
              10.type = name=input
              10.value = [Enter name]
              10.required = 1
              20.label = Eyecolor
              20.type = eyecolor=select
              20.valueArray {
                10.label = Blue
                10.value = 1
                20.label = Red
                20.value = 2
                20.selected = 1
              }
              40.type = submit=submit
              40.value = Submit
            }

         This is the same as this line in the .data property::

            Name: | *name=input | [Enter name]
            Eyecolor: | eyecolor=select | Blue=1, *Red=2
            | submit=submit | Submit

         **Why do it this way?** Good question, but doing it this way has a
         tremendous advantage, because labels are all separated from the codes.
         In addition it's much easier to pull out or insert new elements in the
         form.

         Inserting an email-field after the name field would be like this::

            dataArray {
              15.label = Email:
              15.type = input
              15.value = your@email.com
              15.specialEval = EMAIL
            }

         Or translating the form to danish (setting config.language to 'dk')::

            dataArray {
              10.label.lang.dk = Navn:
              10.value.lang.dk = [Indtast dit navn]
              20.label.lang.dk = Øjenfarve
              20.valueArray {
                10.label.lang.dk = Blå
                20.label.lang.dk = Rød
              }
              40.value.lang.dk = Send
            }

   Default


.. container:: table-row

   Property
         radioWrap

   Data type
         ->stdWrap

   Description
         Wraps the labels for radio buttons.

   Default


.. container:: table-row

   Property
         radioWrap.accessibilityWrap

   Data type
         wrap /stdWrap

   Description
         Defines how radio buttons are wrapped when accessibility mode is
         turned on (see below "accessibility" property).

   Default
         <fieldset###RADIO\_FIELD\_ID###><legend>###RADIO\_GROUP\_LABEL###</leg
         end>\|</fieldset>


.. container:: table-row

   Property
         radioInputWrap

   Data type
         ->stdWrap

   Description
         Wraps the input element and label of a radio button.

   Default


.. container:: table-row

   Property
         type

   Data type
         integer, string

   Description
         Type (action="" of the form):

         **Integer:** this is regarded to be a page in TYPO3

         **String:** this is regarded to be a normal URL (e.g. "formmail.php"
         or "fe\_tce\_db.php")

         **Empty:** the current page is chosen.

         **NOTE:** If type is integer/empty the form will be submitted to a
         page in TYPO3 and if this page has a value for target/no\_cache, then
         this will be used instead of the default target/no\_cache below.

         **NOTE:** If the redirect-value is set, the redirect-target overrides
         the target set by the action-url

         **NOTE:** May be overridden by the property override feature of the
         formdata (see above)

   Default


.. container:: table-row

   Property
         target

   Data type
         target /stdWrap

   Description
         Default target of the form.

   Default


.. container:: table-row

   Property
         method

   Data type
         form-method /stdWrap

   Description
         **Example:**

         GET

   Default
         POST


.. container:: table-row

   Property
         no\_cache

   Data type
         string /stdWrap

   Description
         Default no\_cache-option.

   Default


.. container:: table-row

   Property
         noValueInsert

   Data type
         boolean /stdWrap

   Description
         By default values that are submitted to the same page (and thereby
         same form, e.g. at search forms) are re-inserted in the form instead
         of any default-data that might be set up.

         This, however, applies ONLY if the "no\_cache=1" is set! (a page being
         cached may not include user-specific defaults in the fields of
         course...)

         If you set this flag, "noValueInsert", the content will always be the
         default content.

   Default


.. container:: table-row

   Property
         compensateFieldWidth

   Data type
         double /stdWrap

   Description
         Overriding option to the config-value of the same name. See "CONFIG"
         above.

   Default


.. container:: table-row

   Property
         locationData

   Data type
         boolean / string /stdWrap

   Description
         If this value is true, then a hidden-field called "locationData" is
         added to the form. This field will be loaded with a value like this:

         [page id]:[current record table]:[current record id]

         For example, if a formfield is inserted on page with uid = "100", as a
         page-content item from the table "tt\_content" with id "120", then the
         value would be "100:tt\_content:120".

         The value is use by eg. the cObject SEARCHRESULT. If the value
         $GLOBALS['HTTP\_POST\_VARS']['locationData'] is detected here, the
         search is done as if it was performed on this page! This is very
         useful if you want a search functionality implemented on a page with
         the "stype" field set to "L1" which means that the search is carried
         out from the first level in the rootline.

         Suppose you want the search to submit to a dedicated search page where
         ever. This page will then know - because of locationData - that the
         search was submitted from another place on the website.

         If "locationData" is not only true but also set to "HTTP\_POST\_VARS"
         then the value will insert the content of
         $GLOBALS['HTTP\_POST\_VARS']['locationData'] instead of the true
         location data of the page. This should be done with search-fields as
         this will carry the initial searching start point with.

         **NOTE:** May be overridden by the property override feature of the
         formdata (see above)

   Default


.. container:: table-row

   Property
         redirect

   Data type
         string /stdWrap

   Description
         URL to redirect to (generates the hidden field "redirect")

         **Integer:** this is regarded to be a page in TYPO3

         **String:** this is regarded to be a normal url

         **Empty;** the current page is chosen.

         **NOTE:** If this value is set, the target of this overrides the
         target of the "type".

   Default


.. container:: table-row

   Property
         recipient

   Data type
         *(list of) string* /stdWrap

   Description
         Email recipient of the formmail content (generates the hiddenfield
         "recipient")

   Default
         No email


.. container:: table-row

   Property
         goodMess

   Data type
         string /stdWrap

   Description
         Message for the form evaluation function in case of correctly filled
         form.

         **NOTE:** May be overridden by the property override feature of the
         formdata (see above).

   Default
         No message


.. container:: table-row

   Property
         badMess

   Data type
         string /stdWrap

   Description
         Message for the form evaluation in case of missing required fields.

         This message is shown above the list of fields.

         **NOTE:** May be overridden by the property override feature of the
         formdata (see above).

   Default
         No message


.. container:: table-row

   Property
         emailMess

   Data type
         string /stdWrap

   Description
         Message if a field evaluated to be an email address did not validate.

         **NOTE:** May be overridden by the property override feature of the
         formdata (see above).

   Default


.. container:: table-row

   Property
         image

   Data type
         ->IMAGE (cObject)

   Description
         If this is a valid image the submit button is rendered as this image!!

         **NOTE:** CurrentValue is set to the caption-label before generating
         the image.

   Default


.. container:: table-row

   Property
         layout

   Data type
         string

   Description
         This defines how the label and the field are placed towards each
         other.

         **This property is mandatory; you must set it!** Otherwise the form
         will not be rendered.

         **Example:**

         This substitutes the marker "###FIELD###" with the field data and the
         marker "###LABEL###' with label data. ::

            layout = <tr><td>###FIELD###</td><td> ###LABEL###</td></tr>

         You can also use the marker ###COMMENT### which is ALSO the label
         value inserted, but wrapped in .commentWrap stdWrap-properties (see
         below).

   Default


.. container:: table-row

   Property
         fieldWrap

   Data type
         ->stdWrap

   Description
         Field: Wraps the fields

   Default


.. container:: table-row

   Property
         labelWrap

   Data type
         ->stdWrap

   Description
         Labels: Wraps the label

   Default


.. container:: table-row

   Property
         commentWrap

   Data type
         ->stdWrap

   Description
         Comments: Wrap for comments IF you use ###COMMENT###

   Default


.. container:: table-row

   Property
         REQ

   Data type
         boolean /stdWrap

   Description
         Defines if required-fields should be checked and marked up.

   Default


.. container:: table-row

   Property
         REQ.fieldWrap

   Data type
         ->stdWrap

   Description
         Field: Wraps the fields, but for required fields

   Default
         the "fieldWrap"-property


.. container:: table-row

   Property
         REQ.labelWrap

   Data type
         ->stdWrap

   Description
         Labels: Wraps the label, but for required fields

   Default
         the "labelWrap"-property


.. container:: table-row

   Property
         REQ.layout

   Data type
         string /stdWrap

   Description
         The same as "layout" above, but for required fields

   Default
         the "layout"-property


.. container:: table-row

   Property
         COMMENT.layout

   Data type
         string /stdWrap

   Description
         Alternative layout for comments.

   Default
         the "layout"-property


.. container:: table-row

   Property
         CHECK.layout

   Data type
         string /stdWrap

   Description
         Alternative layout for checkboxes

   Default
         the "layout"-property


.. container:: table-row

   Property
         RADIO.layout

   Data type
         string /stdWrap

   Description
         Alternative layout for radio buttons

   Default
         the "layout"-property


.. container:: table-row

   Property
         LABEL.layout

   Data type
         string /stdWrap

   Description
         Alternative layout for label types

   Default
         the "layout"-property


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description
         Wraps the whole form (before form tag is added)

   Default


.. container:: table-row

   Property
         hiddenFields

   Data type
         [array of cObject]

   Description
         Used to set hiddenFields from TS.

         **Example:** ::

            hiddenFields.pid = TEXT
            hiddenFields.pid.value = 2

         This makes a hidden-field with the name "pid" and value "2".

         Available sub-property:

         **stdWrap** , see ->stdWrap.

   Default


.. container:: table-row

   Property
         params

   Data type
         form-element tag parameters /stdWrap

   Description
         Extra parameters to form elements.

         **Example:** ::

            params = style="width:200px;"
            params.textarea = style="width:300px;"
            params.check =

         This sets the default to 200 px width, but excludes check-boxes and
         sets textareas to 300.

         **stdWrap** is available for the sub-properties, e.g. params.tagname.

   Default


.. container:: table-row

   Property
         wrapFieldName

   Data type
         wrap /stdWrap

   Description
         This wraps the field names before they are applied to the form-field
         tags.

         **Example:**

         If value is  *tx\_myextension[input][ \| ]* then the field name
         "email" would be wrapped to this value:
         *tx\_myextension[input][email]*

   Default


.. container:: table-row

   Property
         noWrapAttr

   Data type
         boolean /stdWrap

   Description
         If this value is true then all wrap attributes of textarea elements
         are suppressed. This is needed for XHTML-compliancy.

         The wrap attributes can also be disabled on a per-field basis by using
         the special keyword "disabled" as the value of the wrap attribute.

   Default


.. container:: table-row

   Property
         arrayReturnMode

   Data type
         boolean /stdWrap

   Description
         If set, the <form> tags and the form content will be returned in an
         array as separate elements including other practical values. This mode
         is for use in extensions where the array return value can be more
         useful.

   Default


.. container:: table-row

   Property
         accessibility

   Data type
         boolean /stdWrap

   Description
         If set, then the form will be compliant with accessibility guidelines
         (XHTML compliant). This includes:

         - label string will be wrapped in <label for="formname[field name-
           hash]"> ... </label>

         - All form elements will have an id-attribute carrying the formname with
           the md5-hashed field name appended

         **Notice:** In TYPO3 4.0 and later, CSS Styled Content is configured
         to produce accessible forms by default.

   Default


.. container:: table-row

   Property
         formName

   Data type
         string /stdWrap

   Description
         An alternative name for this form. Default will be a unique (random)
         hash. ::

            <form name="...">

   Default


.. container:: table-row

   Property
         fieldPrefix

   Data type
         string /stdWrap

   Description
         Alternative prefix for the name of the fields in this form. Otherwise,
         all fields are prefixed with the form name (either a unique hash or
         the name set in the "formName" property). If set to "0", there will be
         no prefix at all.

   Default


.. container:: table-row

   Property
         dontMd5FieldNames

   Data type
         boolean /stdWrap

   Description
         The IDs generated for all elements in a form are md5 hashes from the
         field name. Setting this to true will disable this behavior and use a
         cleaned field name, prefixed with the form name as the ID, instead.

         This can be useful to style specifically named fields with CSS.

   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).FORM]


.. _cobj-form-examples:

Example: Login
~~~~~~~~~~~~~~

In order to create a login form, you would need to supply these
fields:

- "username" = username

- "userident" = password

- "login\_status" = "logout" for logout, "login" for login.

If you insert "<!--###USERNAME###-->" somewhere in your document this
will be substituted by the username if a user is logged in!

If you want the login-form to change into a logout form you should use
conditions to do this. See this TS-example (extract from the
static\_template  *"styles.content (default)"* )::

     # loginform
   styles.content.loginform {
     data = Username:|*username=input || Password:|*userident=password
   }
   [usergroup = *]
   styles.content.loginform.data = Username: <!--###USERNAME###-->  || |submit=submit| Logout
   [global]


Example: Mailform
~~~~~~~~~~~~~~~~~

This creates a simple mail form (this is not TypoScript, but the setup
code that you should put directly into the "bodytext"-field of a
pagecontent record of the type "FORMMAIL"::

   Name: | *replyto_name= input | Enter your name here
   Email: | *replyto_email=input |
   Like TV: | tv=check |
   | formtype_mail = submit | Send this!

   | html_enabled=hidden | 1
   | subject=hidden| This is the subject
   | recipient_copy=hidden | copy@email.com
   | auto_respond_msg=hidden|  Hello / This is an automatic response. //We have received your mail.
   | from_name=hidden | Website XY
   | from_email=hidden | noreply@website.com
   | organization=hidden | Organization XY
   | redirect=hidden | 16
   | priority=hidden | 5
   | tv=hidden | 0

- "replyto\_name": If the field is named like this the value is used as
  reply to name in the email software and will not be shown in the mail
  content. Choose another field name like the\_name to use the value as
  a normal field. Note the asterisk (\*) which means the field is
  required. and the field name will be "the\_name". Also a default value
  is set ("Enter your name here")

- "replyto\_email": If the field is named like this the value is used as
  reply to email address in the email software and will not be shown in
  the mail content. To get the value as sender address in the mail
  software use "email" as field name.

- "Like TV" is a checkbox. Default is "unchecked".

- "formtype\_mail" is the name of the submit button. It  **must** be
  names soif you use the built-in form mail of TYPO3, at it will make
  TYPO3 react automatically on the input and interpret it as form mail
  input!

- "html\_enabled" will let the mail be rendered in nice HTML

- "use\_base64" will send the mail encoded as base64 instead of quoted-
  printable

- "subject": Enter the subject of your mail

- "recipient\_copy" : A copy is sent to this mail-address. You may
  supply more addresses by separating with a comma (,). The mail sent to
  recipient\_copy is the same, but a separate message from the one sent
  to the 'recipient' and furthermore the copy-mail is sent only if the
  'recipient' mail is sent.

- "auto\_respond\_msg": This is an auto-responder message. This is sent
  if the email of the "submitter" is known (field: "email"). The value
  of this is the message broken up in to lines by a slash "/". Each
  slash is a new line in the email. The first line is used for the
  subject.

- "from\_name": With this option you can set the mail header from name,
  which will be shown in the mail software.

- "from\_email": With this option you can set the mail header from
  email, which will be shown in the mail software as sender address.

- "organization": With this option you can set the mail header
  organization parameter, which won't be shown in the mail but in the
  mail header.

- "redirect": With this option you can define a TYPO3 page (page id) or
  external URL (www.example.com) as redirect url after submit. If this
  option isn't set the form will be shown again.

- "priority": With this option you can set the priority of the mail from
  1 (not important) to 5 (very important). Default is 3.

- "tv" (again, but hidden). Repeating this field may be smart as the
  value "tv" is normally NOT submitted with the value "false" if not
  checked. Inserting this line will ensure a default value for "tv".

