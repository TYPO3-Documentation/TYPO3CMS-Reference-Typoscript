..  include:: /Includes.rst.txt
..  _introduction:

============
Introduction
============

..  _about:

About this document
===================

This document describes TSconfig and its options. Tsconfig is a TypoScript-like configuration
syntax which is used to configure parts of the backend based on user, group and page.

This document can be seen as detail below the main :ref:`TYPO3 Explained <t3coreapi:start>`
documentation as this section is too big to be included there.

The first parts of this document explain concepts related to TSconfig, where it
can be found in the system, how it can be debugged, and how developers
can access data from TSconfig via the the PHP API.

The rest of the document can be used as a reference for looking up properties as
you need them.

This document is especially important for integrators wanting to make life as easy as possible
for their dear backend users.

..  index:: ! TSconfig
..  _about-tsconfig:

About TSconfig
==============

TSconfig is used in TYPO3 to configure and customize the backend on a page, user
or group basis. Its syntax is based on the `TypoScript` that is
used to configure the frontend output of the web site.

The whole point of TSconfig is that integrators can configure parts of the backend
without having to ask developers to write PHP code. This means that some areas
of TSconfig are very powerful and provide a lot of different ways of customizing the
TYPO3 backend.

TSconfig is divided into configuration for pages ("Page TSconfig") and configuration
for users and groups ("User TSconfig"). Each type is further explained in this document.

The general "dotted notation" used in `TypoScript` is also used in Page TSconfig and
User TSconfig. It is possible to reference values, use conditions, and so on.
For a general look at the syntax, please read the relevant section in
:ref:`TYPO3 Explained <t3tsref:typoscript-syntax>`.

Other than basic syntax, TSconfig and frontend TypoScript have nothing in common.
Properties in the :ref:`TypoScript Reference <t3tsref:start>` cannot be
used in TSconfig and vice versa. TypoScript and TSconfig are two different
things: TypoScript is used to configure rendering of the frontend web site, TSconfig
is used to configure what is displayed to a logged in backend user.

While this might sound confusing at first, as soon as integrators
start using TSconfig and looking at the available options it is clear: it is all about setting values
to configure what a backend user does or does not see, give them additional
editing options, or removing them. And as a final point, TSconfig is
also used to configure the "Admin panel" in the frontend. While this might seem strange at
first, thinking about it makes it clear why admin panel configuration options are
bound to TSconfig and not to frontend TypoScript. The admin panel is basically a
frontend view of parts of the backend - it is entirely bound to the backend user. So the
admin panel is a backend thing. Even if it is displayed in the frontend it is meant for backend users. This
is why the admin panel is configured via TSconfig.
