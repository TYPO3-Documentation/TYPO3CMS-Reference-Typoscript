.. include:: /Includes.rst.txt
.. index:: TMENU; sectionIndex
.. _section-index:

==========================
TMENU.sectionIndex
==========================

If this property is set, then the
menu will not consist of links to pages on the "next level" but rather
of links to the parent page to the menu, and in addition "#"-links to
the cObjects rendered on the page. In other words, the menu items will
be a section index with links to the content elements on the page (by
default with colPos=0!).

.sectionIndex = [boolean]

If you set this, all content elements (from tt\_content table) of
"Column" = "Normal" *and* the "Index"-check box clicked are selected.
This corresponds to the "Menu/Sitemap" content element when "Section
index" is selected as type.

.sectionIndex.type = "all" / "header"

If you set this additional property to "all", then the
"Index"-checkbox is not considered and all content elements - by
default with colPos=0 - are selected.

If this property is "header" then only content elements with a visible
header-layout (and a non-empty 'header'-field!) is selected. In other
words, if the header layout of an element is set to "Hidden" then the
page will not appear in the menu.

.sectionIndex.includeHiddenHeaders = [boolean]

If you set this and sectionIndex.type is set to "header", also elements
with a header layout set to "Hidden" will appear in the menu. This was
the default behaviour until TYPO3 4.6 and with this property you can
enable this old behaviour again.

.sectionIndex.useColPos = [integer /:ref:`stdWrap <stdwrap>`]

This property allows you to set the colPos which should be used in the
where clause of the query. Possible values are integers, default is "0".

Any positive integer and 0 will lead to a where clause containing
"colPos=x" with x being the aforementioned integer. A negative value
drops the filter "colPos=x" completely.

**Example:** ::

   tt_content.menu.20.3.1.sectionIndex.useColPos = -1


The data-record / behind the scene
==================================

When the menu-records are selected it works like this: The parent page
record is used as the "base" for the menu-record. That means that any
"no\_cache" or "target"-properties of the parent page are used for the
whole menu.

But of course some fields from the tt\_content records are
transferred. This is how it is mapped::

   $temp[$row[uid]]=$basePageRow;
   $temp[$row[uid]]['title']=$row['header'];
   $temp[$row[uid]]['subtitle']=$row['subheader'];
   $temp[$row[uid]]['starttime']=$row['starttime'];
   $temp[$row[uid]]['endtime']=$row['endtime'];
   $temp[$row[uid]]['fe_group']=$row['fe_group'];
   $temp[$row[uid]]['media']=$row['media'];
   $temp[$row[uid]]['header_layout']=$row['header_layout'];
   $temp[$row[uid]]['bodytext']=$row['bodytext'];
   $temp[$row[uid]]['image']=$row['image'];
   $temp[$row[uid]]['sectionIndex_uid']=$row['uid'];

Basically this shows that

\- the field "header" and "subheader" from tt\_content are mapped to
"title" and "subtitle" in the pages-record. Thus you shouldn't need to
change your standard menu objects to fit this thing...

\- the fields "starttime", "endtime", "fe\_group", "media" from
tt\_content are mapped to the same fields in a pages-record.

\- the fields "header\_layout", "bodytext" and "image" are mapped to
non-existing fields in the page-record

\- a new field, "sectionIndex\_uid" is introduced in the page record
which is detected by the `\TYPO3\CMS\Frontend\Typolink\PageLinkBuilder`. If this field
is present in a page record, the `PageLinkBuilder` will prepend a
hash-mark and the number of the field.

**Note:**

You cannot create submenus to sectionIndex-menus. That does not make
any sense as these elements are not pages and thereby have no
children.
