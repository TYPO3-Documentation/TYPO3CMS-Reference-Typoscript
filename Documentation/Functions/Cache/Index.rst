.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


cache
^^^^^

(Since TYPO3 4.7)Stores the rendered content into the caching
framework and reads it from there. This allows you to reuse this
content without prior rendering. The presence of "cache.key" will
trigger this feature. It is evaluated twice:

- Content is read from cache directly after the stdWrapPreProcess hook
  and before "setContentToCurrent". If there is a cache entry for the
  given cache key, stdWrap processing will stop and the cached content
  will be returned. If no cache content is found for this key, the
  stdWrap processing continues as usual.

- Writing to cache happens at the end of rendering, directly before the
  stdWrapPostProcess hook is called and before the "debug\*" functions.
  The rendered content will be stored in the cache, if cache.key was
  set. The configuration options cache.tags and cache.lifetime allow to
  control the caching.

**Note** : This feature relies on the caching framework, which needs
to be enabled for this feature to work. Otherwise content will not be
cached, but rendered on every call.


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
         key

   Data type
         string /stdWrap

   Description
         The cache identifier that is used to store the rendered content into
         the cache and to read it from there.

         **Note** : Make sure to use a valid cache identifier. Also take care
         to choose a cache key that is accurate enough to distinguish different
         versions of the rendered content while being generic enough to stay
         efficient.

   Default


.. container:: table-row

   Property
         lifetime

   Data type
         mixed /stdWrap

   Description
         Lifetime of the content in cache.

         Allows you to determine the lifetime of the cached object
         independently of the lifetime of the cached version of the page on
         which it is used.

         Possible values are any positive integer and the keywords "unlimited"
         and "default":

         **integer** : Lifetime in seconds.

         **"unlimited"** : Cached content will not expire unless actively
         purged by id or by tag or if the complete cache is flushed.

         **"default"** : The default cache lifetime as configured in
         config.cache\_period is used.

   Default
         default


.. container:: table-row

   Property
         tags

   Data type
         string /stdWrap

   Description
         Can hold a comma-separated list of tags. These tags will be attached
         to the cached content into the cache\_hash storage (not into
         cache\_pages) and can be used to purge the cached content.

   Default


.. ###### END~OF~TABLE ######


[tsref:->cache]


((generated))
"""""""""""""

Examples:
~~~~~~~~~

::

   5 = TEXT
   5 {
     cache.key = mycurrenttimestamp
     cache.tags = tag_a,tag_b,tag_c
     cache.lifetime = 3600
     data = date : U
     strftime = %H:%M:%S
   }

In the above example the current time will be cached with the key
"mycurrenttimestamp". This key is fixed and does not take the current
page id into account. So if you add this to your TypoScript, the
cObject will be cached and reused on all pages (showing you the same
timestamp). ::

   5 = TEXT
   5 {
     cache.key = mycurrenttimestamp_{page:id}_{TSFE:sys_language_uid}
     cache.key.insertData = 1
   }

Here a dynamic key is used. It takes the page id and the language uid
into account making the object page and language specific.

