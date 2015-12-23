<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PayqrModuleAuthPage
 *
 * @author 1
 */
class PayqrModuleAuthPage 
{
    public function getHtml()
    {
        $auth = new PayqrModuleAuth();
        $auth->authenticate();
        
        $html = "<div id='auth_form'>    
                    <form method='post'>
                        <div>Вход в систему</div>
                        <div><label>Логин: <input type='text' name='username'/></label></div>
                        <div><label>Пароль: <input type='password' name='password'/></label></div>
                        <div><input type='submit' value='Отправить'/></div>
                    </form>
                </div>";
        return $html;
    }
}
