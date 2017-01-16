<?php
//namespace test_php;
namespace Classes;

class Checkout implements CheckoutInterface
{
    private $promotional_rules;
    private $basket;
    private $basket_item;
    //  private $total_val;

    /**
     * Create new checkout instance based on promotional rules
     *
     * @param object $promotionalRules
     */
    public function __construct($promotionalRules = null)
    {
        $this->promotional_rules = $promotionalRules;
        $this->basket = array();
    }

    /**
     * Scan new item
     *
     * @param object $item
     */
    public function scan($item)
    {
        if (array_key_exists($item->getCode(), $this->basket)) {
            $this->basket[$item->getCode()]->qty = $this->basket[$item->getCode()]->qty + 1;
        } else {
            $this->basket_item = new \stdClass();
            $this->basket_item->item = $item;
            $this->basket_item->qty = 1;
            $this->basket[$item->getCode()] = $this->basket_item;
        }
    }

    /**
     * Calculate total price of the basket including promotions
     * Returns price string in the £X.XX format
     *
     * @return string
     */
    public function total()
    {
        //apply quantity discount
        $this->promotional_rules->lavenderQtyDiscount('001', $this->basket);
        $total_val = 0;
        foreach ($this->basket as $basket_item) {
            $price = $basket_item->item->getPrice();
            $qty = $basket_item->qty;
            $item_total = ($price * $qty);
            $total_val += $item_total;
        }

        $total_val = $this->promotional_rules->percentageDiscount($total_val);
        return $this->format($total_val);
    }

    private function format($total)
    {
        $formatted_total = "£" . $total;
        return $formatted_total;
    }


}
