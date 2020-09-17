<?php

namespace Tests;

use Supermarket\Catalog;
use Supermarket\Teller;
use Supermarket\OfferXForY;
use Supermarket\OfferPercent;
use PHPUnit\Framework\TestCase;

class SupermarketTest extends TestCase
{
    /**
     * @dataProvider totalsTestCases
     * @param string $items
     * @param float  $total
     */
    public function testTotal(string $items, float $total)
    {
        // Arrange
        $c = new Teller(new Catalog([
            'A' => 50,
            'B' => 30,
            'C' => 20,
            'D' => 15,
        ]), [
            'A' => new OfferXForY(3, 130),
            'B' => new OfferXForY(2, 45),
            'C' => new OfferPercent(50),
        ]);
        foreach (str_split($items) as $item) {
            $c->scan($item);
        }
        // Act
        // Assert
        self::assertEquals($total, $c->getTotal());
    }

    public function totalsTestCases()
    {
        return [
            'no items' => ['', 0],
            'A' => ['A', 50],
            'ABCD' => ['ABCD', 105],
            'AA' => ['AA', 100],
            'AAA' => ['AAA', 130],
            'AAAA' => ['AAAA', 180],
            'AAAAAA' => ['AAAAAA', 260],
            'AAABB' => ['AAABB', 175],
            'ABABA' => ['ABABA', 175],
        ];
    }
}
