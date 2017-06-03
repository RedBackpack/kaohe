<?php
 namespace App\Http\Controllers\Admin;
 use Auth;
 use Redirect;
 use App\User;
 use App\Http\Requests\StudentMesRequest;
 use App\Http\Controllers\Controller;
 use App\Http\Controllers\Admin\ExcelController;

 class SpiderController extends ExcelController
 {
     protected $guard = 'students';
     public $kebiao_url = "http://jwzx.cqupt.congm.in/jwzxtmp/kebiao/kb_stu.php?xh=";
     public $student_info = "http://jwzx.cqupt.edu.cn/jwzxtmp/showBjStu.php?bj=";

     public function stu_info(Request $request)
     {

         $id = $request->get('id');

         $data = $this->stu->getStuInfo($id);

         if ($data) {
             echo '已查询';
         } else {
             $url = "http://jwzx.cqupt.edu.cn/jwzxtmp/showBjStu.php?bj=";
             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $url . $id);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
             curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
             $result = curl_exec($ch);
             curl_close($ch);
             $this->matchinfo($result);

         }

     }

     //匹配学生信息

     public function matchinfo($result)
     {
         $pattern = "/<td[^>]*>([^<>]*)<\/td>/";
         preg_match_all($pattern, $result, $matches_result);
         $this->length = count($matches_result[1]);
         $number = ($this->length / 10) - 1;//学生数量
         echo $number;

         for ($i = 1; $i <= $number; $i++) {

             $m = $i * 10;

             $info['id'] = $matches_result[1][$m + 1];
             $info['student_name'] = $matches_result[1][$m + 2];
             $info['student_sex'] = $matches_result[1][$m + 3];
             $info['student_class'] = $matches_result[1][$m + 4];
             $info['student_major_id'] = $matches_result[1][$m + 5];
             $info['student_major_name'] = $matches_result[1][$m + 6];
             $info['student_college'] = $matches_result[1][$m + 7];
             $info['student_grade'] = $matches_result[1][$m + 8];
             $info['student_status'] = $matches_result[1][$m + 9];
             $this->fileds->saveClassInfo($info);
             return json_decode($result, true);
         }
     }

     public function getCourse($request)
     {
         $id = $request->get('id');

         $data = $this->stu->getStuInfo($id);

         if ($data) {
             echo '已查询';
         } else {
             $url = "http://jwzx.cqupt.congm.in/jwzxtmp/kebiao/kb_stu.php?xh=";
             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $url . $id);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
             curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
             $result = curl_exec($ch);
             curl_close($ch);
             $this->matchCourse($result);
         }
     }

     //匹配课表
     public function matchCourse($result)
     {

         $pattern = "/<td>([\s\S]*?)<\/td>/"; //匹配课程
         preg_match_all($pattern, $result, $match_result);

         $list_arr = array_slice($match_result[1], 12);
         //return count($list_arr);
         for ($j = 0; $j < count($list_arr) / 12; $j++) {
             $m = $j * 12;
             $stu_list[$j]['stuNum'] = $list_arr[$m + 1];
             $stu_list[$j]['name'] = $list_arr[$m + 2];
             $stu_list[$j]['gender'] = $list_arr[$m + 3];
             $stu_list[$j]['class'] = $list_arr[$m + 4];
             $stu_list[$j]['major'] = $list_arr[$m + 5];
             $stu_list[$j]['majorName'] = $list_arr[$m + 6];
             $stu_list[$j]['academy'] = $list_arr[$m + 7];
             $stu_list[$j]['grade'] = $list_arr[$m + 8];
             $stu_list[$j]['type'] = $list_arr[$m + 9];
             $this->stu->saveCrouseInfo($stu_list);
             return json_decode($result, true);
             echo $result;
         }
     }
 }