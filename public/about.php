<?php
include_once '../src/utils/autoloader.php';

$data = [
    'founder' => 'ENSIIE'
];
include_once '../src/View/template.php';
loadView('about', $data);
