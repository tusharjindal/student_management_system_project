<!doctype html>
<html lang="en">
  <head>

  <style>
      .form_stud{
        width: 50pc;
    margin: auto;
    border: solid;
    padding: 15px;
    border-width: thin;
    margin-top: 20px;
    box-shadow: 0 8px 16px rgba(0,0,0,.3);
      }
  </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>create student</title>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" style="color:white;" href="{{ url('/newhome') }}">Student Management System</a>
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
      <div class="form_stud">
  <form method="post" action="{{url('students')}}">
      <h3>Add a student</h3>
  
  <div class="form-group">
                            <div class="form-group">
                                <label>Roll Number</label>
                                <input name="Studentid" type="text" class="form-control"  placeholder="Enter unique Roll Number">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input name="name" type="text" class="form-control"  placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="text" class="form-control"  placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input name="number" type="text" class="form-control"  placeholder="Enter number">
                            </div>
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input name="Birth" type="date" class="form-control"  placeholder="Enter dob">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input name="Address" type="text" class="form-control"  placeholder="Enter Address">
                            </div>
                            <div class="form-group">
                                <label>Course</label>
                                <input name="Course" type="text" class="form-control"  placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label>Grades</label>
                                <input name="Grades" type="text" class="form-control"  placeholder="Enter grades">
                            </div>
                            <div class="form-group">
                                <label>Mentor</label>
                                <input name="Mentor" type="text" class="form-control"  placeholder="Enter mentor Assigned to student"><br/> 
                            </div>
                            <div>
                            <input type="submit" class="btn btn-info" value="Submit">
                            <input type="reset" class="btn btn-warning" value="Reset">
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
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