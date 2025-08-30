<?php

    require_once 'init.php';
    if(LoggedIn()) {

        echo $twig->render('index.html.twig', [
            'userData' => isset($_SESSION['userData']) ? $_SESSION['userData'] : [],
            'players' => GetPlayers(),
            'genres' => GetGenres(),
            'modes' => GetModes()
        ]);
    } else {
        header("Location: /login.php");
    }
?>