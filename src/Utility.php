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


class Utility
{

    /**
     * Encode the given parameters.
     *
     * @param  array  $parameters
     * @return array
     */
    public static function transformArrayIntoHttpQuery(array $parameters)
    {

        //Transforms the value of boolean parameters to string
        $parameters = array_map(function ($parameter) {
            return is_bool($parameter) ? ($parameter === true ? 'true' : 'false') : $parameter;
        }, $parameters);


        return preg_replace('/\%5B\d+\%5D/', '%5B%5D', http_build_query($parameters));
    }


}