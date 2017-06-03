<?php

$title = $_POST['title'];$content = $_POST['content'];

$sql = new PDO('mysql:host=localhost;dbname=Text','root','');
$input = $sql ->prepare("insert into content(title,content) value('$title','$content')");
$input ->execute();

$add = 'Location: notice';

if (($title && $content)) {header($add);}
