<?php

namespace Supermarket;

class OfferPercent implements Offer
{
    private float $percent;

    /**
     * OfferPercent constructor.
     *
     * @param float $percent
     */
    public function __construct(float $percent)
    {
        $this->percent = $percent;
    }

    /**
     * @inheritDoc
     */
    public function getDiscount(float $unitPrice, float $quantity): float
    {
        return -1 * $unitPrice * $quantity * $this->percent / 100;
    }
}
