<?php

namespace Ampeco\OmnipayPayMe\Message;

class PurchaseResponse extends Response
{
    const STATUS_SUCCESS = 'success';

    public function getStatus()
    {
        return @$this->data['payme_status'];
    }

    public function isSuccessful()
    {
        return parent::isSuccessful() && $this->getStatus() === self::STATUS_SUCCESS;
    }
}
