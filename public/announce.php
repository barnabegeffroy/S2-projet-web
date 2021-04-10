<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';
$data = $announceRepository->getDataById($_POST('id'));
loadView('announce/announce', $data);
