<?php
/**
 * Примеры запросов в PayQR
 */

require_once __DIR__ . '/../PayqrConfig.php'; // подключаем основной класс


$actions = array(
    "get_invoice" => "Получить информацию о счете по его идентификатору в PayQR",
    "invoice_cancel" => "Аннулировать счет на заказ до оплаты",
    "invoice_revert" => "Отменить и вернуть деньги после оплаты",
    "invoice_confirm" => "Досрочно запустить расчеты",
    "invoice_message" => "Дослать/изменить сообщение",
    "get_revert" => "Получить информацию о возврате по его идентификатору в PayQR",
);

$html = "<form method='post'><h1>Административные функции</h1>";
$html .= "<div class='row'><label>Выберите действие</label><select name='method'>";
foreach ($actions as $key=>$val)
{
    $html .= "<option value='$key'>$val</option>";
}
$html .= "</select></div>";
$html .= "<div class='row'><label>ID инвойса/реверта</label><input type='text' name='id'/></div>";
$html .= "<div class='row'><label>Сумма возврата</label><input type='text' name='amount'/></div>";
$html .= "<div class='row'><label>Текст сообщения</label><input type='text' name='message_text'/></div>";
$html .= "<div class='row'><label>URL картинки сообщения</label><input type='text' name='message_image_url'/></div>";
$html .= "<div class='row'><label>URL сообщения</label><input type='text' name='message_url'/></div>";
$html .= "<div class='row'><input type='submit'/></div>";
$html .= "</form>";
echo $html;

$method = isset($_POST["method"]) ? $_POST["method"] : "";

$id = isset($_POST["id"]) ? $_POST["id"] : "";
if(!empty($id))
{
    $Payqr_invoice = new PayqrInvoiceAction();
    $Payqr_revert = new PayqrRevertAction();
    $result = "";
    switch ($method)
    {
        case "get_invoice":
            $result = $Payqr_invoice->get_invoice($id);
            break;
        case "invoice_cancel":
            $result = $Payqr_invoice->invoice_cancel($id);
            break;
        case "invoice_revert":
            $result = $Payqr_invoice->invoice_revert($id, $amount);
            break;
        case "invoice_confirm":
            $result = $Payqr_invoice->invoice_confirm($id);
            break;
        case "invoice_message":
            $result = $Payqr_invoice->invoice_message($id, $_POST["message_text"], $_POST["message_image_url"], $_POST["message_url"]);
            break;
        case "get_revert":
            $result = $Payqr_revert->get_revert($revertId);
            break;
    }
    var_dump($result);
}



// Методы для работы с объектами "Счет на оплату"

$Payqr_invoice = new PayqrInvoiceAction();
$invoiceId = "usr_inv_cump9kCtvviaahomIj4mkP";


/**
 * Получить информацию о счете по его идентификатору в PayQR (актуализировать)
 * Подробнее https://payqr.ru/api/ecommerce#invoice_get
 * 
 * $result = $Payqr_invoice->get_invoice($invoiceId);
 */


/**
 * 1. Аннулировать счет на заказ (отображается только у «Счетов на оплату» со статусом new – это значит, что магазин уже обработал уведомление invoice.order.creating, но еще не получил уведомление о событии invoice.paid)
 * Отменить счет до оплаты (отказаться от оплаты) целиком
 * Подробнее https://payqr.ru/api/ecommerce#invoice_cancel
 * 
 * $result = $Payqr_invoice->invoice_cancel($invoiceId);
 */


/**
 * 2. Отменить и вернуть деньги (отображается только у «Счетов на оплату» со статусом paid или revertedPartially).
 * Отменить счет после оплаты (вернуть деньги) на определенную указанную сумму
 * Подробнее https://payqr.ru/api/ecommerce#invoice_revert
 * 
    $amount = 1;
    $result = $Payqr_invoice->invoice_revert($invoiceId, $amount);
 */


/**
 * 3. Досрочно запустить расчеты (отображается только у «Счетов на оплату» со статусами paid, revertedPartially или reverted, и если у них статус подтверждения none)
 * Досрочно подтвердить оплату по счету (запустить финансовые расчеты)
 * Подробнее https://payqr.ru/api/ecommerce#invoice_confirm
 * 
 * $result = $Payqr_invoice->invoice_confirm($invoiceId);
 */


/**
 * 4. Дослать/изменить сообщение (отображается только у «Счетов на оплату» со статусами paid, revertedPartially или reverted, и если с даты создания «Счета на оплату» из параметра created прошло не больше 259200 минут).
 * Дослать/изменить текстовое сообщение в счете
 * Подробнее https://payqr.ru/api/ecommerce#invoice_message
 *
 * Принимает 4 параметра (идентификатор счета и 3 необязательных), можно указать только необходимые для сообщения.
 * 
    $text = "Оплата покупок телефоном. №1 в России";
    $imageUrl = "https://payqr.ru/web/images/logo.png";
    $url = "https://payqr.ru";
    $result = $Payqr_invoice->invoice_message($invoiceId, $text, $imageUrl, $url);
 */




// Методы для работы с объектами "Возвраты"

$Payqr_revert = new PayqrRevertAction();
$revertId = "rvt_hz1jP7NzYyMpuPfypkKdMi";

/**
 * Получить информацию о возврате по его идентификатору в PayQR (актуализировать)
 * Подробнее https://payqr.ru/api/ecommerce#revert_get
 * 
 * $result = $Payqr_revert->get_revert($revertId);
 */

?>
<style>
    .row
    {
        margin: 10px 0;
    }
    .row input[type='text']
    {
        width: 300px;
    }
    label
    {
        display: block;
    }
</style>