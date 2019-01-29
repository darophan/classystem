@extends("layouts.app")

@section("styles")
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Term: #TRM{{$term->id}} {{$term->name}}</div>

                <div class="card-body">
                    <form onsubmit="return confirm('Do you really want to submit the form?');" action="{{route("assigning.assigningCourse")}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$term->id}}" name="term_id">
                        <div class="form-group row">
                          <label for="course_name" class="col-sm-2 col-form-label">Course/class<span class="text-danger">*</span></label>
                          <div class="col-sm-10">
                              <select class="course form-control" name="course_id">
                              </select>
                              @if($errors->has("course_id"))
                              <small class="text-danger">{{$errors->first("course_id")}}</small>
                              @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="schedule_id" class="col-sm-2 col-form-label">Schedule<span class="text-danger">*</span></label>
                          <div class="col-sm-10">
                              <select class="schedule form-control" name="schedule_id"></select>
                              @if($errors->has("schedule_id"))
                              <small class="text-danger">{{$errors->first("schedule_id")}}</small>
                              @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="instructor" class="col-sm-2 col-form-label">Instructor<span class="text-danger">*</span></label>
                          <div class="col-sm-10">
                              <select class="instructor form-control" name="instructor_id"></select>
                              @if($errors->has("instructor_id"))
                              <small class="text-danger">{{$errors->first("instructor_id")}}</small>
                              @endif
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Course/Class</th>
                                <th>Schedule</th>
                                <th>Instructor</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{$course->name}}</td>
                                    <td>{{$course->pivot->schedule->day}} ({{$course->pivot->schedule->time}})</td>
                                    <td>{{$course->pivot->instructor->name}}</td>
                                    <td>
                                        <a href="#" class="text-primary" title="Edit" data-toggle="modal" data-target="#modelId" data-toggle="tooltip" data-instructor_id="{{$course->pivot->instructor_id}}" data-schedule_id="{{$course->pivot->schedule_id}}" data-course="{{$course->name}}" data-schedule="{{$course->pivot->schedule->day}} {{'('.$course->pivot->schedule->time.')'}}" data-instructor="{{$course->pivot->instructor->name}}"><i class="fa fa-pencil"></i></a>
                                        <a href="#" onclick="event.preventDefault();
                                        confirm('Do you really want to delete this?') ?
                                            document.getElementById('form-{{$term->id}}-{{$course->id}}-{{$course->pivot->schedule_id}}-{{$course->pivot->instructor_id}}').submit() : console.log(0);" class="text-danger" title="Delete" data-toggle="tooltip">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form id="form-{{$term->id}}-{{$course->id}}-{{$course->pivot->schedule_id}}-{{$course->pivot->instructor_id}}" action="{{ route('assigning.delete') }}" method="POST" style="display: none;">
                                            {{csrf_field()}}
                                            <input type="hidden" value={{$term->id}} name="term_id">
                                            <input type="hidden" value={{$course->id}} name="course_id">
                                            <input type="hidden" value={{$course->pivot->schedule_id}} name="schedule_id">
                                            <input type="hidden" value={{$course->pivot->instructor_id}} name="instructor_id">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-center align-items-center">
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modelId"  role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form onsubmit="return confirm('Do you really want to submit the form?');" action="{{route('assigning.update')}}" method="post">
                <div class="modal-body">
                    {{csrf_field()}}
                    <input type="hidden" value="" id="old_instructor_id" name="old_instructor_id">
                    <input type="hidden" value="" id="old_schedule_id" name="old_schedule_id">
                    <div class="form-group ">
                    <label for="course_name" id="course" class=" col-form-label">Course/class</label> <span class="text-danger">* to</span>
                    <div class="">
                        <select class="course form-control" name="course_id">
                        </select>
                        @if($errors->has("course_id"))
                        <small class="text-danger">{{$errors->first("course_id")}}</small>
                        @endif
                    </div>
                    </div>
                    <div class="form-group ">
                    <label for="schedule_id" id="schedule" class=" col-form-label">Schedule </label><span class="text-danger">* to</span>
                    <div class="">
                        <select class="schedule form-control" name="schedule_id"></select>
                        @if($errors->has("schedule_id"))
                        <small class="text-danger">{{$errors->first("schedule_id")}}</small>
                        @endif
                    </div>
                    </div>
                    <div class="form-group ">
                    <label for="instructor" id="instructor" class=" col-form-label">Instructor </label><span class="text-danger">* to</span>
                    <div class="">
                        <select class="instructor form-control" name="instructor_id"></select>
                        @if($errors->has("instructor_id"))
                        <small class="text-danger">{{$errors->first("instructor_id")}}</small>
                        @endif
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });
    $('#modelId').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var course = button.data('course'); // Extract info from data-* attributes
        var schedule = button.data('schedule');
        var instructor = button.data('instructor');
        var instructor_id = button.data("instructor_id");
        var schedule_id = button.data("schedule_id");

        var modal = $(this);
        modal.find("#old_instructor_id").val(instructor_id);
        modal.find("#old_schedule_id").val(schedule_id);
        modal.find('#course').text(course);
        modal.find('#schedule').text(schedule);
        modal.find('#instructor').text(instructor);

    });
    $('.course').select2({
      placeholder: 'Select a course/class',
      ajax: {
        url: '/admin/select2-autocomplete-ajax-course',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
                  return {
                      text: item.name,
                      id: item.id
                  }
              })
          };
        },
        cache: true
      }
    });
    $('.schedule').select2({
      placeholder: 'Select a schedule',
      ajax: {
        url: '/admin/select2-autocomplete-ajax-schedule',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
                  return {
                      text: item.day + " (" + item.time + ")",
                      id: item.id
                  }
              })
          };
        },
        cache: true
      }
    });
    $('.instructor').select2({
      placeholder: 'Select a instructor',
      ajax: {
        url: '/admin/select2-autocomplete-ajax-instructor',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
                  return {
                      text: item.name,
                      id: item.id
                  }
              })
          };
        },
        cache: true
      }
    });
</script>
@endsection