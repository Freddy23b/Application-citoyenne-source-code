<?php
try
{
    $db = new PDO('mysql:host=localhost;dbname=devzata;charset=utf8','root','',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// paramètre pour activer les erreurs
}
catch(Exeption $e)
{
    die('Erreur : ' . $e->getMessage());
}
