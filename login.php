<?php
    require_once('user-session.php');

    UserSession::initSession($_POST['username'], $_POST['password']);

    header("Location:home.php");
?>