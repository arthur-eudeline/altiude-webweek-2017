<?php

    $GLOBALS["site_title"] = "Alti'ude";
    $GLOBALS["directory"] = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];


    //ADMIN
    $GLOBALS["admin_directory"] = $GLOBALS["directory"]."/admin";


    //BDD
    try{
        $DB = new PDO('mysql:host=localhost;dbname=webweek2', 'root', '');
        $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo 'La base de donnée n\'est malheureusement pas disponnible pour le moment. Réessayez plus tard.';
    }

?>