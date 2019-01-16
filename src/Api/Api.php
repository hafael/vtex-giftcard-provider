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

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\TransferException;
use Hafael\VTEX\GiftCardProvider\Utility;
use Hafael\VTEX\GiftCardProvider\ConfigInterface;
use Hafael\VTEX\GiftCardProvider\Exception\Handler;

abstract class Api implements ApiInterface
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
     * @param  \Hafael\VTEX\GiftCardProvider\ConfigInterface  $client
     * @return void
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function baseUrl()
    {
        return $this->config->getBaseUrl();
    }


    /**
     * {@inheritdoc}
     */
    public function _get($url = null, $parameters = [], $headers = [])
    {

        return $this->execute('get', $url, $parameters, [], $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function _head($url = null, array $parameters = [])
    {
        return $this->execute('head', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _delete($url = null, array $parameters = [])
    {
        return $this->execute('delete', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _put($url = null, array $parameters = [])
    {
        return $this->execute('put', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _patch($url = null, array $parameters = [])
    {
        return $this->execute('patch', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _post($url = null, array $parameters = [], array $data = [], array $headers = [])
    {
        return $this->execute('post', $url, $parameters, $data, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function _options($url = null, array $parameters = [])
    {
        return $this->execute('options', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function execute($httpMethod, $url, array $parameters = [], array $data = [], array $headers = [])
    {
        try {
            
            $parameters = Utility::transformArrayIntoHttpQuery($parameters);

            $response = $this->getClient($headers)->{$httpMethod}($this->config->getAccountName().'/'.$url, [ 'query' => $parameters ])->setBody(json_encode($data));

            return json_decode((string) $response->getBody(), true);
        } catch (ClientException $e) {
            new Handler($e);
        }
    }

    /**
     * Returns an Http client instance.
     *
     * @return \GuzzleHttp\Client
     */
    protected function getClient(array $headers = [])
    {
        return new Client([
            'base_uri' => $this->baseUrl(), 'handler' => $this->createHandler($headers)
        ]);
    }

    /**
     * Create the client handler.
     *
     * @return \GuzzleHttp\HandlerStack
     */
    protected function createHandler(array $headers = [])
    {
        $stack = HandlerStack::create();

        $stack->push(Middleware::mapRequest(function (RequestInterface $request) use ($headers) {

            $request = $request->withHeader('Accept', 'application/vnd.vtex.giftcard.v1+json');

            $request = $request->withHeader('Content-Type', 'application/json');

            foreach($headers as $key => $value) {
                $request = $request->withHeader($key, $value);
            }

            return $request;
        }));

        $stack->push(Middleware::retry(function ($retries, RequestInterface $request, ResponseInterface $response = null, TransferException $exception = null) {
            return $retries < 3 && ($exception instanceof ConnectException || ($response && $response->getStatusCode() >= 500));
        }, function ($retries) {
            return (int) pow(2, $retries) * 1000;
        }));

        return $stack;
    }
}