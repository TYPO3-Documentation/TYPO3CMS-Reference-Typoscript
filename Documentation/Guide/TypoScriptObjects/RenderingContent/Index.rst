..  include:: /Includes.rst.txt

..  _guide-cobjects-rendering-content:

=========================
Objects rendering content
=========================

-   :ref:`IMAGE <cobj-image>` for the rendering of an image:

    ..  literalinclude:: _IMAGE.typoscript

    The result is an image based on file :file:`logo.gif` with width of 200 pixels
    and a link to the page 1.

-   :ref:`TEXT <cobj-text>` is for the rendering of standard text or the
    content of fields:

    ..  literalinclude:: _lib.slogan.typoscript

-   :ref:`FILES <cobj-files>` is used to retrieve information about one
    or more files and perform some rendering with it:

    ..  literalinclude:: _lib.banner.typoscript

    This code will probably look pretty abstract to you right now. What it does
    is to reference the images that were related to a given page in the "media"
    field. It takes each of these images and resizes them to a maximum width of
    500 pixels. Each image is wrapped in a `<div>` tag.

-   :ref:`FLUIDTEMPLATE <cobj-fluidtemplate>` renders a template with the
    template engine Fluid with variables and data that you define - as previously
    discussed in the ":ref:`insert-content-in-a-template`" chapter.

