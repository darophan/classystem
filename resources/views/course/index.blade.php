@extends("layouts.app")

@section("styles")
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{route("course.index")}}">Create new course/class</a></div>

                <div class="card-body">
                    <form onsubmit="return confirm('Do you really want to submit the form?');" action="@if(isset($edit_course)){{route("course.update", ['id'=>$edit_course->id])}}@else{{route("course.store")}}@endif" method="post">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Course/Class Name<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Introduction to Law" value="@if(isset($edit_course)){{$edit_course->name}}@endif{{old("name")}}">
                                <small class="text-muted">Ex. Introduction to Law</small>
                                @if($errors->has("name"))
                                <small class="text-danger">{{$errors->first("name")}}</small>
                                @endif
                            </div>
                        </div>
                        @if(isset($edit_course))<button type="submit" class="btn btn-primary">Update</button>@endif
                        <button type="submit" class="btn btn-primary @if(isset($edit_course)){{"d-none"}}@endif">Create</button>
                    </form>
                    <br>
                    <table class="table table-striped table-inverse ">
                        <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Course/Class Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                <tr>
                                    <td scope="row">CUS{{$course->id}}</td>
                                    <td>{{$course->name}}</td>
                                    <td>
                                        <a href="{{route("course.edit", ['id'=> $course->id, 'edit' => 1])}}" class="text-primary" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                        <a href="{{route("course.delete",['id'=> $course->id, 'delete' => 1])}}" onclick="return confirm('Do you really want to delete it?');" class="text-danger" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                    <div class="row justify-content-center align-items-center">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section("scripts")
<script>
    $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });

</script>
@endsection