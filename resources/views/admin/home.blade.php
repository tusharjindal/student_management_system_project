
<!doctype html>
<html lang="en">
  <head>
    <style>
      .table-success{
          margin-top: 100px;
          /* width: 100px;
          margin-left: 20pc;} */}
.card {
    
  margin-top:20px;
  margin-right:0px;
  margin-left:370px;
  float: left;
  width: 25%;
  padding: 10px 10px;
  
}
}
.navbar{
  
}
.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}
/* Remove extra left and right margins, due to padding in columns */
.cards {
    margin: 0 -5px;
   
    
}

/* Clear floats after the columns */
.cards:after {
  content: "";
  display: table;
  clear: both;
}
/* *{
    list-style: none;
    text-decoration: none;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Open Sans', sans-serif;
}

body{
    background: #f5f6fa;
} */

.wrapper .sidebar{
    background: black;
    position: fixed;
    top: 100;
    margin-right:170px;
    left: 0;
    width: 250px;
    height: 100%;
    padding: 20px 0;
    transition: all 0.5s ease;
}
.wrapper .sidebar .profile{
    margin-bottom: 30px;
    text-align: center;
}

.wrapper .sidebar .profile img{
    display: block;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 0 auto;
}

.wrapper .sidebar .profile h3{
    color: #ffffff;
    margin: 10px 0 5px;
}

.wrapper .sidebar .profile p{
    color: rgb(206, 240, 253);
    font-size: 14px;
}
.wrapper .sidebar ul li a{
    display: block;
    padding: 13px 30px;
    /* border-bottom: 1px solid #10558d; */
    color: rgb(241, 237, 237);
    font-size: 16px;
    position: relative;
    
}

.wrapper .sidebar ul li a .icon{
    color: #dee4ec;
    width: 30px;
    display: inline-block;
    
}
.wrapper .sidebar ul li a.active{
    color: #0c7db1;

    background:white;
    border-right: 2px solid rgb(5, 68, 104);
}

.wrapper .sidebar ul li a:hover .icon,
.wrapper .sidebar ul li a.active .icon{
    color: #0c7db1;
}

.wrapper .sidebar ul li a:hover:before,
.wrapper .sidebar ul li a.active:before{
    display: block;
}
ul.ba {
    list-style-type: none;
}

    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>home page</title>

    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" style="color:white;" href="{{ url('/newhome') }}">Student Management Project</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" style="color:white;" aria-current="page" href="{{ url('/newhome') }}">Home</a>
        </li>
        </ul>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" style="color:white;" href="{{ route('logout') }}" onclick="event.preventDefault(); 
          document.getElementById('logout-form').submit();">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
        </li>
        
      </ul>
    
    </div>
  </div>
</nav>
<div class="wrapper">
        <!--Top menu -->
        
        <div class="sidebar">
           <!--profile image & text-->
           <div class="profile">
                <img src="uploads/admin.png" alt="profile_picture">
                <h3>{{$name}}</h3>
                <p>Admin</p>
            </div>
            <!--menu item-->
            <ul style="list-style-type: none;">
                <li>
                    <a href="{{ url('/newhome') }}" class="active" style="text-decoration:none">
                        <span class="item">Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/showprofile')}}" style="text-decoration:none">
                        <span class="item">View Profile</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="#" style="text-decoration:none">
                        <span class="item">People</span>
                        
                    </a>
                </li> -->
                <!-- <li>
                    <a href="#" style="text-decoration:none">
                        <span class="item">Perfomance</span>
                    </a>
                </li>
                <li>
                    <a href="#" style="text-decoration:none">
                        <span class="item">Development</span>
                    </a>
                </li>
                <li>
                    <a href="#" style="text-decoration:none">
                        <span class="item">Reports</span>
                    </a>
                </li>
                <li>
                    <a href="#" style="text-decoration:none">
                        <span class="item">Admin</span>
                    </a>
                </li> -->
                <li>
                    <a href="{{url('/changePassword')}}" style="text-decoration:none">
                        <span class="item">Change Password</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
  </head>
  <body style=" background-color: aliceblue;">
  <div class="cards">
  <div class="card" style="width: 18rem;">
  <img src='uploads/student.jpg' width="150" height="250" margin='auto' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Student</h5>
    <p class="card-text">Perform required operations on student</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><a style="text-decoration:none" href="{{route('students.create')}}" class="card-link">Add a student</a></li>
    <li class="list-group-item"><a style="text-decoration:none" href="{{route('students.index')}}" class="card-link">View all students</a></li>
    
  </ul>
 
