<?php

require __DIR__ . "/../constants/constants.php";
if (!isset($_COOKIE[USER_ID_COOKIE_KEY])) {
    header('Location: /login.php', true);
}

unset($_COOKIE[USER_ID_COOKIE_KEY]); 
setcookie(USER_ID_COOKIE_KEY, '', -1, '/');

unset($_COOKIE[USER_BIODATA_ID_COOKIE_KEY]); 
setcookie(USER_BIODATA_ID_COOKIE_KEY, '', -1, '/');

unset($_COOKIE[USER_BERKAS_ID_COOKIE_KEY]); 
setcookie(USER_BERKAS_ID_COOKIE_KEY, '', -1, '/');

header('Location: /login.php', true);