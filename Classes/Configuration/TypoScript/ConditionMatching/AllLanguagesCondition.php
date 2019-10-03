<?php
namespace DanielGoerz\FsCodeSnippet\Configuration\TypoScript\ConditionMatching;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use DanielGoerz\FsCodeSnippet\Utility\FsCodeSnippetConfigurationUtility;
use TYPO3\CMS\Core\Configuration\TypoScript\ConditionMatching\AbstractCondition;

/**
 * Class AllLanguagesCondition
 *
 * @author Daniel Goerz <usetypo3@posteo.de>
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
