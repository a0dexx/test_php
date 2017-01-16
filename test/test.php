<?php


require_once("Classes/ClassLoader.php");

class checkoutTest extends PHPUnit_Framework_TestCase
{
    /*
     * set up items and promotions
     */
    public function setUp()
    {
        $this->item1 =  \Classes\ProductFactory::create("001", "Lavender heart", 9.25);
        $this->item2 =  \Classes\ProductFactory::create("002", "Personalised cufflinks", 45.00);
        $this->item3 =  \Classes\ProductFactory::create("003", "Kids T-shirt", 19.95);

        $this->promotionRules = new \Classes\PromotionalRules(10,0.75);

    }

    /*
     * test that items are correct
     */
    public function testFactory()
    {
        $this->assertEquals('001', $this->item1->getCode());
        $this->assertEquals('002', $this->item2->getCode());
        $this->assertEquals('003', $this->item3->getCode());
        $this->assertEquals('Lavender heart', $this->item1->getName());
        $this->assertEquals('Personalised cufflinks', $this->item2->getName());
        $this->assertEquals('Kids T-shirt', $this->item3->getName());
        $this->assertEquals(9.25, $this->item1->getPrice());
        $this->assertEquals(45.00, $this->item2->getPrice());
        $this->assertEquals(19.95, $this->item3->getPrice());
    }


    /*
     * Testing the scanner with test data
     */
    public function testTotals()
    {
        $co = \Classes\CheckoutFactory::create($this->promotionRules);
        $co->scan($this->item1);
        $co->scan($this->item2);
        $co->scan($this->item3);

        $this->assertEquals('£66.78', $co->total());

        $co2 = \Classes\CheckoutFactory::create($this->promotionRules);
        $co2->scan($this->item1);
        $co2->scan($this->item3);
        $co2->scan($this->item1);

        $this->assertEquals('£36.95', $co2->total());


        $co3 = \Classes\CheckoutFactory::create($this->promotionRules);
        $co3->scan($this->item1);
        $co3->scan($this->item2);
        $co3->scan($this->item1);
        $co3->scan($this->item3);

        $this->assertEquals('£73.76', $co3->total());


    }

}