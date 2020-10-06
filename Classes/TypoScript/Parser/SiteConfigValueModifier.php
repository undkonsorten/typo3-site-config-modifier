<?php
declare(strict_types=1);
namespace Undkonsorten\SiteConfigModifier\TypoScript\Parser;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\ExpressionLanguage\RequestWrapper;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Site\Entity\SiteInterface;
use TYPO3\CMS\Core\Utility\ArrayUtility;

/**
 * This file is part of the TYPO3 CMS extension site_config_modifier.
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


/**
 * This class adds a new TypoScript value modifier to TS syntax:
 *
 * Example (in TS constants):
 * <code>
 * myConstant = defaultValue
 * # myConstant will be overridden by the site configuration value defined by key.
 * # Empty env vars will override, too!
 * myConstant := getSiteConfig(key)
 * </code>
 *
 * Class SiteConfigValueModifier
 * @package Undkonsorten\SiteConfigModifier\TypoScript\Parser
 */
class SiteConfigValueModifier
{

    /**
     * Name of the modifier in TS syntax
     *
     * @var string
     */
    public const MODIFIER_KEY = 'getSiteConfig';

    /**
     * Evaluates the modifier
     *
     * @param array $params
     *      'currentValue' = value before evaluation,
     *      'functionArgument' = site config key to read
     * @return string|null
     */
    public function evaluate(array $params): ?string
    {
        $newValue = $params['currentValue'];
        $site = $this->getSite();
        if ($site instanceof Site) {
            $key = trim($params['functionArgument']);
            $configurationValue = ArrayUtility::getValueByPath($site->getConfiguration(), $key, '.');
            if ($configurationValue !== false) {
                $newValue = $configurationValue;
            }
        }
        return (string)$newValue;
    }

    protected function getSite(): SiteInterface
    {
        /** @var ServerRequestInterface $request */
        $request = $GLOBALS['TYPO3_REQUEST'];
        return (new RequestWrapper($request))->getSite();
    }

}
