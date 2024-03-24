..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; OUTLINE
..  _gifbuilder-outline:

=======
OUTLINE
=======

:typoscript:`OUTLINE` creates a colored contour line around the shapes of the
associated text.

This outline normally renders quite ugly as it is done by printing 4 or
8 texts underneath the text in question. Try to use a
:ref:`shadow <gifbuilder-shadow>` with a high intensity instead. That works
better!

..  _gifbuilder-outline-properties:

Properties
==========

..  contents::
    :local:


..  _gifbuilder-outline-color:

color
-----

..  confval:: color
    :name: gifbuilder-outline-color

    :Data type: :ref:`data-type-GraphicColor` / :ref:`stdWrap <stdwrap>`

    Color of the outline.


..  _gifbuilder-outline-textObjNum:

textObjNum
----------

..  confval:: textObjNum
    :name: gifbuilder-outline-textObjNum

    :Data type: positive integer / :ref:`stdWrap <stdwrap>`

    Must point to the :ref:`TEXT <gifbuilder-text>` object, if these outline
    properties are not properties to a TEXT object directly ("stand-alone
    outline"). Then the outline needs to know which TEXT object it should be an
    outline of!

    If - on the other hand - the outline is a property to a
    :ref:`TEXT <gifbuilder-text>` object, this property is not needed.


..  _gifbuilder-outline-thickness:

thickness
---------

..  confval:: thickness
    :name: gifbuilder-outline-thickness

    :Data type: x,y / :ref:`stdWrap <stdwrap>`

    Thickness in each direction, range 1-2.
