<?php
/**
 * Part of the VTEX GiftCardProvider package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    VTEX GiftCard
 * @version    0.0.1
 * @author     VerdeIT
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017-2017, VerdeIT
 * @link       https://github.com/hafael/vtex-giftcard-provider
 */

namespace Hafael\VTEX\GiftCardProvider;


class Config implements ConfigInterface
{
    
    /**
     * The required API Key to access this service.
     * (e.g. "minhaloja")
     *
     * @var string
     */
    protected $accountName;

    /**
     * The required VTEX API server base url.
     * (e.g. "https://api.vtexcommerce.com.br")
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * The Constructor.
     *
     * @param  string $baseUrl
     * @param  string $accountName
     */
    public function __construct($baseUrl, $accountName)
    {
        
        $this->setBaseUrl($baseUrl ?: getenv('VTEX_BASE_URL'));
        $this->setAccountName($accountName ?: getenv('VTEX_ACCOUNT_NAME'));

        if (! $this->accountName || $this->accountName === '') {
            throw new \RuntimeException('The VTEX Account Name is not defined!');
        }
    }

    
    /**
     * {@inheritdoc}
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * {@inheritdoc}
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;

        return $this;
    }

}