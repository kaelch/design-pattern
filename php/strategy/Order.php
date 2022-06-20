<?php

/**
 * A simplified representation of the Order class.
 */
class Order
{
    /**
     * For the sake of simplicity, we'll store all created orders here...
     *
     * @var array
     */
    private static $orders = [];

    /**
     * ...and access them from here.
     *
     * @param int $orderId
     * @return mixed
     */
    public static function get(int $orderId = null)
    {
        if ($orderId === null) {
            return static::$orders;
        } else {
            return static::$orders[$orderId];
        }
    }

    /**
     * The Order constructor assigns the values of the order's fields. To keep
     * things simple, there is no validation whatsoever.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = count(static::$orders);
        $this->status = "new";
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }
        static::$orders[$this->id] = $this;
    }

    /**
     * The method to call when an order gets paid.
     */
    public function complete(): void
    {
        $this->status = "completed";
        echo "Order: #{$this->id} is now {$this->status}.";
    }
}