<?php
/**
 * Created by PhpStorm.
 * User: Anis Zarrouk
 * Date: 12/11/2018
 * Time: 20:21
 * @param $num
 * @param $str
 * @return mixed
 */
function cutString($num , $str){
    if(strlen($str)>$num){
        $result = str_replace(substr($str,$num), "...",$str);
    }

return $result;
}