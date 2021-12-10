<?php

namespace Ampeco\OmnipayPayMe;

trait CommonParameters
{
    public function getSellerId()
    {
        return $this->getParameter('seller_id');
    }

    public function setSellerId($value)
    {
        return $this->setParameter('seller_id', $value);
    }
}
