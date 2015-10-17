<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 17.10.15
 * Time: 5:45
 */

$host = 'localhost';
$database = 'hw2';
$user = 'user';
$password = '12345678';
@ $db = new mysqli($host, $user, $password, $database);
if (mysqli_connect_errno()) {
    echo 'Помилка. Не вдалося встановити з\'єднання з базою даних ' .
        'Спробуйте пізніше';
    exit;
}