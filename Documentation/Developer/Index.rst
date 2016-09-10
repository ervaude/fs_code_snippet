.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _developer:

Developer Corner
================

Target group: **Developers**

Per default this extensions only provides a small set of programming languages from the huge list supported by prism.js.
The main reason for this is to prevent the included JavaScript from being bloated with lots of code you never need.
If you however do need support for a programming language not included in the default set, you can add any language yourself.
You achieve this by overwriting the TCA for the programming_language field to include more programming_languages and extend
the JavaScript with the corresponding syntax highlighter.

To add a new language to the TCA you can use the included constant from the CodeSnippetLanguage enumeration to get the needed string right.

.. code-block:: php

    $GLOBALS['TCA']['tt_content']['columns']['programming_langauge']['config']['items'][] = ['Python' => \DanielGoerz\FsCodeSnippet\Enumeration\CodeSnippetLanguage::PYTHON];

You can add every language identifier that prism supports. Anyway the T3Editor won't know that syntax and will run in "mixed" mode.
To include the prism component in the `FsCodeSnippet.js` you can make use of the shipped gulp config. Go to the extension
folder and edit the `gulpfile` to also include the components you need in the `build-js` task
(e.g. `prismBasePath + 'components/prism-python.js'`). Then run

.. code-block:: bash

    bower install
    npm install
    gulp build

Make sure the `.bowerrc` file is present to download the prism.js library to the folder where gulp expect it to be.
Now you should have a `FsCodeSnippet.js` that supports Python.

.. important::

   Make sure to move the generated `FsCodeSnippet.js` to your own extension and include it from there. Otherwise it will be overwritten
   if you update fs_code_snippet at any time in the future.