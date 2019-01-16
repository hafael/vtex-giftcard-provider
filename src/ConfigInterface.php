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


interface ConfigInterface
{
    

    /**
     * Returns the current GiftCardProvider server base URL.
     *
     * @return string
     */
    public function getBaseUrl();

    /**
     * Sets the current current GiftCardProvider server base URL.
     *
     * @param  string  $baseUrl
     * @return $this
     */
    public function setBaseUrl($baseUrl);

    /**
     * Returns the GiftCardProvider API key.
     *
     * @return string
     */
    public function getAccountName();

    /**
     * Sets the VTEX Account Name.
     *
     * @param  string  $accountName
     * @return $this
     */
    public function setAccountName($accountName);
    
}