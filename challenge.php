<?php

require_once 'html-template.php';

session_start();

HtmlTemplate::displayHtmlHeader();
if(isset($_SESSION['user_challenge']))
{   
    HtmlTemplate::displayLoginChallengeForm($_SESSION['user_challenge']);
}
HtmlTemplate::displayHtmlFooter();

?>