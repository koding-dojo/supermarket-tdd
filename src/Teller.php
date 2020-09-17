<?php

namespace Supermarket;

class Teller
{
    private array $items = [];
    private Catalog $catalog;
    private array $offers;

    /**
     * Checkout constructor.
     *
     * @param Catalog $catalog
     * @param array $offers
     */
    public function __construct(Catalog $catalog, array $offers)
    {
        $this->catalog = $catalog;
        $this->offers = $offers;
    }

    public function getTotal()
    {
        $total = 0.0;
        foreach ($this->items as $sku => $quantity) {
            $total += $this->catalog->getUnitPrice($sku) * $quantity;

            if ($this->hasOffer($sku)) {
                /** @var OfferXForY $offer */
                $offer = $this->offers[$sku];
                $total += $offer->getDiscount($this->catalog->getUnitPrice($sku), $quantity);
            }
        }
        return $total;
    }

    public function scan(string $sku)
    {
        if (!isset($this->items[$sku])) {
            $this->items[$sku] = 0;
        }

        $this->items[$sku]++;
    }

    /**
     * @param $sku
     * @return bool
     */
    private function hasOffer($sku): bool
    {
        return isset($this->offers[$sku]);
    }
}
