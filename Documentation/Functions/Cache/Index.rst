.. include:: ../../Includes.txt


.. _cache:

=====
cache
=====

Stores the rendered content into the caching framework and reads it
from there. This allows you to reuse this content without prior
rendering. The presence of :ts:`cache.key` will trigger this feature. It
is evaluated twice:

- Content is read from cache directly after the ``stdWrapPreProcess`` hook
  and before ``setContentToCurrent``. If there is a cache entry for the
  given cache key, :ts:`stdWrap` processing will stop and the cached content
  will be returned. If no cache content is found for this key, the
  stdWrap processing continues as usual.

- Writing to cache happens at the end of rendering, directly before the
  ``stdWrapPostProcess`` hook is called and before the "debug\*" functions.
  The rendered content will be stored in the cache, if cache.key was
  set. The configuration options cache.tags and cache.lifetime allow to
  control the caching.


.. ### BEGIN~OF~TABLE ###

.. _cache-key:

key
===

.. container:: table-row

   Property
         key

   Data type
         :ref:`data-type-string` / :ref:`stdwrap`

   Description
         The cache identifier that is used to store the rendered content into
         the cache and to read it from there.

         **Note:** Make sure to use a valid cache identifier. Also take care
         to choose a cache key that is accurate enough to distinguish different
         versions of the rendered content while being generic enough to stay
         efficient.

.. _cache-lifetime:

lifetime
========

.. container:: table-row

   Property
         lifetime

   Data type
         mixed / :ref:`stdwrap`

   Description
         Lifetime of the content in cache.

         Allows you to determine the lifetime of the cached object
         independently of the lifetime of the cached version of the page on
         which it is used.

         Possible values are any positive integer and the keywords "unlimited"
         and "default":

         **integer:** Lifetime in seconds.

         **"unlimited":** Cached content will not expire unless actively
         purged by id or by tag or if the complete cache is flushed.

         **"default":** The default cache lifetime as configured in
         :ts:`config.cache_period` is used.

   Default
         default

.. _cache-tags:

tags
====

.. container:: table-row

   Property
         tags

   Data type
         :ref:`data-type-string` /:ref:`stdwrap`

   Description
         Can hold a comma-separated list of tags. These tags will be attached
         to the cached content into the ``cache_hash`` storage (not into
         ``cache_pages``) and can be used to purge the cached content.


.. ###### END~OF~TABLE ######

[tsref:->cache]


.. _cache-examples:

Examples:
=========

::

   5 = TEXT
   5 {
       stdWrap.cache.key = mycurrenttimestamp
       stdWrap.cache.tags = tag_a,tag_b,tag_c
       stdWrap.cache.lifetime = 3600
       stdWrap.data = date : U
       stdWrap.strftime = %H:%M:%S
   }

In the above example the current time will be cached with the key
"mycurrenttimestamp". This key is fixed and does not take the current
page id into account. So if you add this to your TypoScript, the
cObject will be cached and reused on all pages (showing you the same
timestamp). ::

   5 = TEXT
   5 {
       stdWrap.cache.key = mycurrenttimestamp_{page:uid}_{TSFE:sys_language_uid}
       stdWrap.cache.key.insertData = 1
   }

Here a dynamic key is used. It takes the page id and the language uid
into account making the object page and language specific.

cache as first-class function:
==============================

The :ts:`stdWrap.cache.` property is also available as first-class function to all
content objects. This skips the rendering even for content objects that evaluate
:ts:`stdWrap` after rendering (e.g. :ts:`COA`).

Usage:

.. code-block:: typoscript

   page = PAGE
   page.10 = COA
   page.10 {
       cache.key = coaout
       cache.lifetime = 60
       #stdWrap.cache.key = coastdWrap
       #stdWrap.cache.lifetime = 60
       10 = TEXT
       10 {
           cache.key = mycurrenttimestamp
           cache.lifetime = 60
           data = date : U
           strftime = %H:%M:%S
           noTrimWrap = |10: | |
       }
       20 = TEXT
       20 {
           data = date : U
           strftime = %H:%M:%S
           noTrimWrap = |20: | |
       }
   }

The commented part is :ts:`stdWrap.cache.` property available since 4.7,
that does not stop the rendering of :ts:`COA` including all sub-cObjects.

Additionally, :ts:`stdWrap` support is added to key, lifetime and tags.

If you've previously used the :ts:`cache.` property in your custom cObject,
this will now fail, because :ts:`cache.` is unset to avoid double caching.
You are encouraged to rely on the core methods for caching cObjects or
rename your property.

:ts:`stdWrap.cache` continues to exists and can be used as before. However
the top level :ts:`stdWrap` of certain cObjects (e.g. :ts:`TEXT` cObject)
will not evaluate :ts:`cache.` as part of :ts:`stdWrap`, but before starting
the rendering of the :ref:`data-type-cobject`.
In conjunction the storing will happen after the :ref:`stdwrap`
processing right before the content is returned.

Top level :ts:`cache.` will not evaluate the hook
:php:`$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_content.php']['stdWrap_cacheStore']`
any more.
