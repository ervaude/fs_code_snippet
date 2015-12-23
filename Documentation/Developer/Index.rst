.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _developer:

Developer Corner
================

Target group: **Developers**

Per default this extensions only provides a small sample of programming languages supported by prism.js.
If you need another programming language, you can achieve this by overwriting the TCA for the programming_language field.

.. code-block:: php

    $GLOBALS['TCA']['tt_content']['columns']['programming_langauge']['config']['items'][] = ['Python' => 'python'];

You can add every language identifier that prism supports. Anyway the T3Editor wont know that syntax and will run in "mixed" mode.
To include the prism component in the ``FsCodeSnippet.js`` you can make use of the shipped gulp config. Go to the extension
folder and edit the ``gulpfile`` to also include the components you need in the ``build-js`` task
(e.g. ``prismBasePath + 'components/prism-python.js'``). Then run

.. code-block:: bash

    bower install
    npm install
    gulp build

Now you should have a ``FsCodeSnippet.js`` that supports Python.

.. important::

   Make sure to move the generated ``FsCodeSnippet.js`` to your own extension and include it from there. Otherwise it will be overwritten
   if you update fs_code_snippet at any time in the future.