<?php
setcookie('login_flag', false, time()-3600, '/');
unset($_COOKIE['login_flag']);
header('Location: index.php');
exit;
