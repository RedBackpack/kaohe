<button type="button" class="btn btn-warning"
    data-container="body" data-toggle="popover" data-placement="bottom"
    title="{{ Auth::user()->name }}--信息"
    data-content="
        ************** 姓名 -- {{ $info->name }} **************
        ************** 性别 -- {{ $info->student_sex }} **************
        ************ 班级 -- {{ $info->student_class }} **************
        ************** 专业号 -- {{ $info->student_major_id }} **************
        ************** 专业名 -- {{ $info->student_major_name }} **************
        ************** 学院 -- {{ $info->student_college }} **************
        ************** 年级 -- {{ $info->student_info }} **************
        ************** 在校状态 -- {{ $info->student_status }} **************
    ">
    点击,查看信息<td>{{ $user->id }}</td>
   
</button>