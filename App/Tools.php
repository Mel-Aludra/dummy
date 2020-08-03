<?php
trait Tools
{

    public function getIdOrNull($entity)
    {
        if(is_object($entity) && method_exists($entity, "getId")) {
            return $entity->getId();
        }
        return null;
    }

    public static function getCurrentPagePath()
    {
        return "Pages/" . $GLOBALS["app"]->currentPage . "/";
    }

    public static function getAbsolutePath()
    {
        if($_SERVER["SERVER_NAME"] === "localhost")
            return "http://localhost/MorbolDummyChallenge/";
        else
            return "http://www.morbol.fr/MorbolDummyChallenge/";
    }

}