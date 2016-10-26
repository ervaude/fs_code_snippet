<?php
namespace DanielGoerz\FsCodeSnippet\Configuration\TypoScript\ConditionMatching;

use DanielGoerz\FsCodeSnippet\Utility\FsCodeSnippetConfigurationUtility;
use TYPO3\CMS\Core\Configuration\TypoScript\ConditionMatching\AbstractCondition;

/**
 * Example condition
 */
class AllLanguagesCondition extends AbstractCondition
{
    /**
     * Check whether allLanguages is enabled
     *
     * @param array $conditionParameters
     * @return bool
     */
    public function matchCondition(array $conditionParameters)
    {
        return FsCodeSnippetConfigurationUtility::isAllLanguagesEnabled();
    }
}