<?php
    require_once '/app/vendor/autoload.php';
    $loader = new \Twig\Loader\FilesystemLoader('/app/web/templates');
    $twig = new \Twig\Environment($loader);

    require_once '/app/inc/config.php';
    require_once '/app/inc/functions.php'; 

    $twig->addGlobal('backend', BACKEND);

    $version = @file_get_contents('/app/VERSION');
    $twig->addGlobal('version', $version !== false ? trim($version) : 'dev');

    session_start();

    $script_name = basename($_SERVER['PHP_SELF']);
?>