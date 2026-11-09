<?php 
session_start();

if(!isset($_SESSION['login'])){
header('location:index.php');
exit;
}else if($_SESSION['login']!=true){
header('location:index.php');
exit;
}
?>