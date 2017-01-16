<?php


//namespace test_php;
namespace Classes;

/**
 * Factory which is responsible for the
 * creation of the new checkout object
 */
interface CheckoutFactoryInterface
{
    /**
     * Create new checkout object
     *
     * @return CheckoutInterface
     */
    public static function create(PromotionalRules $promotionalRules);
}
