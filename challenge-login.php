<?php
    require_once('user-session.php');

    UserSession::initSessionFromChallenge($_POST['favorite_movie']);

    header("Location:home.php");
?>