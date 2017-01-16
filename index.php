<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 13/01/17
 * Time: 20:29
 */


require_once("Classes/ClassLoader.php");


use Classes\CheckoutFactory;
$factory = new CheckoutFactory();
//create items
$item1 =  \Classes\ProductFactory::create("001", "Lavender heart", 9.25);
$item2 =  \Classes\ProductFactory::create("002", "Personalised cufflinks", 45.00);
$item3 =  \Classes\ProductFactory::create("003", "Kids T-shirt", 19.95);

//create promos
$promoRules = new \Classes\PromotionalRules(10,0.75);

//create checkout
$co = CheckoutFactory::create($promoRules);


//scan some items
$co->scan($item1);$co->scan($item1);
$co->scan($item2);
$co->scan($item3);
$co->scan($item2);
$co->scan($item3);
$co->scan($item3);

echo"<PRE>";
print_r($co->total());

echo"</PRE>";




