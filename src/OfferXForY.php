<?php

namespace Supermarket;

class OfferXForY implements Offer
{
    private float $amount;
    private float $price;

    /**
     * OfferXForY constructor.
     *
     * @param float $amount
     * @param float $price
     */
    public function __construct(float $amount, float $price)
    {
        $this->amount = $amount;
        $this->price = $price;
    }

    /**
     * @param float $unitPrice
     * @param float $quantity
     * @return float
     */
    public function getDiscount(float $unitPrice, float $quantity): float
    {
        $discount = 0.0;
        if ($quantity >= $this->amount) {
            $discount = intdiv($quantity, $this->amount) *
                ($this->price - $this->amount * $unitPrice);
        }
        return $discount;
    }
}
