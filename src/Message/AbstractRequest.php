<?php

namespace Ampeco\OmnipayPayMe\Message;

use Ampeco\OmnipayPayMe\CommonParameters;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    use CommonParameters;

    const ENDPOINT_PRODUCTION = 'https://ng.paymeservice.com/api/';
    const ENDPOINT_TESTING = 'https://preprod.paymeservice.com/api/';

    abstract public function getEndpoint();

    public function getBaseUrl()
    {
        return $this->getTestMode() ? self::ENDPOINT_TESTING : self::ENDPOINT_PRODUCTION;
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $headers = array_merge($this->getHeaders(), [
            'Content-Type' => 'application/json',
        ]);

        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            $this->getBaseUrl() . ltrim($this->getEndpoint(), '/'),
            $headers,
            json_encode($data),
        );

        return $this->createResponse(
            $httpResponse->getBody()->getContents(),
            $httpResponse->getStatusCode(),
        );
    }

    protected function createResponse($data, $statusCode)
    {
        $responseClass = $this->getResponseClass();

        return $this->response = new $responseClass($this, $data, $statusCode);
    }

    protected function getResponseClass()
    {
        return Response::class;
    }
}