</div>
<div class="card" style="width: 18rem;">
  <img src='uploads/course.png' width="150" height="250" margin='auto' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Course</h5>
    <p class="card-text">Perform required operations on course</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><a style="text-decoration:none" href="{{route('courses.create')}}" class="card-link">Add a course</a></li>
    <li class="list-group-item"><a style="text-decoration:none" href="{{route('courses.index')}}" class="card-link">View all courses</a></li>
    
  </ul>
 
</div>
<div class="card" style="width: 18rem;">
  <img src='uploads/teacher.png' width="150" height="250" margin='auto' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Teacher</h5>
    <p class="card-text">Perform required operations on teacher</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><a style="text-decoration:none" href="{{route('teachers.create')}}" class="card-link">Add a teacher</a></li>
    <li class="list-group-item"><a style="text-decoration:none" href="{{route('teachers.index')}}" class="card-link">View all teachers</a></li>
    
  </ul>
  </div>
<div class="card" style="width: 18rem;">
  <img src='uploads/admin.png' width="150" height="250" margin='auto' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Admin</h5>
    <p class="card-text">Perform required operations on admin</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><a style="text-decoration:none" href="{{route('admins.create')}}" class="card-link">Add a admin</a></li>
    <li class="list-group-item"><a style="text-decoration:none" href="{{route('admins.index')}}" class="card-link">View all admins</a></li>
    
  </ul>

        </div>

  <!-- <div class="card" style="width: 10rem;">
  <img src= 'uploads/student.jpg' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">view all Students</h5>
    <p class="card-text">View deatils of all students</p>
    <a href="{{route('students.index')}}" class="btn btn-primary">Click here</a>
  </div>
</div>
<div class="card" style="width: 10rem;">
  <img src= 'uploads/student.jpg' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Add Student</h5>
    <p class="card-text">Add a new student to the university</p>
    <a href="{{route('students.create')}}" class="btn btn-primary">Click here</a>
  </div>
</div>
<div class="card" style="width: 10rem;">
  <img src= 'uploads/teacher.png' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Add Teacher</h5>
    <p class="card-text">Add a new teacher to the university</p>
    <a href="{{route('teachers.create')}}" class="btn btn-primary">Click here</a>
  </div>
</div>
<div class="card" style="width: 10rem;">
  <img src= 'uploads/teacher.png' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">View all teachers</h5>
    <p class="card-text">View deatils of all teachers</p>
    <a href="{{route('teachers.index')}}" class="btn btn-primary">Click here</a>
  </div>
</div>
<div class="card" style="width: 10rem;">
  <img src= 'uploads/course.png' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Add a course</h5>
    <p class="card-text">Add a new course to the university</p>
    <a href="{{route('courses.create')}}" class="btn btn-primary">Click here</a>
  </div>
</div>
<div class="card" style="width: 10rem;">
  <img src= 'uploads/course.png' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">View all courses</h5>
    <p class="card-text">View deatils of all courses</p>
    <a href="{{route('courses.index')}}" class="btn btn-primary">Click here</a>
  </div>
</div>
<div class="card" style="width: 10rem;">
  <img src= 'uploads/admin.png' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Add a admin</h5>
    <p class="card-text">Add a new admin to the university</p>
    <a href="{{route('admins.create')}}" class="btn btn-primary">Click here</a>
  </div>
</div>
<div class="card" style="width: 10rem;">
  <img src= 'uploads/admin.png' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">View all admins</h5>
    <p class="card-text">View deatils of all admins</p>
    <a href="{{route('admins.index')}}" class="btn btn-primary">Click here</a>
  </div>
</div> -->

        </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>