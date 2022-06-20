<?php

/**
 * The Strategy interface describes how a client can use various Concrete
 * Strategies.
 *
 * Note that in most examples you can find on the Web, strategies tend to do
 * some tiny thing within one method. However, in reality, your strategies can
 * be much more robust (by having several methods, for example).
 */
interface PaymentMethod
{
    public function getPaymentForm(Order $order): string;

    public function validateReturn(Order $order, array $data): bool;
}
