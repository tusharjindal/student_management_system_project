
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
  margin-right:10px;
  margin-left:10px;
  float: left;
  width: 25%;
  padding: 10px 10px;
  
}

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


    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title></title>

    <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
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
  </head>
  <body>
      
  <div class="cards">
  <div class="card" style="width: 10rem;">
  <img src= 'uploads/student.jpg' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">view all Students</h5>
    <p class="card-text">View deatils of all students</p>
    <a href="{{route('students.index')}}" class="btn btn-primary bg-dark">Click here</a>
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
    <h5 class="card-title">View all teachers</h5>
    <p class="card-text">View deatils of all teachers</p>
    <a href="{{route('teachers.index')}}" class="btn btn-primary">Click here</a>
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