<?php

session_start();

const BASE_PATH = __DIR__ . "/../src/";

require BASE_PATH . "utils.php";
require base_path("Classes/Database.php");
require base_path("Classes/Validator.php");
require base_path("router.php");
