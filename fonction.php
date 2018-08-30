<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
/*function isAllowed($perm)
{
    return isset($_SESSION['droits']) && array_key_exists($perm, $_SESSION['droits']);
}*/

function isLogged()
{
    return isset($_SESSION['connect']);
}
