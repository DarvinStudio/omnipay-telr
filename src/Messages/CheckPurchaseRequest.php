<?php
/**
 * Created by PhpStorm.
 * User: levsemin
 * Date: 08.07.2018
 * Time: 14:06
 */

namespace Darvin\OmnipayTelr\Messages;

use Omnipay\Common\Message\ResponseInterface;

class CheckPurchaseRequest extends AbstractRequest
{
    /**
     * @return string
     */
    protected function getUrl()
    {
        return 'https://secure.telr.com/gateway/order.json';
    }

    /**
     * @param array $result
     *
     * @return ResponseInterface
     */
    protected function createResponse($result)
    {
        return new CheckPurchaseResponse($this, $result);
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        return array_merge(['ivp_method' => 'check'], $this->getParameters());
    }
}