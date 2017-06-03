@extends('master')

@section('title')
    管理员
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">

                @include('errors.list')

                <h3 align="center">学生信息表</h3>
                <table class="table table-hover">
                    <tr>
                        <td>学号</td>
                        <td>姓名</td>
                        <td>性别</td>
                        <td>班级</td>
                        <td>专业号</td>
                        <td>专业名</td>
                        <td>学院</td>
                        <td>年级</td>
                        <td>在校状态</td>
                    </tr>
                    @if (count($users))
                        @foreach ($users as $user)
                            <tr>//'id', 'name', 'student_sex', 'student_class', 'student_major_id', 'student_major_name', 'student_college', 'student_grade',
                                'student_status'
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->student_sex }}</td>
                                <td>{{ $user->student_class }}</td>
                                <td>{{ $user->student_major_id }}</td>
                                <td>{{ $user->student_major_name }}</td>
                                <td>{{ $user->student_college }}</td>
                                <td>{{ $user->student_grade }}</td>
                                <td>{{ $user->student_status }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModal{{$user->id}}">更新分数</button>
                                    <form action="{{ url('admin/'.$user->id) }}" style='display: inline' method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('确定删除?')">删除</button>
                                    </form>
                                </td>
                            </tr>

                            @include('Admin.upload_grade')

                        @endforeach
                    @else
                        <h1>没有学生名单,请管理员添加</h1>
                    @endif
                </table>
                <?php echo $users->render(); ?>
            </div>
            @include('Admin.right_bar')
        </div>

    </div>
@stop