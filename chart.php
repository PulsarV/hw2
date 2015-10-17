<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 17.10.15
 * Time: 0:07
 */

require __DIR__.'/vendor/autoload.php';

use CpChart\Services\pChartFactory;

for ($i = 0; $i < 5; ++$i) {
    $libValues[$i] = $_GET['v'.$i];
    $libNames[$i] = $_GET['n'.$i]." (".$libValues[$i].")";
}

$factory = new pChartFactory();
$myData = $factory->newData();
$myData->addPoints($libValues, "ScoreA");
$myData->setSerieDescription("ScoreA", "Application A");

/* Define the absissa serie */
$myData->addPoints($libNames, "Labels");
$myData->setAbscissa("Labels");

/* Create the pChart object */
$myPicture = $factory->newImage(500, 500, $myData);

/* Draw a solid background */
$settings = array("R"=>153, "G" => 153, "B" => 153, "Dash" => 1, "DashR" => 153, "DashG" => 153,
    "DashB" => 153);
$myPicture->drawFilledRectangle(0, 0, 500, 500, $settings);

/* Add a border to the picture */
$myPicture->drawRectangle(0, 0, 499, 499, array("R" => 0, "G" => 0, "B" => 0));

/* Set the default font properties */
$myPicture->setFontProperties(array("FontName" => "fonts/UbuntuRegular.ttf", "FontSize" => 16,
    "R" => 80, "G" => 80, "B" => 80));

/* Create the pPie object */
$pieChart = $factory->newChart("pie", $myPicture, $myData);

/* Define the slice color */
$pieChart->setSliceColor(0, array("R" => 255, "G" => 147, "B" => 79));
$pieChart->setSliceColor(1, array("R" => 128, "G" => 255, "B" => 128));
$pieChart->setSliceColor(2, array("R" => 255, "G" => 0, "B" => 255));
$pieChart->setSliceColor(3, array("R" => 255, "G" => 255, "B" => 0));
$pieChart->setSliceColor(4, array("R" => 0, "G" => 255, "B" => 255));

/* Enable shadow computing */
$myPicture->setShadow(TRUE, array("X" => 3, "Y" => 3, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 10));

/* Draw a splitted pie chart */
$pieChart->draw3DPie(250, 200, array("Radius" => 230, "DataGapAngle" => 5, "DataGapRadius" => 10,
    "Border" => TRUE));

/* Write down the legend next to the 2nd chart*/
$pieChart->drawPieLegend(50, 370);

$myPicture->stroke();
