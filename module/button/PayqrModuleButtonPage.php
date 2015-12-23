<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PayqrModuleButtonPage
 *
 * @author 1
 */
class PayqrModuleButtonPage 
{
    public function getHtml()
    {
        $auth = new PayqrModuleAuth();
        if(isset($_POST["exit"]))
        {
            $auth->logOut();
        }
        $user = $auth->getUser();
        if($user)
        {
            $button = new PayqrButtonPage($user);
            if(isset($_POST["PayqrSettings"]))
            {
                $button->save($_POST["PayqrSettings"]);
            }
            $html = $button->getHtml();
            return $html;
        }
    }
}
