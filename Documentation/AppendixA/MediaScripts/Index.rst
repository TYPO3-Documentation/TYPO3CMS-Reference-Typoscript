.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _appendix-media-scripts:

media/scripts/ in general
^^^^^^^^^^^^^^^^^^^^^^^^^

**Note:** Until TYPO3 6.0 the system extension "statictemplates" had
to be installed to be able to activate this functionality. Since TYPO3
6.1 the extension statictemplates no longer is part of the TYPO3 Core.
Instead it needs to be installed from TER.

Until TYPO3 6.0, the directory
typo3/sysext/statictemplates/media/scripts (in older versions
typo3/sysext/cms/tslib/media/scripts or just media/scripts) primarily
contained PHP scripts which were meant as 'external modules' as opposed
to features included in the typo3/sysext/frontend/Classes/
(typo3/sysext/cms/tslib/) libraries. They were distributed with TYPO3
as part of the sysext statictemplates and formed a basis for externally
developed frontend functionality. So for most of these scripts, you
could be inspired by them to write your own code. Notice the word
'most'; because some were written long time ago and do not represent
the state-of-the-day to do it.

Since TYPO3 6.1 these examples have been outsourced; statictemplates
must now be installed from TER, if you want to use it.


.. _appendix-example-templates:

About 'example templates'
"""""""""""""""""""""""""

For each plugin script there is one or more example templates. These
templates are a part of the documentation of the features in the
plugin because they describe the features of the markers and subparts
and present an example to learn from. Therefore the example templates
may be changed e.g. when new features come along.

You should therefore *not* rely on using the default templates unless
you'll accept the fact that they may change in the future! So make a
copy, modify it for your own purpose if needed and set up the
TypoScript of the plugin to use your own template file!

