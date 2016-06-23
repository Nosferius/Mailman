<?php

// Errors to browser
error_reporting(E_ALL);
ini_set('display_errors', 'on');
// Load libraries
require_once('lib/model/addressBook.php');
require_once('lib/controller/controller.php');
require_once('lib/controller/postHandler.php');
$postHandler = new postHandler();
$postHandler->run();
$Controller = new controller();
$action     = "";
// If there's an action tell the controller
if(isset($_GET["action"])){
    $action = $_GET["action"];
}
$Controller->setAction($action);
echo $Controller->run();

/*
$fetch = new addressBook;
$fetch->columnNames();
$fetch->fetchByID();
*/

/*
    $addressBook = new addressBook();
    $addressBook->firstName = "hoi";
    $addressBook->lastName = "papa";
    $addressBook->eMail = "ik@hoi.nl";
    $addressBook->optOut = "0";
    print_r($addressBook->add());
    $error = new error();
*/
