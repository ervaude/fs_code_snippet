<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'fs_code_snippet',
    'Configuration/TypoScript',
    'Code Snippet CE'
);