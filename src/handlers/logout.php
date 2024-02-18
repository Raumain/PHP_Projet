<?php

session_start();
setcookie('user', '', time() - 3600, '/');
unset($_SESSION['cart']);

header('Location: /');
