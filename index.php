<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 16.10.15
 * Time: 18:50
 */
require_once __DIR__ . '/vendor/autoload.php';

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);
$indexPage = $twig->loadTemplate('index.html.twig');
echo $indexPage->render(array(
    'title' => 'Домашня робота №2',
    'description' => 'Заповніть приведену нижче форму для отримання статистики по найбільш
       уживаних під час виконання домашньої роботи бібліотеках',
    'itemCount' => 5,
    'itemName' => 'Бібліотека №',
    'itemValue' => 'lib_',
    'actionScript' => 'action.php'
));