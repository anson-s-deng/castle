<?php
    require_once 'user-session.php';
    require_once 'html-template.php';

    UserSession::initSession(null, null);
    $userContext = UserSession::getUserContext();

    HtmlTemplate::displayHtmlHeader();
    HtmlTemplate::displayWelcome($userContext);
    HtmlTemplate::displayHtmlFooter();

?>