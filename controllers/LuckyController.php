<?php

require_once "controllers/GlobalController.php";
require_once "models/User.php";
require_once "models/Link.php";
require_once "models/Lucky.php";

/**
 * Class LuckyController
 */
class LuckyController extends GlobalController
{
    private $hash;
    private $user;
    private $user_id;

    /**
     * LuckyController constructor.
     * @param string $hash
     */
    public function __construct($hash)
    {
        $this->hash = $hash;
        $this->user = new User();
        $this->user_id = !empty($_POST["user_id"]) ? $_POST["user_id"] : null;
    }

    /**
     * @return string
     */
    protected function getTitle()
    {
        return "Lucky Page";
    }

    /**
     * @return string|string[]
     */
    protected function getMiddle()
    {
        $arr["user_id"] = !empty($_GET["user"]) ? $_GET["user"] : null;
        $hash = $this->user->setLink($this->user_id);
        $arr["link"] = !empty($hash) ? $this->createLink($this->user_id, $hash) : $this->createLink($arr["user_id"], $this->hash);
        $arr["hash"] = !empty($this->hash) ? $this->hash : null;
        $result = $this->getLuckyResult($arr["user_id"]);
        $arr["number"] = !empty($result["number"]) ? $result["number"] : null;
        $arr["result"] = !empty($result["result"]) ? $result["result"] : null;
        $arr["sum"] = !empty($result["sum"]) ? $result["sum"] : null;
        $history = $this->getHistoryResult($arr["user_id"]);
        $arr["last"] = $history;
        return $this->getTemplate($arr, "lucky");
    }

    /**
     * @param $user_id
     * @return array
     */
    protected function getLuckyResult($user_id)
    {
        $lucky = new Lucky($user_id);
        return $lucky->luckyResult();
    }

    /**
     * @param $user_id
     * @return string
     */
    protected function getHistoryResult($user_id)
    {
        $lucky = new Lucky($user_id);
        $result = $lucky->historyResult();

        if (empty($result)) {
            return false;
        }

        $table = '';
        foreach ($result as $value) {
            $table .= "<tr>
                            <td>".$value["username"]."</td>
                            <td>".$value["random"]."</td>
                            <td>".$value["result"]."</td>
                            <td>".$value["sum"]."</td>
                       </tr>";
        }

        return $table;
    }
}