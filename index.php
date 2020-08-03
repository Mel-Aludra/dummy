<?php

//A la création d'un objet qui n'a pas encore été require, l'auto loader le require de lui-même
require_once("App/AutoLoader.php");
$GLOBALS['app'] = new App();
$GLOBALS['app']->retrieveUserFromSession();
$GLOBALS['app']->launch();