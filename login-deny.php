<?php
    require_once 'user-session.php';
    require_once 'html-template.php';

    UserSession::endSession();
    HtmlTemplate::redictToLogin('Login deny...');
?>