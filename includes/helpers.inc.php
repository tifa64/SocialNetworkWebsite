<?php
/**
 * Created by PhpStorm.
 * User: abdullah
 * Date: 19/10/17
 * Time: 12:07 ص
 */
function html($text){
    return htmlspecialchars($text,ENT_QUOTES,'utf-8');
}
function htmlout($text){
    echo html($text);
}