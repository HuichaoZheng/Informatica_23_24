<?php
session_save_path("../sessions");
session_start();
session_unset();
header('Location:login.php');