<?php

namespace Ampeco\OmnipayPayMe\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

class Response extends AbstractResponse implements ResponseInterface, RedirectResponseInterface
{
    protected int $statusCode;

    public function __construct(RequestInterface $request, $data, $statusCode)
    {
        $this->request = $request;
        $this->data = json_decode($data, true);
        $this->statusCode = (int) $statusCode;
    }

    public function getRequest(): AbstractRequest
    {
        return $this->request;
    }

    public function isSuccessful()
    {
        return $this->statusCode < 400 && @$this->getStatusCode() === 0;
    }

    public function isRedirect()
    {
        return !is_null($this->getRedirectUrl());
    }

    public function getRedirectUrl()
    {
        return @$this->data['sale_url'];
    }

    public function getTransactionReference()
    {
        return @$this->data['payme_sale_id'];
    }

    public function getStatusCode()
    {
        return @$this->data['status_code'];
    }
}
