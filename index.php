<?php
require_once '/nfs/stak/students/k/kurakuls/public_html/seniorproject/vendor/autoload.php';

$loader = new Twig_Loader_Array(array(
    'index' => 'Hello {{ name }}!',
));
$twig = new Twig_Environment($loader);

echo $twig->render('index', array('name' => 'Fabien'));



echo(__DIR__);

phpinfo();


// Template files
// $loader = new Twig_Loader_Filesystem('/path/to/templates');
// $twig = new Twig_Environment($loader, array(
    // 'cache' => '/path/to/compilation_cache',
// ));

// echo $twig->render('index.html', array('name' => 'Fabien'));