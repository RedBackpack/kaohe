@extends('master')

@section('title')
    学生成绩列表
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h3 align="center">学生信息</h3>
                <table class="table table-striped" id="sortTable">
                    <thead>
                        <tr>
                            <th class="col-md-2">学号 <a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>姓名 <a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>学号<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>姓名<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>性别<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>班级 <a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>专业号 <a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>专业名<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>学院<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>年级<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>在校状态<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                        </tr>
                    </thead>

                    @foreach ($users as $user)
                        <tr class="myInfo">
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->info->student_sex}}</td>
                            <td>{{$user->info->student_class}}</td>
                            <td>{{$user->info->student_major_id}}</td>
                            <td>{{$user->info->student_major_name}}</td>
                            <td>{{$user->info->student_college}}</td>
                            <td>{{$user->info->student_grade}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            @include('Admin.right_bar')

        </div>
    </div>
@stop