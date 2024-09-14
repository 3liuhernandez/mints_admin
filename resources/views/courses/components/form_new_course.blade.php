<form id="form_new_course" class="row" action="{{ route('courses.store') }}">
    @csrf
    <hr>

    <div class="col-md-6 col-xs-12 mb-3">
        <label for="fnc_title" class="form-label">Title</label>
        <input type="text" name="fnc_title" class="form-control nullable" id="fnc_title" placeholder="Title">
    </div>

    <div class="col-md-6 col-xs-12 mb-3">
        <label for="fnc_type" class="form-label">Type</label>
        <select class="form-select nullable" name="fnc_type" id="fnc_type">
            <option value="" selected disabled>Select Type</option>
            @foreach ($course_types as $type)
                <option value="{{ $type->id }}">{{ $type->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="w-100"></div>

    <div class="col-md-6 col-xs-12 mb-3">
        <label for="fnc_description" class="form-label">Description</label>
        <textarea class="form-control nullable" name="fnc_description" id="fnc_description" rows="3"></textarea>
    </div>

    <div class="col-md-6 col-xs-12 mb-3">
        <label for="fnc_status" class="form-label">Status</label>
        <select class="form-select nullable" name="fnc_status" id="fnc_status">
            <option value="" selected disabled>Select Status</option>
            @foreach ($course_statuses as $status)
                <option value="{{ $status->id }}">{{ $status->title }}</option>
            @endforeach
        </select>
    </div>

</form>