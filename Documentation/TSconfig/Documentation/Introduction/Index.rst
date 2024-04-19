..  include:: /Includes.rst.txt
..  _introduction:

============
Introduction
============

..  _about:

About this document
===================

This document describes TSconfig and its options: A TypoScript a-like configuration
syntax to configure details of the backend for backend users based on a user, group and page level.

This document can be seen as detail below the main :ref:`TYPO3 Explained <t3coreapi:start>` documentation.
It is too huge to be integrated into TYPO3 Explained directly.

First parts of this document explain the concepts of TSconfig, the different places it can be
found in the system, how it can be diagnosed, and goes a bit into the PHP API if developers
need to access data from TSconfig.
The rest of the document is a reference: A document to look-up and find properties on a daily basis.

This document is especially important for integrators who want to make life as easy as possible
for their dear backend users.

..  index:: ! TSconfig
..  _about-tsconfig:

About TSconfig
==============

TSconfig is used in TYPO3 to configure and customize the backend on a page and
a user or group basis. The syntax to do this is based on `TypoScript` that is also
used to configure frontend output of the web site.

The whole point of TSconfig is that it allows configuration of backend details
by integrators, without asking developers for writing PHP code. Thus, some areas
of TSconfig are rather powerful and offer vast possibilities of customizing the TYPO3 backend.

TSconfig is divided into configuration for pages ("Page TSconfig") and configuration
for users and groups ("User TSconfig"). Each variant is further detailed in this document.

The general "dotted notation" of `TypoScript` is re-used for Page TSconfig and
User TSconfig, it is possible to reference values, use conditions, and so on.
For a general look at the syntax, please read the according section of
:ref:`TYPO3 Explained <t3coreapi:typoscript-syntax-start>`.

Other than the basic syntax, TSconfig and frontend TypoScript have nothing in common.
Properties outlined in the :ref:`TypoScript Reference <t3tsref:start>` can never be
used in TSconfig and vice versa. Frontend TypoScript and TSconfig are different
things: TypoScript is used to steer the rendering of the frontend web site, TSconfig
is used to configure what is displayed to a logged in backend user.

While this might be confusing in the first place, it becomes clear as soon as integrators
start using TSconfig and looking at the available options: It is all about setting values
to configure if a backend users sees or does not see this-and-that, give a user additional
editing options, or removing them. As a last note to complete this picture: TSconfig is
also used to configure the "Admin panel" in the frontend. While this might look funny in the
first place, thinking about that makes clear on why admin panel configuration options are
bound to TSconfig and not to frontend TypoScript: The admin panel is basically a view to parts
of the backend that is shown in the frontend, it is entirely bound to backend users. So, the
admin panel is a backend thing, even if displayed in frontend, it is for backend users. This
is why the admin panel is configured via TSconfig.
