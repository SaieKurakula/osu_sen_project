<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';

$loader = new Twig_Loader_Array(array(
    'index' => 'Hello {{ name }}!',
));
$twig = new Twig_Environment($loader);

echo $twig->render('index', array('name' => 'Fabien'));



echo(__DIR__);




$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS,DB_NAME)
    or die("Error connecting to database server");

mysqli_select_db($link, DB_NAME)
    or die("Error selecting database: DB_NAME");

echo 'Successfully connected to database!';

mysql_close($link);

echo ("Hello!");


// phpinfo();


// Template files
// $loader = new Twig_Loader_Filesystem('/path/to/templates');
// $twig = new Twig_Environment($loader, array(
    // 'cache' => '/path/to/compilation_cache',
// ));

// echo $twig->render('index.html', array('name' => 'Fabien'));