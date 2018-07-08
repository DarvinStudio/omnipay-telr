<?php
/**
 * Created by PhpStorm.
 * User: levsemin
 * Date: 08.07.2018
 * Time: 12:13
 */

namespace Darvin\OmnipayTelr;


use Darvin\OmnipayTelr\Messages\CheckPurchaseRequest;
use Darvin\OmnipayTelr\Messages\PurchaseRequest;
use Darvin\PaymentBundle\UrlBuilder\Exception\ActionNotImplementedException;
use Omnipay\Common\AbstractGateway;

/**
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = [])
 */
class TelrGateway extends AbstractGateway
{
    public function purchase(array $options = [])
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    public function completePurchase(array  $options = [])
    {
        return $this->createRequest(CheckPurchaseRequest::class, $options);
    }

    /**
     * @param string $storeId
     */
    public function setIvpStore($storeId)
    {
        $this->setParameter('ivp_store', $storeId);
    }

    /**
     * @param string $authKey
     */
    public function setIvpAuthkey($authKey)
    {
        $this->setParameter('ivp_authkey', $authKey);
    }

    /**
     * @param int $testMode 0 - live, 1 - test
     */
    public function setIvpTest($testMode)
    {
        $this->setParameter('ivp_test', $testMode);
    }

    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     * @return string
     */
    public function getName()
    {
        return 'telr';
    }

    public function __call($name, $arguments)
    {
        throw new ActionNotImplementedException($name);
    }
}