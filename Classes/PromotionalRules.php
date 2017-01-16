<?php

namespace Classes;

class PromotionalRules
{
    public $percentage_discount;
    public $lavender_qty_discount;

    public function __construct($percentage_discount = null, $lavender_qty_discount = null)
    {
        $this->percentage_discount = $percentage_discount;
        $this->lavender_qty_discount = $lavender_qty_discount;
    }

    /**
     * apply 10% discount on basket if total over £60
     *
     * @param  $total
     */
    public function percentageDiscount($total)
    {
        if ($total > 60) {
            $new_total = $total - ($total * (10 / 100));
            return round($new_total, 2);
        }
        return round($total, 2);
    }

    /*
     * take basket. check quantity of lavender. amend price of lavender within basket
     */
    public function lavenderQtyDiscount($prod_id, $basket)
    {
        if (array_key_exists($prod_id, $basket)) {
            if ($basket[$prod_id]->qty > 1) {
                $basket[$prod_id]->item->setPrice(8.5);
            }
        }
        return $basket;

    }

}

