<?php

require "functions.php";

require("Model.php");
$m = Model::getModel();
$categories = $m->getCategories();

function check_data()
{

    if (isset($_POST["name"]) &&
    isset($_POST["category"]) &&
    isset($_POST["year"])) {
        $liste = ["year", "category", "name", "birthdate", "birthplace", "county", "motivation"];
        $infos = [];
        
        foreach ($liste as $cle) {
            if (!isset($_POST[$cle]) or trim($_POST[$cle]) === "") {
                $infos[$cle] = null;
            } else {
                $infos[$cle] = $_POST[$cle];
            }
        }
        if ($infos["birthdate"] !== (string)(int) $infos["birthdate"] or $infos["birthdate"] < 0) {
            $infos["birthdate"] = null;
        } else {
            $infos["birthdate"] = (int) $infos["birthdate"];
        }
        return $infos;
    } else {
        return false;
    }
}

$infos = check_data();
var_dump($infos);
    //$m->add_nobel_prize($infos);

?>