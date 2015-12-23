<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PayqrAjaxButton
 *
 * @author 1
 */
class PayqrAjaxButton 
{
    const CART = "cart";
    const PRODUCT = "product";
    const CATEGORY = "category";
    
    
    public function getData()
    {
        $type = $_GET["type"];
        $data = "";
        switch ($type)
        {
            case self::CART:
                $data = $this->getCart();
                break;
        }
        $data = json_encode($data);
        return $data;
    }
    
    public function getCart()
    {
        $amount = 20;
        $products = array(
            array(
                "article" => "1",
                "name" => " Рюкзак «Контур 50», Цвет: Лесная чаща",
                "imageUrl" => "http://fast.ulmart.ru/p/mid/350/35090/3509055.jpg",
                "amount" => "10",
                "quantity" => 2,
            )
        );
        $return = array("amount"=>$amount, "datacart"=>$products);
        return $return;
    }
}
