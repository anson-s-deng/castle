<?php
    require_once('user-session.php');
    UserSession::endSession();
    header("Location:index.php");
?>