<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StudentMesRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */

	public function rules()
    {
        return [
            'name'=>'required|unique:admin_permissions|max:255',
            'id'=>'required|min:10|max:10',
            'student_sex' => 'require|max:1',
            'student_class' =>'require|max:255',
            'student_major_id' =>'required|max:255',
            'student_major_name' =>'required|max:255',
            'student_college' =>'required|max:255',
            'student_grade' =>'required|max:255',
            'student_status' =>'required|max:255',

        ];
    }

}
