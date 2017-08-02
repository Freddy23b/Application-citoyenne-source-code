<?php
try
{
    $db = new PDO('mysql:host=devzatafccdatabs.mysql.db;dbname=devzatafccdatabs;charset=utf8','devzatafccdatabs','Jemange1poir',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// paramètre pour activer les erreurs
}
catch(Exeption $e)
{
    die('Erreur : ' . $e->getMessage());
}
