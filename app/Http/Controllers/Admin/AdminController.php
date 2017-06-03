<?php namespace App\Http\Controllers\Admin;

use DB;
use App\Grade;
use Redirect;
use Hash;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller {

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $result = User::where('is_admin', 0);
        $count = $result->count();
        $users = $result->paginate(10);
        return view('Admin.index', compact('users', 'count'));
    }

    public function create(){
        $result = User::where('is_admin', 0);
        $count = $result->count();
        return view('Admin.create', compact('count'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|digits:10|unique:users',
            ]);
        $user = new User;
        $user->id = $request->id;
        $user->name = $request->name;
        $user->password = Hash::make($user->id);
        $user->save();
        session()->flash('message', $user->name."同学添加成功");
        $grade = new Grade;
	    $grade->user_id = $request->id;
	    $grade->save();
        return Redirect::to('admin');
    }

    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();
        session()->flash('message', $name."同学已经被移除");
        return Redirect::back();
    }

    public function upload_grade(Request $request)
    {
        $this->validate($request, Grade::rules());
        $grade = Grade::where('user_id', $request->user_id)->first();
        $grade->student_sex = $request->student_sex;
        $grade->student_class = $request->student_class;
        $grade->student_major_id = $request->student_major_id;
        $grade->sudent_major_name = $request->student_major_name;
        $grade->student_college = $request->student_college;
        $grade->student_grade = $request->student_grade;
        $grade->student_status = $request->student_status;
        $grade->save();
        session()->flash('message', '信息提交成功');
        return Redirect::back();
    }

}
