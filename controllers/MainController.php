<?php

require_once "controllers/HomeController.php";
require_once "controllers/LuckyController.php";
require_once "models/Link.php";

/**
 * Class MainController
 */
class MainController
{
    /**
     * @return string|string[]
     */
    public function getPage()
    {
        $hash = $_GET['hash'];

        if (empty($hash)) {
            $content = new HomeController();
            return $content->getContent();
        }

        $link = new Link($hash);

        if (!empty($_POST['hash'])) {
            $link->removeLink();
            $content = new HomeController();
            return $content->getContent();
        }

        $content = !empty($link->getLink()) ? new LuckyController($hash) : new HomeController();

        return $content->getContent();
    }
}