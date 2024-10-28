.. include:: /Includes.rst.txt


.. _guide-stdwrap-recursively:

================
Modify the order
================

There is a way around this ordering restriction. `stdWrap` has a property
called `orderedStdWrap` in which several `stdWrap` properties can
be called in numerical order. Thus::

   10 = TEXT
   10 {
      value = typo3
      orderedStdWrap {
         10.noTrimWrap = |<strong>Tool: |</strong>|
         20.case = upper
      }
   }

results in:

.. code-block:: html

   <strong>TOOL: TYPO3</strong>

because we explicitly specified that `noTrimWrap` should happen before
`case`.

It should be noted that `stdWrap` itself has a `stdWrap` property,
meaning that it can be called recursively. In most case `orderedStdWrap`
will do the job and is much easier to understand making code easier to
maintain.
