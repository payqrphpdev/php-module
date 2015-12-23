<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PayqrModuleInstallPage
 *
 * @author 1
 */
class PayqrModuleInstallPage 
{
    public function getHtml()
    {
        $step = isset($_GET["step"]) ? $_GET["step"] : 1;
        $install = new PayqrModuleInstall();
        $html = "";
        switch ($step)
        {
            case 1:
                if(isset($_POST["username"]) && !empty($_POST["username"]))
                {
                    if($install->saveDbConfig($_POST))
                    {
                        PayqrModule::redirect("install", array("step"=>"2"));
                    }
                    else{
                        $html .= "<div class='error'>Неверные доступы в бд</div>";
                    }
                }
                $html .= "<form id='auth_form' method='post'>";
                $html .= "<div>Введите данные для доступа к бд</div>";
                $html .= "<input type='hidden' name='step1'/>";
                $html .= "<div><label>Имя пользователя: <input type='text' name='username'/></label></div>";
                $html .= "<div><label>Пароль: <input type='password' name='password'/></label></div>";
                $html .= "<div><label>Имя базы данных: <input type='text' name='database'/></label></div>";
                $html .= "<div><label>Префикс таблиц: <input type='text' name='prefix'/></label></div>";
                $html .= "<div><label>Хост: <input type='text' value='localhost' name='host'/></label></div>";
                $html .= "<div><input type='submit' value='Отправить'/></div>";
                $html .= "</form>";
                break;
            case 2:
                $install->createTables();
                if(isset($_POST["step2"]))
                {
                    $msg = $install->register($_POST);
                    $html .= "<div class='error'>$msg</div>";
                }
                $html .= "<form id='auth_form' method='post'>";
                $html .= "<input type='hidden' name='step2'/>";
                $html .= "<div>Введите данные для входа в кабинет</div>";
                $html .= "<div><label>Имя пользователя: <input type='text' name='username'/></label></div>";
                $html .= "<div><label>Пароль: <input type='password' name='password'/></label></div>";
                $html .= "<div><label>Повторите пароль: <input type='password' name='password_repeat'/></label></div>";
                $html .= "<div><input type='submit' value='Отправить'/></div>";
                $html .= "</form>";
                break;
            default:
                $html = "<h1>Установка завершена</h1>";
                break;
        }

        return $html;
    }
}
