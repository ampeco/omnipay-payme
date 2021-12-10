<?php

namespace Ampeco\OmnipayPayMe\Message;

use Omnipay\Common\Message\NotificationInterface;

class BaseNotification implements NotificationInterface
{
    const STATUS_SUCCESS = 'success';

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getTransactionStatus()
    {
        return @$this->data['payme_status'];
    }

    public function getMessage()
    {
        return $this->getTransactionStatus();
    }

    public function getData()
    {
        return $this->data;
    }

    public function getTransactionReference()
    {
        return @$this->data['payme_sale_id'];
    }

    public function isSuccessful(): bool
    {
        return $this->getTransactionStatus() === self::STATUS_SUCCESS;
    }
}
