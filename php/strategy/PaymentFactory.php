<?php

/**
 * This class helps to produce a proper strategy object for handling a payment.
 */
class PaymentFactory
{
    /**
     * Get a payment method by its ID.
     *
     * @param $id
     * @return PaymentMethod
     * @throws \Exception
     */
    public static function getPaymentMethod(string $id): PaymentMethod
    {
        switch ($id) {
            case "cc":
                return new CreditCardPayment();
            case "paypal":
                return new PayPalPayment();
            default:
                throw new \Exception("Unknown Payment Method");
        }
    }
}
