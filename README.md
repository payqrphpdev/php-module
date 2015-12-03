##Библиотека для быстрой интеграции PayQR на интернет-сайты (PHP 5.x)
 * Версия библиотеки: 2.0
 * Помощь, вопросы и сообщения об ошибках: api@payqr.ru
 * Рекомендуемые сферы применения: интернет-магазины, онлайн-сервисы, браузерные игры
 * API PayQR и библиотека PayQR обладают большим количеством функций и возможностей, часть из которых нужна только небольшому количеству интернет-сайтов. Для ускорения и упрощения интеграции реализуйте у себя только то, что актуально для бизнес-логики конкретно вашего интернет-сайта, остальное игнорируйте и оставляйте "как есть" (оно по умолчанию работоспособно в библиотеке и уже корректно взаимодействует с API PayQR).


##Структура библиотеки:
```
|- example // примеры для ознакомления по принятию уведомлений от PayQR и направлению запросов в PayQR
    |- button.php // файл примера работы с конструктором кнопки PayQR
    |- sender.php // файл примера работы с запросами в PayQR
|- handlers // классы обработчиков уведомлений
    |- InvoiceHandler.php // класс обработки уведомлений объекта invoice
    |- OfferHandler.php // класс обработки уведомлений объекта offer
    |- PayqrOrder.php // дополнительный класс для работы с заказом (создать заказ, подтвердить заказ, получить пункты доставки/самовывоза)
    |- ReceiptHandler.php // класс обработки уведомлений объекта receipt
    |- RevertHandler.php // класс обработки уведомлений объекта revert
|- library // классы для работы библиотеки
    |- actions // классы для отправки запрсовов на сервер PayQR
        |- PayqrAction // базовый класс для отправки запросов
        |- PayqrInvoiceAction // класс для отправки запросов по инвойсам (возврат денег, отправка сообщений, подтверждение заказа и т.д.)
        |- PayqrRevertAction // класс для отправки запросов по возвратам (получение информации о возврате)
    |- button // классы для создания кнопки
        |- PayqrButton // базовый класс для создания кнопки программным путём
        |- PayqrButtonGenerator // класс для генерации кнопки (в основном для разработки модуля для цмс)
    |- events // классы для обработки уведомлений от сервера PayQR
        |- PayqrEvent // базовый класс для обработки уведомлений
        |- PayqrInvoice // класс для работы с уведомлений объекта invoice
        |- PayqrOffer.php // класс для работы с уведомлений объекта offer
        |- PayqrReceipt.php // класс для работы с уведомлений объекта receipt
        |- PayqrRevert.php // класс для работы с уведомлений объекта revert
    |- request // классы для отправки http запрсовов на сервер PayQR
        |- PayqrCurl // отправка http запрсовов методом curl
        |- PayqrRequest // базовый класс для отправки http запросов
        |- PayqrSocket // отправка http запрсовов через сокет (в случае если по каким-либо причинам в пхп отключён curl)
    |- PayqrAuth // класс для проверки, что запросы приходят именно от сервера PayQR
    |- PayqrAutoload // класс для автоподгрузки всех классов в библиотеке
    |- PayqrBase // базовый класс библиотеки
    |- PayqrExeption // класс для обработки исключений, случившихся во время работы библиотеки
    |- PayqrJsonValidator // класс для проверки валидности json строки, а также правильного конвертирования в json строку одинарных и двойных кавычек
    |- PayqrLog // класс для логирования работы библиотеки
    |- PayqrReceiver // класс для обработки уведомлений от сервера PayQR
|- logs // файл с логами библиотеки
    |- .htaccess // файл .htaccess для закрытия прямого доступа к файлу логов
    |- payqr.log // файл с логами
|- PayqrConfig.php // класс конфигурации, подключает все необходимые классы для работы
|- README.md // файл с описанием работы библиотеки
|- handler.php // основной файл, принимающий уведомления от PayQR (абсолютная ссылка на него указывается в личном кабинете PayQR в поле "URL для уведомлений")
|- log.php // пхп файл для просмотра логов по ключу
```


___
Для быстрой интеграции с PayQR достаточно:

1. Распаковать архив данной библиотеки PayQR на хостинг своего интернет-сайта (желательно в отдельную папку payqr)

2. Указать в личном кабинете PayQR в настройках своего "Магазина" в поле "URL для уведомлений" ссылку на файл handler.php из состава библиотеки PayQR

3. Внести номер магазина (merchId) и секретные ключи (SecretKeyIn и SecretKeyOut) из личного кабинета PayQR в файл PayqrConfig.php из состава библиотеки PayQR

Этого хватит для того, чтобы совершение покупки в PayQR осуществлялось покупателем без ошибок. Дальше останется только прописать реакцию магазин на те или иные уведомления в файлах папки handlers из состава библиотеки PayQR.

___
Чтобы вы смогли корректно учитывать данные о покупателях и покупках в учетной системе своего интернет-сайта, а также взаимодействовать с PayQR по обмену информацией, вам необходимо вставить свой код реализации логики обработки уведомлений от PayQR в классы в папке /handlers.
___
Также ваш интернет-сайт может самостоятельно посылать определенные запросы в PayQR. Для этого используйте классы из папки /library/actions
___
Пример простейшего подключения PayQR к учетной системе интернет-сайта, представлен в файле handler.php


