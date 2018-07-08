<?php
/**
 * Created by PhpStorm.
 * User: levsemin
 * Date: 08.07.2018
 * Time: 12:20
 */

namespace Darvin\OmnipayTelr\Messages;

class PurchaseRequest extends AbstractRequest
{
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return array
     */
    public function getData()
    {
        return array_merge(['ivp_method' => 'create'], $this->getParameters());
    }

    /**
     * @inheritDoc
     */
    protected function getUrl()
    {
        return 'https://secure.telr.com/gateway/order.json';
    }

    /**
     * @inheritDoc
     */
    protected function createResponse($result)
    {
        return new PurchaseRedirectResponse($this, $result);
    }
}