.. include:: /Includes.rst.txt


.. _guide-function-typolink:

========
typolink
========

:ref:`typolink <typolink>` is the TYPO3 CMS function
that allows us to generate all kinds of links.
If possible one should always use this function to generate links
as they will be processed by TYPO3 CMS. This is a prerequisite,
for example, for the "realurl" extension to generate speaking URLs
or for the anti-spam protection of email addresses.

Please resist the urge to a straight `<a href="...">...</a>` construct
in your templates.

Basically `typolink` links the specified text according to
the defined parameters. One example::

    temp.link = TEXT
    temp.link {

        # This is the defined text.
        value = Example link

        # Here comes the typolink function.
        typolink {

            # This is the destination of the link...
            parameter = http://www.example.com/

            # with a target ("_blank" opens a new window)...
            extTarget = _blank

            # and add a class to the link so we can style it.
            ATagParams = class="linkclass"
        }
    }

The example above will generate this HTML code:

.. code-block:: html

   <a class="linkclass" target="\_blank" href="http://www.example.com/">Example link</a>

`typolink`, in a way, almost works like a wrap: the content which is
defined for example by the `value` property, will be wrapped by the HTML anchor tag.
If no content is defined, it will be generated automatically. With a
link to a page, the page title will be used. With an external URL, the
URL will be shown.

The above example can actually be shortened, because the
`parameter` property can take a series of values separated
by a white space::

    temp.link2 = TEXT
    temp.link2 {

        # Again the defined text.
        value = Example link

        # The parameter with the summary of the parameters of the first
        # example (explanation follows below).
        typolink.parameter = www.example.com _blank linkclass
    }

The exact syntax for `parameter` property is fully described,
as usual, in the :ref:`TypoScript Reference <typolink>`.

It is even possible to define links that open in JavaScript popups::

   temp.link = TEXT
   temp.link {

        # The link text.
        value = Open a popup window.

        stdWrap.typolink {
             # The first parameter is the page ID of the target page,
             # second parameter is the size of the popup window.
             parameter = 10 500x400

             # The title attribute of the link.
             title = Click here to open a popup window.

             # The parameters of the popup window.
             JSwindow_params = menubar=0, scrollbars=0, toolbar=0, resizable=1

        }
   }
