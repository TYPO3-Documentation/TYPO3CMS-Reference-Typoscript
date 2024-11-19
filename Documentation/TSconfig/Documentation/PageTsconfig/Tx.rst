..  include:: /Includes.rst.txt
..  index::
    page TSconfig; Extensions
    page TSconfig; tx_*

..  _page-tsconfig-extension-namespace:

====
tx_*
====

The `tx_` prefix key is not used in the Core itself, and is just a
reserved space for extensions to never collide with core options, a
use case could be `tx_news` for the news extension. Extension developers
should create a key like that: `tx_[extension key with no underscore]`
