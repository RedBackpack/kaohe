<?php

/*
|--------------------------------------------------------------------------
| 路由
|--------------------------------------------------------------------------
*/

#测试
Route::get('/test', 'TestController@index');
Route::post('/test', ['as' => 'test_upload', 'uses' => 'TestController@post']);
Route::get('/users/export', 'TestController@export');
Route::get('users', 'TestController@users');

#主页
Route::get('/', 'WelcomeController@index');


//登录，登出, 自动跳转, 密码重置

Route::get('login', [
    'middleware' => 'guest', 'as' => 'login', 'uses' => 'loginController@loginGet']);
Route::post('login', [
    'middleware' => 'guest', 'uses' => 'loginController@loginPost']);
Route::get('logout', [
    'middleware' => 'auth', 'as' => 'logout', 'uses' => 'loginController@logout']);
Route::controller('password', 'PasswordController');

//学生的登录详情(包括资料修改， 信息查询)

Route::get('stu/home', [
    'as' => 'stu_home', 'uses' => 'Stu\StudentController@home']);
Route::get('stu/edit', [
    'as' => 'stu_edit', 'uses' => 'Stu\StudentController@edit']);
Route::post('stu/update', [
    'as' => 'stu_update', 'uses' => 'Stu\StudentController@update']);

//管理员入口(增删改查，上传 信息)

//查看
Route::get('admin/info', [
    'as' => 'info_list', 'uses' => 'Admin\infoController@index']);
//资源路由,学生的增删改查
Route::resource('admin', 'Admin\AdminController');
//上传 信息
Route::post('admin/upload_info', [
    'as' => 'upload_info', 'uses' => 'Admin\AdminController@upload_info']);
Route::any('/Notice','TeacherController@notice');

//下载学生名单
Route::get('download/stuList', [
    'as' => 'download_stu_list_excel', 'uses' => 'Admin\ExcelController@stuList']);
Route::get('download/info', [
    'as' => 'download_info_list_excel', 'uses' => 'Admin\ExcelController@info']);