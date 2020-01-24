<?php

require_once "config/config.php";
require_once "db/database.php";

/**
 * Class User
 */
class User
{
    private $config;
    private $mysqli;
    private $username = null;
    private $phone = null;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->config = new Config();
        $this->mysqli = DataBase::getDB()->getMysqli();
        $this->username = !empty($_POST["username"]) ? $_POST["username"] : null;
        $this->phone = !empty($_POST["phone"]) ? $_POST["phone"] : null;
    }

    /**
     * @return array|bool|null
     */
    private function getUser()
    {
        $query = "SELECT u.id, u.username, u.phone, l.link, l.created_dt FROM `users` AS u 
                    LEFT JOIN `links` AS l ON u.id = l.user_id WHERE u.username = '".$this->username."' ORDER BY l.created_dt DESC";
        $result = $this->mysqli->query($query);
        if(!$result) return false;

        return $result->fetch_assoc();
    }

    /**
     * @return bool|string
     */
    private function setUser()
    {
        $created_dt = date("Y-m-d H:i:s");
        $query = "INSERT INTO `users` (`username`, `phone`, `created_dt`) 
                    VALUES ('" . $this->username . "', '" . $this->phone . "', '" . $created_dt . "')";

        if(empty($this->mysqli->query($query))) {
            return false;
        }

        $last_user_id = $this->mysqli->insert_id;

        $hash = $this->setLink($last_user_id, $created_dt);

        return $hash;
    }

    /**
     * @param int $last_user_id
     * @param null|string $created_dt
     * @return bool|string
     */
    public function setLink($last_user_id, $created_dt = null)
    {
        $created_dt = empty($created_dt) ? date("Y-m-d H:i:s") : $created_dt;
        $hash = md5(microtime());

        $query = "INSERT INTO `links` (`user_id`, `link`, `created_dt`) 
                    VALUES ('" . $last_user_id . "', '" . $hash . "', '" . $created_dt . "')";

        return !empty($this->mysqli->query($query)) ? $hash : false;
    }

    /**
     * @return array|bool|null
     */
    public function registerUser()
    {
        if (empty($this->username) || empty($this->phone)) {
            return false;
        }

        $user = $this->getUser();

        if (empty($user)) {
            return !empty($this->setUser()) ? $this->getUser() : false;
        }

        if (strtotime($user["created_dt"]) < strtotime("-7 day")) {
            $user["link"] = $this->setLink($user["id"]);
        }

        return $user;
    }
}
