<?php
/**
 * Created by PhpStorm.
 * User: levsemin
 * Date: 08.07.2018
 * Time: 12:20
 */

namespace Darvin\OmnipayTelr\Messages;


use Omnipay\Common\Message\ResponseInterface;
use RuntimeException;
use Symfony\Component\HttpFoundation\ParameterBag;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * @return string
     */
    protected abstract function getUrl();

    /**
     * @param array $result
     *
     * @return ResponseInterface
     */
    protected abstract function createResponse($result);

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request(
            'POST',
            $this->getUrl(),
            [],
            http_build_query($data)
        );

        return $this->createResponse($this->getJsonResult($httpResponse));
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array
     */
    protected function getJsonResult(\Psr\Http\Message\ResponseInterface $response)
    {
        if ($response->getStatusCode()<200 || $response->getStatusCode()>=300) {
            throw new RuntimeException("Telr responded with status code".$response->getStatusCode());
        }

        $result = json_decode($response->getBody(), true);
        if (isset($result['error'])) {
            throw new \RuntimeException("Telr error: ".implode(",", $result['error']));
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function initialize(array $parameters = [])
    {
        if (null !== $this->response) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        $this->parameters = new ParameterBag($parameters);

        return $this;
    }
}