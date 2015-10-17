<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 16.10.15
 * Time: 20:15
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once 'db/db_connector.php';

$itemCount = $_POST['count'];
if ($itemCount) {
    for ($i = 0; $i < $itemCount; ++$i) {
        if ($_POST['lib_'.($i + 1)]) {
            $libs[$i] = $_POST['lib_'.($i + 1)];
            if (!get_magic_quotes_gpc()) {
                $libs[$i] = addslashes($libs[$i]);
            }
        }
    }
}

foreach ($libs as $v) {
    $query = "INSERT INTO libs SET name = '".$v."', count = '1' ON DUPLICATE KEY UPDATE name = '".$v."', count = count + 1";
    $result = $db->query($query);
    if (!$result) {
        echo 'Виникла помилка при додаванні даних в базу';
        $db->close;
        exit;
    }
}

$query = "SELECT * FROM libs ORDER BY count DESC LIMIT 5";
$result = $db->query($query);
$num_results = $result->num_rows;
$data = '';
for ($i = 0; $i < $num_results; ++$i) {
    $row = $result->fetch_assoc();
    $data .= "n".$i."=".stripslashes($row['name'])."&"."v".$i."=".stripslashes($row['count']);
    if (($i + 1) < $num_results) {
       $data .= "&";
    }
}

$db->close;

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);
$indexPage = $twig->loadTemplate('chart.html.twig');
echo $indexPage->render(array(
    'title' => 'TOP-5 використаних в домашній роботі бібліотек',
    'data' => $data
));