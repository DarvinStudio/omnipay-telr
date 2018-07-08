<?php
/**
 * Created by PhpStorm.
 * User: levsemin
 * Date: 08.07.2018
 * Time: 13:07
 */

namespace Darvin\OmnipayTelr\Messages;


use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseRedirectResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return $this->getData()['order']['ref'];
    }

    /**
     * @inheritDoc
     */
    public function getRedirectUrl()
    {
        return $this->getData()['order']['url'];
    }

    /**
     * @inheritDoc
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * @inheritDoc
     */
    public function isRedirect()
    {
        return true;
    }
}