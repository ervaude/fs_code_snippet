# EXT: fs_code_snippet

fs_code_snippet is an extension for TYPO3. It implements a content element that enables you to render code snippets of various
programming languages. It depends on fluid_styled_content rendering.

It makes use of the T3Editor in the backend and the code snippet library prism.js in the frontend.

## Requirements

* TYPO3 9 LTS or 10 LTS
* fluid_styled_content
* t3editor

## Installation and Setup
Installing and configuring this extension is pretty straight forward. There are only a few things that can be configured.

### Installation

To install the extension, perform the following steps:

* Go to the Extension Manager
* Install the extension
* Load the static template

###  Configuration

Most configuration is done via TypoScript constants which are editable in the constant editor in the TYPO3 backend.

* The TemplateRootPath can be overwritten with constant `{$plugin.tx_fscodesnippet.view.templateRootPath}`. However, the fallback mechanism of
`FLUIDTEMPLATE` could be used as well to override the default template.

* In the constant editor the *theme* of the code snippet can be adjusted according to the themes shipped by prism.js.

* Line numbers are enabled.

## Extendability

Per default this extensions only provides a curated subset of programming languages from the huge list supported by prism.js.
The main reason for this is to prevent the included JavaScript from being bloated with lots of code you never need.
If you however do need support for a programming language not included in the default set, you can add any language yourself.
You achieve this by overwriting the TCA for the programming_language field to include more programming_languages and extend
the JavaScript with the corresponding syntax highlighter.

To add a new language to the TCA you can use the constant from the included CodeSnippetLanguage Enumeration to get the needed string right.
In any extension of yours, create the file `Configuration/TCA/Overrides/tt_content.php` and add the following code to it:

.. code-block:: php

    $GLOBALS['TCA']['tt_content']['columns']['programming_language']['config']['items'][] = ['Python' => \DanielGoerz\FsCodeSnippet\Enumeration\CodeSnippetLanguage::PYTHON];

You can add every language identifier that prism supports. Anyway the T3Editor won't know that syntax and will run in "mixed" mode.

To enable the syntax highlighting in the frontend you need to include the corresponding JavaScript component from prism.js. In case of python
this would be components/prism-python.js. You can either download the component from prismjs.com or github or you can use the
gulp build shipped with this extension to generate a new all-in-one file.

To do so, go to the extension folder and edit the `gulpfile` to also include the components you need in the `buildJs` task
(e.g. `prismBasePath + 'components/prism-python.js'`). Then run

.. code-block:: bash

    yarn install
    gulp build

Now you should have a `FsCodeSnippet.js` that supports Python.

*Make sure to move the generated `FsCodeSnippet.js` to your own extension and include it from there. Otherwise it will be overwritten if you update fs_code_snippet at any time in the future.*

---


_Made by Daniel Goerz (@[b13](https://b13.com)) with ♥_