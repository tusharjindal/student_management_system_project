@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
               
                <div class="panel-body">
                <div style="left:100px; top:310px;">
                <form>
                <button type="submit" formaction="{{route('students.index')}}" class="btn btn-primary">View students</button>
                <button type="submit" formaction="{{route('teachers.index')}}" class="btn btn-secondary">view teachers</button>
                <button type="submit" formaction="{{route('courses.index')}}" class="btn btn-success">view courses</button>
                <button type="submit" formaction="{{route('students.create')}}" class="btn btn-danger">Add Student</button>
                <button type="submit" formaction="{{route('teachers.create')}}" class="btn btn-warning">Add Teacher</button>
                <button type="submit" formaction="{{route('courses.create')}}" class="btn btn-info">Add a course</button>
                <button type="submit" class="btn btn-light">Assign a course to teacher</button>
                <button type="submit" class="btn btn-dark">Dark</button>
                </form>
                </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
