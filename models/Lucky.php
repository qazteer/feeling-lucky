<?php

require_once "config/config.php";
require_once "db/database.php";

/**
 * Class Lucky
 */
class Lucky
{
    private $config;
    private $mysqli;
    private $user_id;

    /**
     * Lucky constructor.
     * @param $user_id
     */
    public function __construct($user_id)
    {
        $this->config = new Config();
        $this->mysqli = DataBase::getDB()->getMysqli();
        $this->user_id = $user_id;
    }

    /**
     * @return array|bool
     */
    public function luckyResult()
    {
        if (empty($_POST['lucky'])) {
            return false;
        }

        $result = [];
        $result["number"] = rand(1, 1000);
        $result["result"] = ($result["number"] % 2) ? "Lose" : "Win";
        $result["sum"] = ($result["number"] % 2) ? 0 : $this->helperCalculate($result["number"]);
        $created_dt = date("Y-m-d H:i:s");

        $query = "INSERT INTO `im_feeling_lucky` (`user_id`, `random`, `result`, `sum`, `created_dt`) 
                    VALUES (" .
            $this->user_id . ", " . $result["number"] . ", '" . $result["result"] . "', " . $result["sum"] . ", '".$created_dt."')";

        if(empty($this->mysqli->query($query))) {
            return false;
        }

        return $result;
    }

    /**
     * @return array|bool
     */
    public function historyResult()
    {
        if (empty($_POST['history'])) {
            return false;
        }

        $query = "SELECT u.username, fl.random, fl.result, fl.sum FROM `im_feeling_lucky` AS fl 
                    LEFT JOIN `users` AS u ON u.id = fl.user_id WHERE fl.user_id = " . $this->user_id . " ORDER BY fl.id DESC LIMIT 3";
        $result = $this->mysqli->query($query);

        if(!$result) {
            return false;
        }

        $data = [];
        $i=0;
        while($row=$result->fetch_assoc()){
            $data[$i] = $row;
            $i++;
        }

        return $data;
    }

    /**
     * @param $number
     * @return float|int
     */
    private function helperCalculate($number)
    {
        switch ($number) {
            case ($number > 900):
                $sum = $this->getPercentage($number, 70);
                break;
            case ($number > 600):
                $sum = $this->getPercentage($number, 50);
                break;
            case ($number > 300):
                $sum = $this->getPercentage($number, 30);
                break;
            case ($number < 300):
                $sum = $this->getPercentage($number, 10);
                break;
            default: $sum = 0;
        }

        return $sum;
    }

    /**
     * @param int $number
     * @param int $percentage
     * @return float|int
     */
    private function getPercentage($number, $percentage)
    {
        return ($percentage / 100) * $number;
    }
}