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


class GiftCardProvider
{
    
    /**
     * The Config repository instance.
     *
     * @var \Hafael\VTEX\GiftCardProvider\ConfigInterface
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param string $baseUrl
     * @param string $accountName
     */
    public function __construct($baseUrl = null, $accountName = null)
    {
        $this->config = new Config($baseUrl, $accountName);
    }

    /**
     * Create a new VTEX GiftCardProvider API instance.
     *
     * @param  string $baseUrl
     * @param  string $accountName
     * @return GiftCardProvider
     */
    public static function make($baseUrl = null, $accountName = null)
    {
        return new static($baseUrl, $accountName);
    }

    /**
     * Returns the Config repository instance.
     *
     * @return \Hafael\VTEX\GiftCardProvider\ConfigInterface
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Sets the Config repository instance.
     *
     * @param  \Hafael\VTEX\GiftCardProvider\ConfigInterface  $config
     * @return $this
     */
    public function setConfig(ConfigInterface $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Returns the GiftCard base URL.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->config->getBaseUrl();
    }

    /**
     * Sets the GiftCard base URL.
     *
     * @param  string  $baseUrl
     * @return $this
     */
    public function setBaseUrl($baseUrl)
    {
        $this->config->setBaseUrl($baseUrl);

        return $this;
    }

    /**
     * Returns the GiftCard API key.
     *
     * @return string
     */
    public function getAccountName()
    {
        return $this->config->getAccountName();
    }

    /**
     * Sets the GiftCardProvider Account Name.
     *
     * @param  string  $accountName
     * @return $this
     */
    public function setAccountName($accountName)
    {
        $this->config->setAccountName($accountName);

        return $this;
    }

    /**
     * Dynamically handle missing methods.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return \Hafael\VTEX\GiftCardProvider\Api\ApiInterface
     */
    public function __call($method, array $parameters)
    {
        return $this->getApiInstance($method);
    }


    /**
     * Returns the Api class instance for the given method.
     *
     * @param  string  $method
     * @return \Hafael\VTEX\GiftCardProvider\Api\ApiInterface
     * @throws \BadMethodCallException
     */
    protected function getApiInstance($method)
    {
        $class = "\\Hafael\\VTEX\\GiftCardProvider\\Api\\".ucwords($method);

        if (class_exists($class)) {
            return new $class($this->config);
        }

        throw new \BadMethodCallException("Undefined method [{$method}] called.");
    }

}