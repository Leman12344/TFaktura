<?php
session_start();
session_regenerate_id();
unset($_SESSION);
session_destroy();
?>