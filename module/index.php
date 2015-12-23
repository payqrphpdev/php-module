<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header('Content-type: text/html; charset=utf-8');

try
{
    require_once __DIR__ . '/../PayqrConfig.php';

    $path = isset($_GET["path"]) ? $_GET["path"] : "";
    $html = "";
    switch ($path)
    {
        case "auth":
            $page = new PayqrModuleAuthPage();
            $html = $page->getHtml();
            break;
        case "button":
            $page = new PayqrModuleButtonPage();
            $html = $page->getHtml();
            break;
        case "install":
            $page = new PayqrModuleInstallPage();
            $html = $page->getHtml();
            break;
        case "order":
            $page = new PayqrModuleOrderPage();
            $html = $page->getHtml();
            break;
        case "ajaxbutton":
            $page = new PayqrAjaxButton();
            $data = $page->getData();
            echo $data; 
            exit;
            break;
    }
    echo $html;
} 
catch (Exception $ex) 
{
    echo $ex->getMessage();
}


?>

<style>
    .error
    {
        font-weight: bold;
        color: red;
    }
    #auth_form
    {
        margin: 20% 50%;
        width: 200px;
        height: 200px;
    }
    #auth_form div
    {
        margin: 10px 20px;
        width: 100%;
    }
    .row
    {
        margin: 5px 0;
    }
    label
    {
        font-weight: bold;
        font-size: 0.9em;
        display: block;
    }
    .children
    {
        display: none;
    }
    #child-base-options
    {
        display: block;
    }
    .button_example
    {
        margin: 20px 0;
    }
    .row
    {
        margin: 12px 0;
    }
    th, td
    {
        border: 1px solid black;
    }
</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?=PayqrConfig::getBaseUrl()?>/js/payqr.js"></script>
<script>
    $("li.row a").click(function(){
        var id = "#child-" + $(this).parent().attr("id");
        $(id).toggle();
    });
    $("li.row select").change(function(){
        var id = "#child-" + $(this).parent().attr("id");
        var val = $(this).val();
        if(val == 1 || val == "nonrequired"){
            $(id).show();
        }
        else {
            $(id).hide();
        }
    });
    $("li.row select").each(function(){
        var id = "#child-" + $(this).parent().attr("id");
        var val = $(this).val();
        if(val == 1 || val == "nonrequired"){
            $(id).show();
        }
    });
    
    
    //ajax обновление кнопки
    $("#ajax_update_button").click(function(){
        getPayqrCartData();
    });
</script>