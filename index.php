<?php
//inclut les fichiers nécessaires à l'utilisation de mes classes
require_once "Pecheur.php";
require_once "Session.php";
//données nécessaires à la connection à ma bdd
$user="root";
$pass="";
$dbname="postetasession";
$host="localhost";
//connection à la bdd avecc pdo
$db=new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
var_dump($db);