<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PayqrModuleOrderPage
 *
 * @author 1
 */
class PayqrModuleOrderPage 
{
    public function getHtml()
    {
        $id = isset($_GET["id"]) ? $_GET["id"] : 0;
        $order = new PayqrOrderAction($id);
        if(isset($_POST["order_form"]))
        {
            $order->handle($_POST);
        }
        $html = $order->getForm();
        return $html;
    }
}