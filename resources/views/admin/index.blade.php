
<!doctype html>
<html lang="en">
  <head>
    <style>
      .table-success{
          margin-top: 100px;
          /* width: 100px;
          margin-left: 20pc;} */}
          .boxbox{
            width: 850px;
            margin-left: 340px;
          }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Admin List</title>

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
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" style="color:white;" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
  </head>
  <body style=" background-color: aliceblue;">
  <div class="boxbox" style="text-align:center">
  <table class="table table-success table-striped">
      <thead>  
      <tr>
        <th colspan="11" >ADMIN LIST</th>
    <tr class="table-success">  
    <td>  
    ID </td>  
    <td>  
    Name </td>  
    <td>  
    Email </td>  
    <td>  
    Contact number </td>  
    <td>  
    Address </td>  
    <td>  
    Delete </td> 
    <td>  
    Edit </td> 
    </tr>  
    </thead> 
  
    <tbody>  
    @foreach($admins as $admin)  
        <tr border="none">  
            <td>{{$admin->adminid}}</td>  
            <td>{{$admin->name}}</td>  
            <td>{{$admin->email}}</td>  
            <td>{{$admin->number}}</td>  
            <td>{{$admin->Address}}</td> 
            
<td >  
<form action="{{ route('admins.destroy', $admin->adminid)}}" method="post">  
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<input name="_method" type="hidden" value="DELETE">
                  <!-- @method('DELETE')   -->
                  <button class="btn btn-danger" type="submit">Delete</button>  
                </form>  
</td>  
<td >  
<form action="{{ route('admins.edit', $admin->adminid)}}" method="GET">  
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                   
                  <button class="btn btn-danger" type="submit">Edit</button>  
                </form>  
</td>  
  
         </tr>  
@endforeach    
</tbody>  
</table>
        </div>
{{$admins->links('pagination::bootstrap-4')}}

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