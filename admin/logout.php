<?php
session_start();
require_once 'Model.php';
require_once '../util.inc.php';

$_SESSION = array();

header('Location: login.php');

exit;
?>