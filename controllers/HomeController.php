<?php

require_once "controllers/GlobalController.php";
require_once "models/User.php";

/**
 * Class HomeController
 */
class HomeController extends GlobalController
{
    private $user;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * @return mixed|string
     */
    protected function getTitle()
    {
        return "Home Page";
    }

    /**
     * @return mixed|string|string[]
     */
    protected function getMiddle()
    {
        $user = $this->user->registerUser();
        $arr["username"] = !empty($user["username"]) ? $user["username"] : "";
        $arr["phone"] = !empty($user["phone"]) ? $user["phone"] : "";
        $arr["link"] = !empty($user["link"]) ? $this->createLink($user["id"], $user["link"]) : "";
        return $this->getTemplate($arr, "home");
    }

}