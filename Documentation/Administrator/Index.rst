.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _admin-manual:

Administrator Manual
====================

Target group: **Administrators**

Installing and configuring this extension is pretty straight forward. There are only a few things that can be configured.


.. _admin-installation:

Installation
------------

To install the extension, perform the following steps:

#. Go to the Extension Manager
#. Install the extension
#. Load the static template


.. _admin-configuration:

Configuration
-------------

Most configuration is done via TypoScript constants which are editable in the constant editor in the TYPO3 backend.

* The TemplateRootPath can be overwritten with constant `{$plugin.tx_fscodesnippet.view.templateRootPath}`. However the fallback mechanism of
`FLUIDTEMPLATE` could be used as well to override the default template.

* In the constant editor the **theme** of the code snippet can be adjusted according to the themes shipped by prism.js.

* Line numbers are enabled.