###Документация
 * Базовая инструкция по интеграции "Быстрый старт": https://payqr.ru/api 
 * Справочник API PayQR: https://payqr.ru/api/ecommerce
 * Полная документация по API PayQR: https://payqr.ru/api/doc
 * Ответы на частые вопросы по интеграциям с PayQR: https://payqr.ru/api/faq
 * 
 * API PayQR использует архитектуру REST (http://wikipedia.org/wiki/Representational_state_transfer).
 * API PayQR поддерживает CORS (http://wikipedia.org/wiki/Cross-origin_resource_sharing) для безопасного взаимодействия с приложениями на клиентской стороне.
 * Данные в рамках API PayQR направляются в формате JSON (http://wikipedia.org/wiki/JSON).
 * Уведомления о событиях от PayQR поступают в интернет-сайт обычными http-/https-запросами (http://wikipedia.org/wiki/Webhook).
 * Обновления API PayQR всегда осуществляются с сохранением обратной совместимости.
 


##Версии библиотеки
___
####Изменения в версии 1.0.1:
- Добавлена функция payqr_base::getallheaders() для замены getallheaders(), которая недоступна в PHP ниже 5.4 при использовнии FastCGI. В более раниих версиях она была доступна только если PHP был установлен как модуль Apache. Подробнее http://php.net/manual/ru/function.getallheaders.php.
- Добавлена проверка используемой версии PHP. Данная библиотека предназначена для работы на PHP 5.x, для устаревшей версии PHP 4.x доступна специальная версия библиотеки PayQR, которую нужно скачивать отдельно с сайта PayQR.
- Добавлен класс payqr_no_curl.php. Теперь для отправки запросов в PayQR наличие cURL на сервере интернет-сайта необязательно, но PayQR все равно крайне рекомендует использовать именно cURL для осуществления запросов в PayQR. Если на вашем сервере отсутствует cURL, обратитесь к своему системному администратору или в службу поддержки хостинги для его активации, также вы можете установить cURL самостоятельно (подробнее http://php.net/manual/ru/curl.installation.php).

___
Изменения в версии 1.0.2:
- Улучшена система логирования. Теперь логи стали более информативными и подробными.
- Добавлено удаление пробелов при обработке значений переменных из файла конфигурации.

___
Изменения в версии 1.1:
- Добавлен класс payqr_button.php. Теперь коды кнопок PayQR генерировать и размещать на интернет-сайтах стало еще проще.
- В классы payqr_invoice.php и payqr_revert.php добавлен метод определения режима работы получаемых уведомлений от PayQR ("боевой" или "тестовый").

___
Изменения в версии 1.1.1:
- Обновлены классы payqr_json_validator.php и payqr_button.php.
___
Изменения в версии 2.0:
- Произведён полный редизайн библиотеки
- Переписаны все классы в соответсвии с увеличеним функционала работы сервиса PayQR




##Модуль для CMS.
Модуль представляет собой набор базовых методов присущих всем CMS. Сюда входит:
1)Создание табличек с настройками кнопки и заказами
2)Прослойка для работы с бд
3)Настройка кнопки 

###Структура файлов.
```
|- module // основная папка с файлами модуля
    |- auth // файлы для работы с авторизацией пользователя
        |- PayqrModuleAuth.php // класс для авторизации
        |- index.php // страничка с формой авторизации
    |- button // файлы для настройки кнопки
        |- PayqrButtonDefaultSettings.php // класс для установки дефолтных значений для некоторых настроек кнопки
        |- PayqrButtonGenerator.php // класс для генерации кнопки
        |- PayqrButtonPage.php // класс для генерации странички настройки кнопки
        |- button.settings.php // массив с настройками кнопки
        |- index.php // страничка с настройкой кнопки
    |- install // файлы для установки модуля и структуры бд
        |- PayqrModuleInstall.php // класс для установки модуля
        |- index.php // страничка с пошаговой установкой модуля
    |- orm // файлы для работы с бд
        |- PayqrModuleDb.php // класс для доступа к бд
        |- PayqrModuleDbConfig.php // класс с настройками доступа к бд
    |- PayqrModule.php // основной класс модуля
```

Перед установкой модуля

1. Задайте значения урла, где будет храниться папка payqr PayqrConfig::$baseUrl

2. Задайте значения файла логов payqr PayqrConfig::$logFile


Доступ к модулю. По умолчанию доступ будет осуществляться по юрлу /payqr/handler.php. Однако некоторые цмс могут закрыть доступ к файлам внутри проекта. 
Для открытия доступа необходимо создать файл .htaccess в папке payqr, и добавить туда следующий код:
RewriteCond %{REQUEST_URI} ^/payqr/
RewriteRule ^(.*)/$ payqr/$1 [L]

Точка входа. Для вызова функций цмс (создание заказа, получение способов доставки и т.д.) нужно подключить точку входа цмс внутри модуля. Для этого подключите точку входа в методе PayqrReceiver::__construct()