<?php
/**
 * Created by PhpStorm.
 * User: levsemin
 * Date: 08.07.2018
 * Time: 14:11
 */

namespace Darvin\OmnipayTelr\Messages;


use Omnipay\Common\Message\AbstractResponse;

class CheckPurchaseResponse extends AbstractResponse
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->getData()['order']['status']['code'] == 3;
    }
}