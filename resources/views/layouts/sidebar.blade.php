<div id="mySidebar" class="sidebar ">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" >×</a>
    


     @if(auth()->guard('admin')->check())
    
    <a href="{{url('admin/add_student')}}">Add Student </a>
    <a href="{{url('admin/add_teacher')}}">Add Teacher </a>
    <a href="{{url('admin/student/schools/1')}}">  All  Student</a>
    <a href="{{url('admin/teacher/schools/1')}}">All Teacher </a>
     @endif 
</div>