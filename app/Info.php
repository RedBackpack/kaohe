<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model {



    public $fields = [
        'name' => '',
        'id' => '',
        'student_sex' => '',
        'student_class' =>'',
        'student_major_id' =>'',
        'student_major_name' =>'',
        'student_college' =>'',
        'student_grade' =>'',
        'student_status' =>'',

    ];

    protected static function rules(){
        return [
            'math' => 'digits_between:0,2',
            'english' => 'digits_between:0,2',
            'c' => 'digits_between:01,2',
            'sport' => 'digits_between:1,2',
            'think' => 'digits_between:1,2',
            'soft' => 'digits_between:1,2',
            ];
    }

}
