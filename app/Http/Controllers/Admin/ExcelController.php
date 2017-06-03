<?php namespace App\Http\Controllers\Admin;

use App\Grade;
use App\User;
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ExcelController extends Controller {

    /**
     * 得到学生名单，下载excel文档
     */
    public function stuList()
    {
        $results = $this->getUsersDatas();

        Excel::create('学生课表', function($excel) use($results) {

            $excel->sheet('sheetName', function($sheet) use($results) {

                    $sheet->fromArray($results, null, 'A1', false, false);

                    $sheet->prependRow(1, array(
                        '周一', '周二', '周三', '周四', '周五', '周六','周日'
                    ));
                    $sheet->setWidth([
                        '一二' => 30,
                        '三四' => 30,
                        '五六' => 30,
                        '七八' => 30,
                        '九十' => 30,
                        '十一十二' => 30,
                        ]);
                    $sheet->getDefaultStyle();

            });

        })->export('xls');
    }

    /**
     * @return 学生信息数组
     */
    public function getUsersDatas()
    {
        return User::where('is_admin', 0)
                    ->select('周一', '周二', '周三', '周四', '周五', '周六')
                    ->get()
                    ->toArray();
    }

    /**
     * 得到信息表
     */
    public function grade()
    {
        $infos = $this->getGradeDatas();

        Excel::create('学生信息表', function($excel) use($infos) {

            $excel->sheet('sheetName', function($sheet) use($infos) {

                $sheet->fromArray($infos, null, 'A1', false, false);

                $sheet->prependRow(1, array(
                    'id', 'name', 'student_sex', 'student_class', 'student_major_id', 'student_major_name', 'student_college', 'student_grade',
'student_status' ));

                $sheet->setWidth([
                    'A' => 10,
                    'B' => 10,
                    'C' => 10,
                    'D' => 10,
                    'E' => 10,
                    'F' => 10,
                    'G' => 10,
                    'H' => 10,
                    'I' => 10,
                    ]);

            });
        })->export('xls');

    }

    /**
     * 获取学生信息数组
     */
    public function getGradeDatas()
    {
        $infors = Grade::select('id', 'name', 'student_sex', 'student_class', 'student_major_id', 'student_major_name', 'student_college', 'student_grade',
            'student_status'  )->get()->toArray();

        foreach ($infors as $key => $value) {
            $infors[$key]['id'] = User::findOrFail($value['user_id'])->name;
        }

        return $infors;

    }

}
