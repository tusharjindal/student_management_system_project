

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
  padding: 10px;
  background-color: beige;
  margin-top: 30px;
}

.title {
  color: grey;
  font-size: 18px;
}

/* button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
} */



button:hover, a:hover {
  opacity: 0.7;
}
h3{
  border: solid;
  color: white;
  background-color: #000;
  border-color:#000;
  padding:15px;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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
</head>
<body style=" background-color: aliceblue;">



<div class="card" style=" background-color:  beige;">
<h3 style="text-align:center">User Profile</h3>
  <img src="uploads/student.jpg"  alt="#" style="width:60%; margin: auto;  border-radius: 50%;" >
  <h4>{{$user->name}}</h4>
  <p class="title">Student</p>
  <p>XYZ University</p>
  <div style="margin: 10px 0;">
  <h5>Email: {{$user->email}}</h5>
  <h5>Id: {{$user->id}}</h5>
  <h5>Number: {{$students->number}}</h5>
  <h5>Address: {{$students->Address}}</h5>
  <h5>Date of birth: {{$students->Birth}}</h5>
  <h5>Mentor assigned: {{$students->Mentor}}</h5>
  <h5>Grade: {{$students->Grades}}</h5>

  </div>
</div>

</body>
</html>
