..  include:: /Includes.rst.txt
..  index:: Functions; makelinks
..  _makelinks:

=========
makelinks
=========

:typoscript:`makelinks` substitutes all appearances of web addresses or mail links
with a real link tag. Web addresses and mail links must be contained in
the text in the following form:

..  code-block:: none

    https://example.org

    mailto:name@example.org


..  contents::
    :local:

..  index:: makelinks; Properties
..  _makelinks-properties:

Properties
==========

..  _makelinks-http:

http
----

Substitutes all external web addresses with a link tag so they are displayed
as a link.

Can handle links of the form:

..  code-block:: none

    https://example.org
    http://example.org


..  _makelinks-http-extTarget:

http.extTarget
~~~~~~~~~~~~~~

..  confval:: http.extTarget

    :Data type: :ref:`data-type-target`
    :Default: \_top

    The target of the link.


..  _makelinks-http-wrap:

http.wrap
~~~~~~~~~

..  confval:: http.wrap

    :Data type: :ref:`data-type-wrap` / :ref:`stdwrap`

    Wrap around the link.

..  _makelinks-http-ATagBeforeWrap:

http.ATagBeforeWrap
~~~~~~~~~~~~~~~~~~~

..  confval:: http.ATagBeforeWrap

    :Data type: :ref:`data-type-boolean`
    :Default: 0

    If set, the link is first wrapped with :typoscript:`http.wrap` and then the
    :html:`<a>` tag.


..  _makelinks-http-keep:

http.keep
~~~~~~~~~

..  confval:: http.keep

    :Data type: list: "scheme","path","query"

    As default the link-text will be the full domain-name of the link.

    ..  rubric:: Examples

    With the URL :samp:`https://example.org/test/doc.php?id=3` in our text we will
    get the following results:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        http.keep = "":                   # example.org
        http.keep = "scheme":             # https://example.org
        http.keep = "scheme,path":        # https://example.org/test/doc.php
        http.keep = "scheme,path,query":  # https://example.org/test/doc.php?id=3

..  _makelinks-http-ATagParams:

http.ATagParams
~~~~~~~~~~~~~~~

..  confval:: http.ATagParams

    :Data type: :ref:`data-type-tag-params` / :ref:`stdwrap`

    Additional parameters

    ..  rubric:: Examples

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        http.ATagParams = class="board"

..  _makelinks-mailto:

mailto
------

Substitutes all appearances of mail addresses
with a link tag. Mail addresses must be contained in
the text in the following form:

..  code-block:: none

    mailto:name@example.org

..  _makelinks-mailto.wrap:

mailto.wrap
~~~~~~~~~~~

..  confval:: mailto.wrap

    :Data type: :ref:`data-type-wrap` / :ref:`stdwrap`

    Wrap around the link.

..  _makelinks-mailto.ATagBeforeWrap:

mailto.ATagBeforeWrap
~~~~~~~~~~~~~~~~~~~~~

..  confval:: mailto.ATagBeforeWrap

    :Data type: :ref:`data-type-boolean`
    :Default: 0

    If set, the link is first wrapped with mailto :typoscript:`wrap` and then the
    :html:`<a>` tag.


..  _makelinks-mailto.ATagParams:

mailto.ATagParams
~~~~~~~~~~~~~~~~~

..  confval:: mailto.ATagParams

    :Data type: :ref:`data-type-tag-params` / :ref:`stdwrap`

    Additional parameters

    ..  rubric:: Examples

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        mailto.ATagParams = class="board"
