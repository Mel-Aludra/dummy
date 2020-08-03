<?php

//Appel des classes php
function loadClass($class_name) {

    $classes_paths = [

        //Chemin des fichiers.
        "Entity/" . $class_name . ".php",
        "Manager/" . $class_name . ".php",
        "App/" . $class_name . ".php",
        "Pages/Home/" .$class_name . ".php",
        "Pages/Error/" .$class_name . ".php",
        "Pages/" .$class_name . ".php"
    ];

    if(isset($_GET['page'])) {
        $classes_paths[] = "Pages/" . $_GET["page"] . "/" . $class_name . ".php";

        //Gestion des dépendances.
        switch($_GET["page"]) {
            case "Fight":
                $classes_paths[] = "Pages/Log/" . $class_name . ".php";
                break;
        }

    }

    //Pour chaque entrée dans le tableau de chemin, on recherche la class.
    foreach($classes_paths as $classes_path) {
        if(file_exists($classes_path)) {
            require_once $classes_path;
        }
    }
}

spl_autoload_register("loadClass");