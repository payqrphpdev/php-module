<?php
/**
 * Пример работы с конструктором кнопки PayQR
 */
require_once __DIR__ . '/../PayqrConfig.php'; // подключаем основной класс

$pqrCart = array(
    array(
        "article" => "1",
        "name" => "Test Product, quote ', double quote \"",
        "imageUrl" => "http://cdn3.mdomukr.smcloud.net/t/photos/0c/7b/49/7a12fa4b7b/utyg_tefal-aquaspeed.jpg",
        "amount" => "1",
        "quantity" => 1,
    )
);
$pqrAmount = 1;
$button = new PayqrButton($pqrAmount, $pqrCart); // создаем объект кнопки

// Изменение стиля кнопки PayQR
$button->setProperty(PayqrButton::COLOR_RED);
$button->setProperty(PayqrButton::FORM_OVAL);
$button->setProperty(PayqrButton::GRADIENT_FLAT);
$button->setProperty(PayqrButton::SHADOW_SHADOW);
$button->setProperty(PayqrButton::TEXTCASE_STANDARD);
$button->setProperty(PayqrButton::FONTWEIGHT_BOLD);
$button->setProperty(PayqrButton::FONTSIZE_MEDIUM);

//Ввод любых кастомных аттрибутов
$button->setAttr("customNumber", "123456");

// Размеры кнопки PayQR
$button->setHeight("80"); // изменяет высоту кнопки PayQR (px)
$button->setWidth("200"); // изменяет ширину кнопки PayQR (px)

// Установка запрашиваемых у пользователя полей
$button->setRequiredField(PayqrButton::REQUIRE_PHONE, PayqrButton::FIELD_REQUIRED);

$button->setOrderId("123123123"); // устанавливает номер заказа (orderId) для случаев, когда он уже известен на уровне генерации кода кнопки PayQR
$button->setUserData("analytics_id"); // устанавливает userdata (любые дополнительные служебные/аналитические данные в свободном формате)


?>
<html>
<head>
  <meta charset="utf-8">
  <?= PayqrButton::getJs(); ?>
</head>
<body>
  <?= $button->getHtmlButton(); ?>
    <div style="margin: 20px;">
        <a href="<?=PayqrConfig::getBaseUrl()?>/payqr/example/sender.php">Административные функции</a>
        <br/>
        <a href="<?=PayqrConfig::getBaseUrl()?>/payqr/log.php?key=<?=PayqrConfig::$logKey?>">Логи</a>
        <br/>
        <a>Url: <?=PayqrConfig::getBaseUrl()?>/payqr/handler.php</a>
    </div>
</body>
</html>