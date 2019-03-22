<div id="mySidebar" class="sidebar ">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" >×</a>
    


    @if(auth()->guard('admin')->check())
    
        <a href="{{url('admin/add_student')}}">Add Student </a>
        <a href="{{url('admin/add_teacher')}}">Add Teacher </a>
        
        <a href="{{url('admin/AllStudents/schools/1')}}">  All  Student</a>
        <a href="{{url('admin/AllTeachers/schools/1')}}">All Teacher </a>
        <a href="{{url('admin/AddAttendance/schools/1')}}">Add Attendance </a>
        <a href="{{url('admin/ViewAttendance/schools/1')}}">All Attendance </a>
        <a href="{{ url('admin/schedule/schools/1')}}">Schedule</a>
        <a href="{{url('/admin/materialfiles/schools/1')}}"> Material Files </a>


    @elseif(auth()->guard('teacher')->check())
        
        @if(auth()->guard('teacher')->user()->type == '1')
            <a href="#">Victoria College </a>
            <a href="#">Attendance </a>
            <a href="{{url('/teacher/AddAttendance/schools/1')}}">Add Attendance </a>
            <a href="{{url('/teacher/ViewAttendance/schools/1')}}">All Attendance </a>
            <a href="{{url('/teacher/scheduleclasse/schools/1')}}"> Schedule </a>
            <a href="{{url('/teacher/profile')}}">My Profile</a>


    	@else
    	    <!-- Normal Teacher -->
            <a href="#">Normal Teacher </a>
            <a href="{{url('/teacher/my/schedules')}}"> My Schedules </a>
            <a href="{{url('/teacher/profile')}}"> My Profile </a>
            <a href="{{url('/teacher/materialfiles/schools/1')}}"> Material Files </a>
            <a href="{{url('/teacher/homework/schools/1')}}"> HomeWork </a>
            <a href="{{url('/teacher/Result/schools/1')}}">Result</a>
    	@endif

    @endif 
</div>