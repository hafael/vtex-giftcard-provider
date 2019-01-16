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

namespace Hafael\VTEX\GiftCardProvider\Api;


class GiftCards extends Api
{

    /**
     * Users who viewed the specified item also viewed the returned items. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $relationName
     * @param Date $expiringDate
     * @param $caption
     * @param $redemptionCode
     * @return array|mixed
     */
    public function createGiftCard($relationName, $expiringDate, $caption, $redemptionCode)
    {
        return $this->_get("giftcards", [
            "relationName" => $relationName,
            "expiringDate" => $expiringDate,
            "caption" => $caption,
            "redemptionCode" => $redemptionCode,
        ]);
    }

    /**
     * Users who bought the specified item also bought the items returned by this method. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $giftCardID
     * @return array|mixed
     */
    public function getGiftCard($giftCardID)
    {
        return $this->_get("giftcards/".$giftCardID);
    }

    /**
     * Users who rated the specified item 'good' did the same with items returned by this method. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $sessionId
     * @param $itemId
     * @param null $itemType
     * @param null $requestedItemType
     * @param $userId
     * @param null $withProfile
     * @return array|mixed
     */
    public function getGiftCardFromJSON($data, $offset = 0, $perPage = 49)
    {
        return $this->_post("giftcards/_search", [], $data, [
            'REST-Range' => (string) $offset.'-'.$perPage
        ]);
    }

    /**
     * Users who viewed the specified item also viewed the returned items. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $giftCardID
     * @return array|mixed
     */
    public function getTransactions($giftCardID, $offset = 0, $perPage = 49)
    {
        return $this->_get("giftcards/".$giftCardID."/transactions", [], [
            'REST-Range' => (string) $offset.'-'.$perPage
        ]);
    }

    /**
     * Users who viewed the specified item also viewed the returned items. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $giftCardID
     * @return array|mixed
     */
    public function getTransactionByID($giftCardID, $transactionID)
    {
        return $this->_get("giftcards/".$giftCardID."/transactions/".$transactionID);
    }

    /**
     * Users who rated the specified item 'good' did the same with items returned by this method. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $giftCardID
     * @param array $data
     * @return array|mixed
     */
    public function createTransaction($giftCardID, $data)
    {
        return $this->_post("giftcards/".$giftCardID."/transactions", [], $data);
    }

    /**
     * Users who viewed the specified item also viewed the returned items. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $giftCardID
     * @return array|mixed
     */
    public function getTransactionAuthorizations($giftCardID, $transactionID)
    {
        return $this->_get("giftcards/".$giftCardID."/transactions/".$transactionID."/authorization");
    }

    /**
     * Users who viewed the specified item also viewed the returned items. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $giftCardID
     * @return array|mixed
     */
    public function getTransactionCancellations($giftCardID, $transactionID)
    {
        return $this->_get("giftcards/".$giftCardID."/transactions/".$transactionID."/cancellations");
    }

    /**
     * Users who rated the specified item 'good' did the same with items returned by this method. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $giftCardID
     * @param array $data
     * @return array|mixed
     */
    public function cancelTransaction($giftCardID, $transactionID, $data)
    {
        return $this->_post("giftcards/".$giftCardID."/transactions/".$transactionID."/cancellations", [], $data);
    }

    /**
     * Users who viewed the specified item also viewed the returned items. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $giftCardID
     * @return array|mixed
     */
    public function getTransactionSettlements($giftCardID, $transactionID)
    {
        return $this->_get("giftcards/".$giftCardID."/transactions/".$transactionID."/settlements");
    }

    /**
     * Users who rated the specified item 'good' did the same with items returned by this method. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $giftCardID
     * @param array $data
     * @return array|mixed
     */
    public function createTransactionSettlement($giftCardID, $transactionID, $data)
    {
        return $this->_post("giftcards/".$giftCardID."/transactions/".$transactionID."/settlements", [], $data);
    }

}