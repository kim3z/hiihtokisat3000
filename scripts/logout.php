<?php
/*session_start();
session_unset('user');*/
session_start();
unset($_SESSION);
session_destroy();
header('Location: ../index.php');
