<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require get_language_file();

function get_language_file() {
    $_SESSION['lang'] = $_SESSION['lang'] ?? 'en_US'; // default language is English if not set yet.
    $_SESSION['lang'] = $_SESSION['lang'] ?? 'am_ET';
    $_SESSION['lang'] = $_SESSION['lang'] ?? 'or_ET';
    $_SESSION['lang'] = $_GET['lang']  ?? $_SESSION['lang'];  // If a new language is provided, save it to the session
    
    return "".$_SESSION['lang'].".php";
}



function __($str) {
    global $lang;
    if (!empty($lang[$str])) {
        return $lang[$str];
    } else {
        // return $str;
        die("Error: Translation for \"$str\" does not exist.");
    }
}
?>

