@extends("layouts.app")

@section("styles")
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    #calendar {
        width: 100%;
      display: grid;
      grid-template-columns: repeat(8, 1fr);
    }

    #calendar tr, #calendar tbody {
      grid-column: 1 / -1;
      display: grid;
      grid-template-columns: repeat(8, 1fr);
     width: 100%;
    }

    caption {
        text-align: center;
      grid-column: 1 / -1;
      font-size: 130%;
      font-weight: bold;
      padding: 10px 0;
    }

    #calendar a {
        color: #8e352e;
        text-decoration: none;
    }

    #calendar td, #calendar th {
        padding: 5px;
        box-sizing:border-box;
        border: 1px solid #ccc;
    }

    #calendar .weekdays {
        background: #2e668e;
    }


    #calendar .weekdays th {
        text-align: center;
        text-transform: uppercase;
        line-height: 20px;
        border: none !important;
        padding: 10px 6px;
        color: #fff;
        font-size: 13px;
    }

    #calendar td {
        min-height: 180px;
      display: flex;
      flex-direction: column;
    }

    #calendar .days li:hover {
        background: #d3d3d3;
    }

    #calendar .date {
        text-align: center;
        margin-bottom: 5px;
        padding: 4px;
        background: #333;
        color: #fff;
        width: 20px;
        border-radius: 50%;
      flex: 0 0 auto;
      align-self: flex-end;
    }

    #calendar .event {
      flex: 0 0 auto;
        font-size: 13px;
        border-radius: 4px;
        padding: 5px;
        margin-bottom: 5px;
        line-height: 14px;
        background: #e4f2f2;
        border: 1px solid #b5dbdc;
        color: #009aaf;
        text-decoration: none;
    }
    #calendar .taken {
        background-color: #b5f5b7;
    }

    #calendar .event-desc {
        color: #666;
        margin: 3px 0 7px 0;
        text-decoration: none;
    }
    #calendar .instructor_pointer {
        cursor: pointer;
    }

    #calendar .other-month {
        background: #f5f5f5;
        color: #666;
    }

    /* ============================
                    Mobile Responsiveness
       ============================*/


    @media(max-width: 768px) {

        #calendar .weekdays, #calendar .other-month {
            display: none;
        }

        #calendar li {
            height: auto !important;
            border: 1px solid #ededed;
            width: 100%;
            padding: 10px;
            margin-bottom: -1px;
        }

      #calendar, #calendar tr, #calendar tbody {
        grid-template-columns: 1fr;
      }

      #calendar  tr {
        grid-column: 1 / 2;
      }

        #calendar .date {
            align-self: flex-start;
        }
    }
