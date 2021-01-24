.. include:: /Includes.rst.txt

.. index::
   user TSconfig; Extensions
   user TSconfig; tx_*

====
tx_*
====

The `tx_` prefix key is not used in the core itself, and is just a
reserved space for extensions to never collide with core options, a
use case could be `tx_news` for the news extension. Extension developers
should create a key like that: `tx_[extension key with no underscore]`
