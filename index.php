<?php

require_once "controllers/MainController.php";

$student = new MainController();
echo $student->getPage();
