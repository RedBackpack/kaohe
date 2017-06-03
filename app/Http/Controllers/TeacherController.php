<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class teacher extends Controller{
    public function view(){
        echo  '<form action="/laravel52/public/notice.php" method="POST" id="input">
        <p>发布公告:</p>
        <input type="text" name="title" placeholder="输入标题"><br>
        <textarea name="content" form="input" placeholder="输入内容"
        style="width:450px;height:130px"></textarea>
        <input type="submit" value="发布">
        </form>';
    }

    //公告
    public function notice() {

        $add = DB::select('select max(id) from content');
        $info = get_object_vars($add[0]);

        for ($i=0;$i<10;$i++) {
            $num = $info['max(id)']-$i;
            $info1 = DB::table('content')->where('id', '=', $num)->value('title');
            $info2 = DB::table('content')->where('id', '=', $num)->value('content');
            echo $info1;
            echo '<br>';
            echo $info2;
            echo '<hr>';
        }
}
}