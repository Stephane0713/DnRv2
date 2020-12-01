<?php

//Ce script n'a pas vocation à etre réutilisé

$host = "localhost";
$user = "root";
$password = "";
$dbName = "sth_games";

$dsn = 'mysql:host=' . $host . ';dbname=' . $dbName . ';charset=utf8';
try {
    $pdo = new PDO($dsn, $user, $password);
} catch (Exception $e) {
    die("Erreur:" . $e->getMessage());
}
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$platforms = $pdo->query('SELECT id, ref FROM platform')->fetchAll();

foreach ($platforms as $platform) {
    $pref = $platform['ref'];
    $games = $pdo->query('SELECT Title FROM videogames WHERE idPlatform =' . $platform['id'] . ' GROUP BY Title ORDER BY Title')->fetchAll();
    $mid = 1;

    foreach ($games as $game) {
        $copies = $pdo->query('SELECT id FROM videogames WHERE idPlatform =' . $platform['id'] . ' AND Title = "' . $game['Title'] . '"')->fetchAll();

        $suff = 'A';
        foreach ($copies as $copy) {
            $ref = $pref . str_pad($mid, 3, '0', STR_PAD_LEFT) . $suff;
            $pdo->query("INSERT INTO `references` VALUES (" . $copy['id'] . ", '" . $ref . "')");
            echo $ref . " " . $copy['id'] .  "<br>";
            $suff++;
        }
        $mid++;
    }
}
