# price-tracker

Реалізовано відстежувач змін цін для товарів на OLX.
Сервіс створює необхідні для роботи docker-контейнери, запускається за допомогою docker-compose та приймає запити до API у форматі JSON.

/api/subscribe - ендпоінт для підписки на оновлення товарів.
    <br>- email - пошта, на яку будуть надходити повідомлення про зміну ціни, а також повідомлення для верифікації поштової адреси;
    <br>- url - посилання на сторінку OLX з товаром.

При звертанні до API сервіс перевіряє, чи верифікована пошта та надсилає на неї посилання для верифікації у разі необхідності.

Всередині docker-контейнера price-tracker_php доступні для виконання наступні команди:
    <br>- php command.php init - запуск міграції для створення необхідних таблиць БД;
    <br>- php command.php revert - запуск міграції для видалення таблиць;
    <br>- php command.php check - ручний запуск сервісу, що перевіряє зміни цін для товарів, що є у БД.

Для простоти реалізації тестового проєкту конфігураційні дані винесено у config.php та docker-compose.yml

Також під час реалізації було досліджено роботу з запитами на сторінках OLX та реалізовано наступну схему роботи:
    <br>- під час підписки на оновлення цін товару сервіс парсить код сторінки та зберігає у БД ID товару з OLX
    <br>- кожен запланований за кроном, або ручний запуск буде звертатися до API OLX, а не до початкової сторінки

Таким чином, у випадку великої кількості товарів у БД масові звернення будуть спрямовані тільки до API OLX та не будуть навантажувати систему парсингом великої кількості HTML-коду.
