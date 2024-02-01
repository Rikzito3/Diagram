<?php

namespace Ipeweb\Diagram\locale;

function setLanguage()
{
    if (isset($_GET['lang'])) {
        $lang = $_GET['lang'];
        if ($lang === 'pt' || $lang === 'en') {
            $_SESSION['lang'] = $lang;
        }
    }
    if (!isset($_SESSION['lang'])) {
        $_SESSION['lang'] = 'en';
    }
}
