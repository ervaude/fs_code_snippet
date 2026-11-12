<?php
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

ExtensionManagementUtility::addStaticFile(
    'fs_code_snippet',
    'Configuration/TypoScript',
    'Code Snippet CE'
);
