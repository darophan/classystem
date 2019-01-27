@extends("layouts.app")

@section("styles")
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset("css/bootstrap-datepicker3.min.css")}}">
@endsection
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{route("term.index")}}">Create new term</a></div>

                <div class="card-body">
                    <form onsubmit="return confirm('Do you really want to submit the form?');" action="@if(isset($edit_term)){{route("term.update", ['id' => $edit_term->id])}} @else {{route("term.store")}} @endif" method="post">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Term name<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Term name" value="@if(isset($edit_term)){{$edit_term->name}}@endif{{old("name")}}">
                                <small class="text-muted">Ex. Term Nov-Apr-2019</small>
                                @if($errors->has("name"))
                                <small class="text-danger">{{$errors->first("name")}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <lable for="start_date" class="col-sm-2 col-form-label">Start Date<span class="text-danger">*</span></lable>
                            <div class="col-sm-10">
                            <input type="text" name="start_date" id="start_date" class="date_picker form-control" value="@if(isset($edit_term)){{$edit_term->start_date}}@endif{{old("start_date")}}">
                                <small  class=" text-muted">Ex. 2019-02-09</small> <small class="text-danger errors"></small>
                                @if($errors->has("start_date"))
                                <small class="text-danger">{{$errors->first("start_date")}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <lable for="end_date" class="col-sm-2 col-form-label">End Date<span class="text-danger">*</span></lable>
                            <div class="col-sm-10">
                            <input type="text" name="end_date" id="end_date" class="date_picker form-control" value="@if(isset($edit_term)){{$edit_term->end_date}}@endif{{old("end_date")}}">
                                <small class=" text-muted">Ex. 2019-02-09</small> <small class="text-danger errors"></small>
                                @if($errors->has("end_date"))
                                <small class="text-danger">{{$errors->first("end_date")}}</small>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary @if(isset($edit_term)){{'d-none'}}@endif">Create</button>
                        @if(isset($edit_term)) <button type="submit" class="btn btn-primary">Update</button>@endif
                    </form>
                    <br>
                    <table class="table table-striped table-inverse ">
                        <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Term Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($terms as $term)
                                <tr>
                                    <td scope="row">TRM{{$term->id}}</td>
                                    <td>{{$term->name}}</td>
                                    <td>{{$term->start_date}}</td>
                                    <td>{{$term->end_date}}</td>
                                    <td>
                                        <a href="{{route("term.edit", ['id'=> $term->id, 'edit' => 1])}}" class="text-primary" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                        <a href="{{route("term.delete",['id'=> $term->id, 'delete' => 1])}}" onclick="return confirm('Do you really want to delete it?');" class="text-danger" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                    <div class="row justify-content-center align-items-center">
                        {{ $terms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section("scripts")
<script src="{{asset("js/bootstrap-datepicker.min.js")}}"></script>
<script>
    $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });

    // $('.date_picker').datepicker({
    //     format: 'yyyy/mm/dd'
    // });
    $('.date_picker').each(function (){
        $(this).datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: "linked"
        });
    });
    var sDate,eDate;
    $("#start_date").datepicker().on('changeDate',function(e){
        sDate = new Date($(this).datepicker('getUTCDate'));
        checkDate();
    });

    $("#end_date").datepicker().on('changeDate',function(date){
        eDate = new Date($(this).datepicker('getUTCDate'));
        checkDate();
    });

    function checkDate()
    {
        if(sDate && eDate && (eDate<sDate))
        {
            $('.errors').text("End date should be greater than start date!");
        }
        else
        {
            $('.errors').text("");
        }
    }
</script>
@endsection