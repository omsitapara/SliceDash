<?php
session_start();
unset($_SESSION['IS_LOGIN']);
include '../function.inc.php' ;
redirect('login.php');
