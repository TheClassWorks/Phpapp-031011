<?php
define("dns", "mysql:host=localhost;dbname=phpgfall;charset=utf8mb4");
define("username", "root");
define("password", "");
$connection = new PDO(dns, username, password);
