@extends("layouts.app")

@section("styles")
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{route("schedule.index")}}">Create new schedule</a></div>

                <div class="card-body">
                    <form onsubmit="return confirm('Do you really want to submit the form?');" action="@if(isset($edit_schedule)){{route('schedule.update',['id' => $edit_schedule->id])}}@else{{route('schedule.store')}}@endif" method="post">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="day" class="col-sm-3 col-form-label">Day<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                            <input type="text" name="day" id="day" class="form-control" placeholder="Mon/Wed" value="@if(isset($edit_schedule)){{$edit_schedule->day}}@endif{{old("day")}}">
                                <small class="text-muted">Ex. Mon/Wed</small>
                                @if($errors->has("day"))
                                <small class="text-danger">{{$errors->first("day")}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time" class="col-sm-3 col-form-label">Time<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                            <input type="text" name="time" id="time" class="form-control" placeholder="8:00-9:30" value="@if(isset($edit_schedule)){{$edit_schedule->time}}@endif{{old("time")}}">
                                <small class="text-muted">Ex. 17:30-19:00</small>
                                @if($errors->has("time"))
                                <small class="text-danger">{{$errors->first("time")}}</small>
                                @endif
                            </div>
                        </div>
                        @if(isset($edit_schedule))<button type="submit" class="btn btn-primary">Update</button>@endif
                        <button type="submit" class="btn btn-primary @if(isset($edit_schedule)){{"d-none"}}@endif">Create</button>
                    </form>
                    <br>
                    <table class="table table-striped table-inverse ">
                        <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $schedule)
                                <tr>
                                    <td scope="row">SDU{{$schedule->id}}</td>
                                    <td>{{$schedule->day}}</td>
                                    <td>{{$schedule->time}}</td>
                                    <td>
                                        <a href="{{route("schedule.edit", ['id'=> $schedule->id, 'edit' => 1, 'page' => request()->page])}}" class="text-primary" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                        <a href="{{route("schedule.delete",['id'=> $schedule->id, 'delete' => 1])}}" onclick="return confirm('Do you really want to delete it?');" class="text-danger" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                    <div class="row justify-content-center align-items-center">
                        {{ $schedules->links() }}
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