<?php

/**
 * Class GlobalController
 */
abstract class GlobalController
{
    /**
     * @return string|string[]
     */
    public function getContent()
    {
        $arr["title"] = $this->getTitle();
        $arr["content"] = $this->getMiddle();
        return $this->getTemplate($arr, "main");
    }

    /**
     * @return mixed
     */
    abstract protected function getTitle();

    /**
     * @return mixed
     */
    abstract protected function getMiddle();

    /**
     * @param $arr
     * @param $name_tpl
     * @return string|string[]
     */
    protected function getTemplate($arr, $name_tpl)
    {
        $text = file_get_contents("views/" . $name_tpl . ".tpl");
        $search = array();
        $replace = array();
        $i=0;
        foreach($arr as $key => $value){
            $search[$i] = "%$key%";
            $replace[$i] = $value;
            $i++;
        }
        return str_replace($search, $replace, $text);
    }

    /**
     * @param int $user_id
     * @param string $hash
     * @return string
     */
    public function createLink($user_id, $hash)
    {
        $path = substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],"/"));
        /** @var string $link */
        $link = "<a href='http://" . $_SERVER['HTTP_HOST'] . $path . "?user=" . $user_id . "&hash=" . $hash . "'>
                    http://".$_SERVER['HTTP_HOST'].$path."/get_file.php?user=" . $user_id . "&hash=" . $hash .
            "</a>";
        return $link;
    }
}