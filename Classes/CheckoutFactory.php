<?php


namespace Classes;


class CheckoutFactory implements  CheckoutFactoryInterface
{
    public static function create(PromotionalRules $promotionalRules)
    {
        return new Checkout($promotionalRules);
    }

}