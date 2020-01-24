<?php

require_once "config/config.php";
require_once "db/database.php";

/**
 * Class Link
 */
class Link
{
    private $config;
    private $mysqli;
    private $hash = null;

    /**
     * User constructor.
     * @param string $hash
     */
    public function __construct($hash)
    {
        $this->config = new Config();
        $this->mysqli = DataBase::getDB()->getMysqli();
        $this->hash = $hash;
    }

    /**
     * @return array|bool|null
     */
    public function getLink()
    {
        $query = "SELECT `link`, `created_dt` FROM `links` WHERE `link` = '" . $this->hash . "'";//print_r($query);exit;
        $result = $this->mysqli->query($query);//print_r($result->fetch_assoc());exit;

        if (empty($result)) {
            return false;
        }

        $link = $result->fetch_assoc();

        return (strtotime($link["created_dt"]) < strtotime("-7 day")) ? false : $link["link"];
    }

    /**
     * @param $link
     * @return bool|mysqli_result
     */
    public function removeLink()
    {
        $query = "DELETE FROM `links` where `link` = '".$this->hash."'";
        return $this->mysqli->query($query);
    }
}
