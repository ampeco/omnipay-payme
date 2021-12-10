<?php

namespace Ampeco\OmnipayPayMe;

use Ampeco\OmnipayPayMe\Message\AbstractRequest;
use Ampeco\OmnipayPayMe\Message\CaptureRequest;
use Ampeco\OmnipayPayMe\Message\PurchaseRequest;
use Ampeco\OmnipayPayMe\Message\CreateCardRequest;
use Ampeco\OmnipayPayMe\Message\RedirectedBackNotification;
use Ampeco\OmnipayPayMe\Message\SaleNotification;
use Ampeco\OmnipayPayMe\Message\VoidRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\NotificationInterface;

/**
 * @method \Omnipay\Common\Message\AbstractRequest completeAuthorize(array $options = [])
 * @method \Omnipay\Common\Message\AbstractRequest completePurchase(array $options = [])
 * @method \Omnipay\Common\Message\AbstractRequest refund(array $options = [])
 * @method \Omnipay\Common\Message\AbstractRequest fetchTransaction(array $options = [])
 * @method \Omnipay\Common\Message\AbstractRequest updateCard(array $options = [])
 */
class Gateway extends AbstractGateway
{
    use CommonParameters;

    public function getName()
    {
        return 'PayMe';
    }

    public function createCard(array $options = []): AbstractRequest
    {
        return $this->createRequest(CreateCardRequest::class, $options);
    }

    public function authorize(array $options = []): AbstractRequest
    {
        return $this->createRequest(PurchaseRequest::class, array_merge($options, ['hold' => true]));
    }

    public function capture(array $options = []): AbstractRequest
    {
        return $this->createRequest(CaptureRequest::class, $options);
    }

    public function void(array $options = []): AbstractRequest
    {
        return $this->createRequest(VoidRequest::class, $options);
    }

    public function purchase(array $options = []): AbstractRequest
    {
        return $this->createRequest(PurchaseRequest::class, array_merge($options, ['hold' => false]));
    }

    public function deleteCard(array $options = []): AbstractRequest
    {
        throw new \Exception('Delete card is not supported by the payment provider');
    }

    public function acceptNotification(array $options = []): SaleNotification
    {
        return new SaleNotification($options);
    }

    public function acceptRedirectedBack(array $options = []): RedirectedBackNotification
    {
        return new RedirectedBackNotification($options);
    }
}
