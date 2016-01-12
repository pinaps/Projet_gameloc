<?php
session_start();

require(__DIR__.'/config/db.php');
require(__DIR__.'/include/functions.php');

checkLoggedIn();
checkAdmin();
?>