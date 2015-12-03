<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Класс для создания заказа
 *
 * @author 1
 */
class PayqrOrder 
{
    public function createOrder()
    {
        return rand(1111, 9999);
    }
    
    

    /**
     * заказ оплачен уже или нет
     */
    public function getOrderPaidStatus($invoice_id)
    {        
        $db = PayqrModuleDb::getInstance();
        $invoice = $db->select("select * from ".PayqrModuleDb::getInvoiceTable()." where invoice_id=?", array($invoice_id), array("s"));
        return $invoice;
    }
    
    /**
     * функция отмены заказа
     */
    public function cancelOrder()
    {
        
    }
    
    /**
     * функция отмены заказа
     */
    public function syncOrder()
    {
        
    }
}
