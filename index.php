<?php

/** Имя пользователя MySQL */
define('DB_USER', 'pr_foodrecept');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'TuigErT8');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');


mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysql_select_db(DB_USER);


$r = mysql_query('SELECT * FROM  `wp_posts` WHERE  `post_parent` =0 AND  `post_type` =  "attachment"');


while ($f = mysql_fetch_assoc($r)) {
    $e = explode('.', $f['post_title']);
    $ext = $e[count($e)-1];
    $name = str_replace('.'.$ext, '', $f['post_title']);
    unlink(dirname(__FILE__).'/wp-content/uploads/'.date('Y', strtotime($f['post_date'])).'/'.date('m', strtotime($f['post_date'])).'/'.$name.'.'.$ext);
    unlink(dirname(__FILE__).'/wp-content/uploads/'.date('Y', strtotime($f['post_date'])).'/'.date('m', strtotime($f['post_date'])).'/'.$name.'-100x100.'.$ext);
    unlink(dirname(__FILE__).'/wp-content/uploads/'.date('Y', strtotime($f['post_date'])).'/'.date('m', strtotime($f['post_date'])).'/'.$name.'-150x150.'.$ext);
    unlink(dirname(__FILE__).'/wp-content/uploads/'.date('Y', strtotime($f['post_date'])).'/'.date('m', strtotime($f['post_date'])).'/'.$name.'-300x225.'.$ext);
    unlink(dirname(__FILE__).'/wp-content/uploads/'.date('Y', strtotime($f['post_date'])).'/'.date('m', strtotime($f['post_date'])).'/'.$name.'-580x200.'.$ext);
    unlink(dirname(__FILE__).'/wp-content/uploads/'.date('Y', strtotime($f['post_date'])).'/'.date('m', strtotime($f['post_date'])).'/'.$name.'-580x320.'.$ext);
    mysql_query('DELETE FROM `wp_posts` WHERE `ID` = '.$f['ID']);
    echo "Removed: ".$f['post_title']."\n";
}


