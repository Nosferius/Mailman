<?php

require_once ('lib/model/addressBook.php');

$fetch = new addressBook;
$fetch->columnNames();
$fetch->fetchByID();

/*
    $addressBook = new addressBook();
    $addressBook->firstName = "hoi";
    $addressBook->lastName = "papa";
    $addressBook->eMail = "ik@hoi.nl";
    $addressBook->optOut = "0";
    print_r($addressBook->add());
    $error = new error();
*/
