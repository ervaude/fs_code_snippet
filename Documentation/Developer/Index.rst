.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _developer:

Developer Corner
================

Target group: **Developers**

Per default this extensions only provides a small selected subset of programming languages from the huge list supported by prism.js.
The main reason for this is to prevent the included JavaScript from being bloated with lots of code you never need.
If you however do need support for a programming language not included in the default set, you can add any language yourself.
You achieve this by overwriting the TCA for the programming_language field to include more programming_languages and extend
the JavaScript with the corresponding syntax highlighter.

To add a new language to the TCA you can use the constant from the included CodeSnippetLanguage Enumeration to get the needed string right.
In any extension of yours, create the file `Configuration/TCA/Overrides/tt_content.php` and add the following code to it:

.. code-block:: php

    $GLOBALS['TCA']['tt_content']['columns']['programming_langauge']['config']['items'][] = ['Python' => \DanielGoerz\FsCodeSnippet\Enumeration\CodeSnippetLanguage::PYTHON];

You can add every language identifier that prism supports. Anyway the T3Editor won't know that syntax and will run in "mixed" mode.

To enable the syntax highlightning in the frontend you need to include the corresponding JavaScript component from prism.js. In case of python
this would be components/prism-python.js. You can either download the component from prismjs.com or github or you can use the
gulp build shipped with this extension to generate a new all-in-one file.

To do so, go to the extension folder and edit the `gulpfile` to also include the components you need in the `build-js` task
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