</style>
@endsection
@section("content")

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Term: #TRM{{$term->id}} {{$term->name}}</div>
                <div class="card-body">
                    <table id="calendar">
                      {{-- <caption>August 2014</caption> --}}
                      <tr class="weekdays">
                        <th scope="col">Time/Day</th>
                        <th scope="col">Monday</th>
                        <th scope="col">Tuesday</th>
                        <th scope="col">Wednesday</th>
                        <th scope="col">Thursday</th>
                        <th scope="col">Friday</th>
                        <th scope="col">Saturday</th>
                        <th scope="col">Sunday</th>
                      </tr>

                      <tr class="days">
                        <td class="day">8:00-9:30</td>
                        @foreach($calendarCourses['800'] as $courses)

                        <td class="day">
                            @foreach($courses as $course)
                            <div class="event @if($course->pivot->is_taken) {{'taken'}} @endif">
                                <div class="event-desc">
                                @if($course){{$course->name}}@endif
                                </div>
                                @if(!$course->pivot->is_taken)
                                <div class="event-time">
                                    @foreach($instructors->where('pivot.schedule_id', $course->pivot->schedule_id)->where('pivot.course_id', $course->id)->where('pivot.is_taken', 0) as $instructor)
                                    <span
                                    class="instructor_pointer"
                                    data-toggle="modal" data-target="#setCourse"
                                    data-course="{{$course->name}}"
                                    data-schedule="{{$course->pivot->schedule->day}} ({{$course->pivot->schedule->time}})"
                                    data-instructor="{{$instructor->name}}"
                                    data-term_id="{{$term->id}}"
                                    data-course_id="{{$course->pivot->course_id}}"
                                    data-schedule_id="{{$instructor->pivot->schedule_id}}"
                                    data-instructor_id="{{$instructor->pivot->instructor_id}}"
                                    data-course_term_id="{{$course->pivot->id}}"
                                    data-instructor_term_id="{{$instructor->pivot->id}}"
                                    >{{$instructor->name}} ({{$instructor->pivot->priority}})
                                    </span>
                                    @endforeach
                                </div>
                                @else
                                <div class="event-time">
                                    @foreach($courseInstructorTerms->where('schedule_id', $course->pivot->schedule_id)->where('course_id', $course->id) as $courseInstructorTerm)
                                    <span
                                    class="instructor_pointer"
                                    data-toggle="modal" data-target="#unSetCourse"
                                    data-course="{{$course->name}}"
                                    data-schedule="{{$courseInstructorTerm->schedule->day}} ({{$courseInstructorTerm->schedule->time}})"
                                    data-instructor="{{$courseInstructorTerm->instructor->name}}"
                                    data-term_id="{{$term->id}}"
                                    data-course_id="{{$course->pivot->course_id}}"
                                    data-schedule_id="{{$courseInstructorTerm->schedule_id}}"
                                    data-instructor_id="{{$courseInstructorTerm->instructor_id}}"
                                    data-course_term_id="{{$courseInstructorTerm->course_term_id}}"
                                    data-instructor_term_id="{{$courseInstructorTerm->instructor_term_id}}"
                                    >{{$courseInstructorTerm->instructor->name}}
                                    </span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </td>
                        @endforeach
                      </tr>
                      <tr class="days">
                        <td class="day">9:30-11:00</td>
                        @foreach($calendarCourses['930'] as $courses)
                        <td class="day">
                            @foreach($courses as $course)
                            <div class="event @if($course->pivot->is_taken) {{'taken'}} @endif">
                                <div class="event-desc">
                                @if($course){{$course->name}}@endif
                                </div>
                                @if(!$course->pivot->is_taken)
                                <div class="event-time">
                                    @foreach($instructors->where('pivot.schedule_id', $course->pivot->schedule_id)->where('pivot.course_id', $course->id)->where('pivot.is_taken', 0) as $instructor)
                                    <span
                                    class="instructor_pointer"
                                    data-toggle="modal" data-target="#setCourse"
                                    data-course="{{$course->name}}"
                                    data-schedule="{{$course->pivot->schedule->day}} ({{$course->pivot->schedule->time}})"
                                    data-instructor="{{$instructor->name}}"
                                    data-term_id="{{$term->id}}"
                                    data-course_id="{{$course->pivot->course_id}}"
                                    data-schedule_id="{{$instructor->pivot->schedule_id}}"
                                    data-instructor_id="{{$instructor->pivot->instructor_id}}"
                                    data-course_term_id="{{$course->pivot->id}}"
                                    data-instructor_term_id="{{$instructor->pivot->id}}"
                                    >{{$instructor->name}} ({{$instructor->pivot->priority}})
                                    </span>
                                    @endforeach
                                </div>
                                @else
                                <div class="event-time">
                                    @foreach($courseInstructorTerms->where('schedule_id', $course->pivot->schedule_id)->where('course_id', $course->id) as $courseInstructorTerm)
                                    <span
                                    class="instructor_pointer"
                                    data-toggle="modal" data-target="#unSetCourse"
                                    data-course="{{$course->name}}"
                                    data-schedule="{{$courseInstructorTerm->schedule->day}} ({{$courseInstructorTerm->schedule->time}})"
                                    data-instructor="{{$courseInstructorTerm->instructor->name}}"
                                    data-term_id="{{$term->id}}"
                                    data-course_id="{{$course->pivot->course_id}}"
                                    data-schedule_id="{{$courseInstructorTerm->schedule_id}}"
                                    data-instructor_id="{{$courseInstructorTerm->instructor_id}}"
                                    data-course_term_id="{{$courseInstructorTerm->course_term_id}}"
                                    data-instructor_term_id="{{$courseInstructorTerm->instructor_term_id}}"
                                    >{{$courseInstructorTerm->instructor->name}}
                                    </span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </td>
                        @endforeach
                      </tr>
                      <tr class="days">
                        <td class="day">14:00-15:30</td>
                        @foreach($calendarCourses['1400'] as $courses)

                        <td class="day">
                            @foreach($courses as $course)
                            <div class="event @if($course->pivot->is_taken) {{'taken'}} @endif">
                                <div class="event-desc">
                                @if($course){{$course->name}}@endif
                                </div>
                                @if(!$course->pivot->is_taken)
                                <div class="event-time">
                                    @foreach($instructors->where('pivot.schedule_id', $course->pivot->schedule_id)->where('pivot.course_id', $course->id)->where('pivot.is_taken', 0) as $instructor)
                                    <span
                                    class="instructor_pointer"
                                    data-toggle="modal" data-target="#setCourse"
                                    data-course="{{$course->name}}"
                                    data-schedule="{{$course->pivot->schedule->day}} ({{$course->pivot->schedule->time}})"
                                    data-instructor="{{$instructor->name}}"
                                    data-term_id="{{$term->id}}"
                                    data-course_id="{{$course->pivot->course_id}}"
                                    data-schedule_id="{{$instructor->pivot->schedule_id}}"
                                    data-instructor_id="{{$instructor->pivot->instructor_id}}"
                                    data-course_term_id="{{$course->pivot->id}}"
                                    data-instructor_term_id="{{$instructor->pivot->id}}"
                                    >{{$instructor->name}} ({{$instructor->pivot->priority}})
                                    </span>
                                    @endforeach
                                </div>
                                @else
                                <div class="event-time">
                                    @foreach($courseInstructorTerms->where('schedule_id', $course->pivot->schedule_id)->where('course_id', $course->id) as $courseInstructorTerm)
                                    <span
                                    class="instructor_pointer"
                                    data-toggle="modal" data-target="#unSetCourse"
                                    data-course="{{$course->name}}"
                                    data-schedule="{{$courseInstructorTerm->schedule->day}} ({{$courseInstructorTerm->schedule->time}})"
                                    data-instructor="{{$courseInstructorTerm->instructor->name}}"
                                    data-term_id="{{$term->id}}"
                                    data-course_id="{{$course->pivot->course_id}}"
                                    data-schedule_id="{{$courseInstructorTerm->schedule_id}}"
                                    data-instructor_id="{{$courseInstructorTerm->instructor_id}}"
                                    data-course_term_id="{{$courseInstructorTerm->course_term_id}}"
                                    data-instructor_term_id="{{$courseInstructorTerm->instructor_term_id}}"
                                    >{{$courseInstructorTerm->instructor->name}}
                                    </span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </td>
                        @endforeach
                      </tr>
                      <tr class="days">
                        <td class="day">15:30-17:00</td>
                        @foreach($calendarCourses['1530'] as $courses)

                        <td class="day">
                            @foreach($courses as $course)
                            <div class="event @if($course->pivot->is_taken) {{'taken'}} @endif">
                                <div class="event-desc">
                                @if($course){{$course->name}}@endif
                                </div>
                                @if(!$course->pivot->is_taken)
                                <div class="event-time">
                                    @foreach($instructors->where('pivot.schedule_id', $course->pivot->schedule_id)->where('pivot.course_id', $course->id)->where('pivot.is_taken', 0) as $instructor)
                                    <span
                                    class="instructor_pointer"
                                    data-toggle="modal" data-target="#setCourse"
                                    data-course="{{$course->name}}"
                                    data-schedule="{{$course->pivot->schedule->day}} ({{$course->pivot->schedule->time}})"
                                    data-instructor="{{$instructor->name}}"
                                    data-term_id="{{$term->id}}"
                                    data-course_id="{{$course->pivot->course_id}}"
                                    data-schedule_id="{{$instructor->pivot->schedule_id}}"
                                    data-instructor_id="{{$instructor->pivot->instructor_id}}"
                                    data-course_term_id="{{$course->pivot->id}}"
                                    data-instructor_term_id="{{$instructor->pivot->id}}"
                                    >{{$instructor->name}} ({{$instructor->pivot->priority}})
                                    </span>
                                    @endforeach
                                </div>
                                @else
                                <div class="event-time">
                                    @foreach($courseInstructorTerms->where('schedule_id', $course->pivot->schedule_id)->where('course_id', $course->id) as $courseInstructorTerm)
                                    <span
                                    class="instructor_pointer"
                                    data-toggle="modal" data-target="#unSetCourse"
                                    data-course="{{$course->name}}"
                                    data-schedule="{{$courseInstructorTerm->schedule->day}} ({{$courseInstructorTerm->schedule->time}})"
                                    data-instructor="{{$courseInstructorTerm->instructor->name}}"
                                    data-term_id="{{$term->id}}"
                                    data-course_id="{{$course->pivot->course_id}}"
                                    data-schedule_id="{{$courseInstructorTerm->schedule_id}}"
                                    data-instructor_id="{{$courseInstructorTerm->instructor_id}}"
                                    data-course_term_id="{{$courseInstructorTerm->course_term_id}}"
                                    data-instructor_term_id="{{$courseInstructorTerm->instructor_term_id}}"
                                    >{{$courseInstructorTerm->instructor->name}}
                                    </span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </td>
                        @endforeach
                      </tr>
                      <tr class="days">
                        <td class="day">17:30-19:00</td>
                        @foreach($calendarCourses['1730'] as $courses)

                        <td class="day">
                            @foreach($courses as $course)
                            <div class="event @if($course->pivot->is_taken) {{'taken'}} @endif">
                                <div class="event-desc">
                                @if($course){{$course->name}}@endif
                                </div>
                                @if(!$course->pivot->is_taken)
                                <div class="event-time">
                                    @foreach($instructors->where('pivot.schedule_id', $course->pivot->schedule_id)->where('pivot.course_id', $course->id)->where('pivot.is_taken', 0) as $instructor)
                                    <span
                                    class="instructor_pointer"
                                    data-toggle="modal" data-target="#setCourse"
                                    data-course="{{$course->name}}"
                                    data-schedule="{{$course->pivot->schedule->day}} ({{$course->pivot->schedule->time}})"
                                    data-instructor="{{$instructor->name}}"
                                    data-term_id="{{$term->id}}"
                                    data-course_id="{{$course->pivot->course_id}}"
                                    data-schedule_id="{{$instructor->pivot->schedule_id}}"
                                    data-instructor_id="{{$instructor->pivot->instructor_id}}"
                                    data-course_term_id="{{$course->pivot->id}}"
                                    data-instructor_term_id="{{$instructor->pivot->id}}"
                                    >{{$instructor->name}} ({{$instructor->pivot->priority}})
                                    </span>
                                    @endforeach
                                </div>
                                @else
                                <div class="event-time">
                                    @foreach($courseInstructorTerms->where('schedule_id', $course->pivot->schedule_id)->where('course_id', $course->id) as $courseInstructorTerm)
                                    <span
                                    class="instructor_pointer"
                                    data-toggle="modal" data-target="#unSetCourse"
                                    data-course="{{$course->name}}"
                                    data-schedule="{{$courseInstructorTerm->schedule->day}} ({{$courseInstructorTerm->schedule->time}})"
                                    data-instructor="{{$courseInstructorTerm->instructor->name}}"
                                    data-term_id="{{$term->id}}"
                                    data-course_id="{{$course->pivot->course_id}}"
                                    data-schedule_id="{{$courseInstructorTerm->schedule_id}}"
                                    data-instructor_id="{{$courseInstructorTerm->instructor_id}}"
                                    data-course_term_id="{{$courseInstructorTerm->course_term_id}}"
                                    data-instructor_term_id="{{$courseInstructorTerm->instructor_term_id}}"
                                    >{{$courseInstructorTerm->instructor->name}}
                                    </span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </td>
                        @endforeach
                      </tr>
                      <tr class="days">
                        <td class="day">19:00-20:30</td>
                        @foreach($calendarCourses['1900'] as $courses)

                        <td class="day">
                            @foreach($courses as $course)
                            <div class="event @if($course->pivot->is_taken) {{'taken'}} @endif">
                                <div class="event-desc">
                                @if($course){{$course->name}}@endif
                                </div>
                                @if(!$course->pivot->is_taken)
                                <div class="event-time">
                                    @foreach($instructors->where('pivot.schedule_id', $course->pivot->schedule_id)->where('pivot.course_id', $course->id)->where('pivot.is_taken', 0) as $instructor)
                                    <span
                                    class="instructor_pointer"
                                    data-toggle="modal" data-target="#setCourse"
                                    data-course="{{$course->name}}"
                                    data-schedule="{{$course->pivot->schedule->day}} ({{$course->pivot->schedule->time}})"
                                    data-instructor="{{$instructor->name}}"
                                    data-term_id="{{$term->id}}"
                                    data-course_id="{{$course->pivot->course_id}}"
                                    data-schedule_id="{{$instructor->pivot->schedule_id}}"
                                    data-instructor_id="{{$instructor->pivot->instructor_id}}"
                                    data-course_term_id="{{$course->pivot->id}}"
                                    data-instructor_term_id="{{$instructor->pivot->id}}"
                                    >{{$instructor->name}} ({{$instructor->pivot->priority}})
                                    </span>
                                    @endforeach
                                </div>
                                @else
                                <div class="event-time">
                                    @foreach($courseInstructorTerms->where('schedule_id', $course->pivot->schedule_id)->where('course_id', $course->id) as $courseInstructorTerm)
                                    <span
                                    class="instructor_pointer"
                                    data-toggle="modal" data-target="#unSetCourse"
                                    data-course="{{$course->name}}"
                                    data-schedule="{{$courseInstructorTerm->schedule->day}} ({{$courseInstructorTerm->schedule->time}})"
                                    data-instructor="{{$courseInstructorTerm->instructor->name}}"
                                    data-term_id="{{$term->id}}"
                                    data-course_id="{{$course->pivot->course_id}}"
                                    data-schedule_id="{{$courseInstructorTerm->schedule_id}}"
                                    data-instructor_id="{{$courseInstructorTerm->instructor_id}}"
                                    data-course_term_id="{{$courseInstructorTerm->course_term_id}}"
                                    data-instructor_term_id="{{$courseInstructorTerm->instructor_term_id}}"
                                    >{{$courseInstructorTerm->instructor->name}}
                                    </span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </td>
                        @endforeach
                      </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="setCourse" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Set Courses/Instructors</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{route('calendar.confirm')}}" method="post">
                {{csrf_field()}}
                <div class="modal-body">
                    <input type="hidden" name="term_id" id="term_id">
                    <input type="hidden" name="course_term_id" id="course_term_id">
                    <input type="hidden" name="instructor_term_id" id="instructor_term_id">
                    <input type="hidden" name="course_id" id="course_id">
                    <input type="hidden" name="schedule_id" id="schedule_id">
                    <input type="hidden" name="instructor_id" id="instructor_id">
                    <div class="form-group">
                      <label for="course" id="course"></label>
                    </div>
                    <div class="form-group">
                      <label for="schedule" id="schedule"></label>
                    </div>
                    <div class="form-group">
                      <label for="instructor" id="instructor"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Confirm"></button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="unSetCourse" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Unset Courses/Instructors</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{route('calendar.unset')}}" method="post">
                {{csrf_field()}}
                <div class="modal-body">
                    <input type="hidden" name="term_id" id="unset_term_id">
                    <input type="hidden" name="course_term_id" id="unset_course_term_id">
                    <input type="hidden" name="instructor_term_id" id="unset_instructor_term_id">
                    <input type="hidden" name="course_id" id="unset_course_id">
                    <input type="hidden" name="schedule_id" id="unset_schedule_id">
                    <input type="hidden" name="instructor_id" id="unset_instructor_id">
                    <div class="form-group">
                      <label for="course" id="unset_course"></label>
                    </div>
                    <div class="form-group">
                      <label for="schedule" id="unset_schedule"></label>
                    </div>
                    <div class="form-group">
                      <label for="instructor" id="unset_instructor"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Unset"></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script>
    $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });
    $('#setCourse').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var term_id = button.data('term_id');
        var instructor_id = button.data('instructor_id');
        var course_id = button.data('course_id');
        var schedule_id = button.data('schedule_id');
        var instructor_term_id = button.data('instructor_term_id');
        var course_term_id = button.data('course_term_id');
        var course = button.data('course');
        var schedule = button.data('schedule');
        var instructor = button.data('instructor');

        var modal = $(this);
        modal.find('#course').text("Course: " + course);
        modal.find('#schedule').text("Schedule: " + schedule);
        modal.find('#instructor').text("Instructor: " + instructor);
        modal.find('#course_term_id').val(course_term_id);
        modal.find('#instructor_term_id').val(instructor_term_id);
        modal.find('#term_id').val(term_id);
        modal.find('#course_id').val(course_id);
        modal.find('#schedule_id').val(schedule_id);
        modal.find('#instructor_id').val(instructor_id);
        // modal.find('#priority').text("Priority: " + priority);

    });
    $('#unSetCourse').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
       var term_id = button.data('term_id');
       var instructor_id = button.data('instructor_id');
       var course_id = button.data('course_id');
       var schedule_id = button.data('schedule_id');
       var instructor_term_id = button.data('instructor_term_id');
       var course_term_id = button.data('course_term_id');
       var course = button.data('course');
       var schedule = button.data('schedule');
       var instructor = button.data('instructor');

       var modal = $(this);
       modal.find('#unset_course').text("Course: " + course);
       modal.find('#unset_schedule').text("Schedule: " + schedule);
       modal.find('#unset_instructor').text("Instructor: " + instructor);
       modal.find('#unset_course_term_id').val(course_term_id);
       modal.find('#unset_instructor_term_id').val(instructor_term_id);
       modal.find('#unset_term_id').val(term_id);
       modal.find('#unset_course_id').val(course_id);
       modal.find('#unset_schedule_id').val(schedule_id);
       modal.find('#unset_instructor_id').val(instructor_id);
        // modal.find('#priority').text("Priority: " + priority);

    });

</script>
@endsection