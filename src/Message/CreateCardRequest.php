<?php

namespace Ampeco\OmnipayPayMe\Message;

class CreateCardRequest extends AbstractRequest
{
    public function getLang()
    {
        return $this->getParameter('lang');
    }

    public function setLang($value)
    {
        $value = strtoupper($value);
        if (! in_array($value, ['EN', 'HE'])) {
            $value = 'EN';
        }

        return $this->setParameter('lang', $value);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function getEndpoint()
    {
        return 'generate-sale';
    }

    public function getData()
    {
        $this->validate('transactionId', 'amount', 'currency', 'returnUrl', 'notifyUrl', 'lang', 'description');

        $params = [
            'seller_payme_id' => $this->getSellerId(),
            'sale_price' => $this->getAmountInteger(),
            'currency' => $this->getCurrency(),
            'product_name' => $this->getDescription(),
            'installments' => 1,
            'transaction_id' => $this->getTransactionId(),
            'sale_callback_url' => $this->getNotifyUrl(),
            'sale_return_url' => $this->getReturnUrl(),
            'sale_send_notification' => false,
            'sale_email' => $this->getEmail(),
            'language' => $this->getLang(),
        ];

        if ($params['sale_price'] === 0) {
            $params['sale_type'] = 'token';
        } else {
            $params['capture_buyer'] = 1;
        }

        return $params;
    }
}
