@extends("layouts.app")

@section("styles")
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{route("instructor.index")}}">Create new instructor</a></div>

                <div class="card-body">
                    <form onsubmit="return confirm('Do you really want to submit the form?');" action="@if(isset($edit_instructor)){{route("instructor.update", ['id'=>$edit_instructor->id])}}@else{{route("instructor.store")}}@endif" method="post">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Instructor Name<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" value="@if(isset($edit_instructor)){{$edit_instructor->name}}@endif{{old("name")}}">
                                <small class="text-muted">Ex. Phan Daro</small>
                                @if($errors->has("name"))
                                <small class="text-danger">{{$errors->first("name")}}</small>
                                @endif
                            </div>
                        </div>
                        @if(isset($edit_instructor))<button type="submit" class="btn btn-primary">Update</button>@endif
                        <button type="submit" class="btn btn-primary @if(isset($edit_instructor)){{"d-none"}}@endif">Create</button>
                    </form>
                    <br>
                    <table class="table table-striped table-inverse ">
                        <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Instructor Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($instructors as $instructor)
                                <tr>
                                    <td scope="row">ITR{{$instructor->id}}</td>
                                    <td>{{$instructor->name}}</td>
                                    <td>
                                        <a href="{{route("instructor.edit", ['id'=> $instructor->id, 'edit' => 1, 'page' => request()->page])}}" class="text-primary" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                        <a href="{{route("instructor.delete",['id'=> $instructor->id, 'delete' => 1])}}" onclick="return confirm('Do you really want to delete it?');" class="text-danger" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                    <div class="row justify-content-center align-items-center">
                        {{ $instructors->links() }}
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