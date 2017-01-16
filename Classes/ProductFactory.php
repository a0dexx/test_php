<?php


namespace Classes;

class ProductFactory
{
    public static function create($code, $name, $price)
    {
        return new Product($code, $name, $price);
    }
}