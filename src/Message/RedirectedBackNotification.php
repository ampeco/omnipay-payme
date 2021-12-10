<?php

namespace Ampeco\OmnipayPayMe\Message;

class RedirectedBackNotification extends BaseNotification
{
    /** @var array {
     *      payme_status: string,
     *      payme_signature: string,
     *      payme_sale_id: string,
     *      payme_transaction_id: string,
     *      price: number,
     *      currency: string,
     *      transaction_id: string,
     *      is_token_sale: int[0, 1],
     *      is_foreign_card: int[0, 1],
     * } $data
     */
}
