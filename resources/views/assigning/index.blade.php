@extends("layouts.app")

@section("styles")
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Assigning courses/instructors</div>

                <div class="card-body">
                    <form onsubmit="return confirm('Do you really want to submit the form?');" action="{{route("assigning.selectTerm")}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                          <label for="term">Select a term from the last recent five<span class="text-danger">*</span></label>
                          <select class="form-control" name="term_id" id="term">
                            @foreach($terms as $term)
                            <option value="{{$term->id}}">{{$term->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <br>
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