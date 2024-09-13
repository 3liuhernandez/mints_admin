
@php
    $testing = false;
    $student = (object) [
        "dni" => "24362441",
        "name" => "eliu",
        "last_name" => "hernandez",
        "address" => "maracaibo",
        "email" => "3liuhernandez@gmail.com",
        "phone" => "04124732914"
    ];

    if ( empty($testing) || !$testing ) $student = null;
@endphp

<form id="form_new_student" class="row" action="{{ route('students.store') }}">
    @csrf
    <hr>

    {{-- course list --}}
    {{-- <div class="mb-3">
        <label for="fns_course_id" class="form-label">Courses</label>
        <select name="fns_course_id" id="fns_course_id" class="form-control nullable">
            <option value="">Select a course</option>
            @foreach($courses as $key => $value)
                <option value="{{$value->code}}">{{$value->name}}</option>
            @endforeach
        </select>
    </div> --}}

    <div class="col-md-6 col-xs-12 mb-3">
        <label for="fns_dni" class="form-label">DNI</label>
        <input @if( !empty($student->dni)) value="{{ (int) $student->dni}}" @endif type="number" name="fns_dni" class="form-control nullable" id="fns_dni" placeholder="DNI">
    </div>

    <div class="col-md-6 col-xs-12 mb-3">
        <label for="fns_email" class="form-label">Email</label>
        <input @if( !empty($student->email)) value="{{$student->email}}" @endif type="text" maxlength="50" name="fns_email" class="form-control nullable" id="fns_email" placeholder="Email">
    </div>
    
    <div class="col-md-6 col-xs-12 mb-3">
        <label for="fns_phone" class="form-label">Phone</label>
        <input @if( !empty($student->phone)) value="{{ (int) $student->phone}}" @endif type="number" maxlength="20" name="fns_phone" class="form-control nullable" id="fns_phone" placeholder="Phone">
    </div>

    <div class="w-100"></div>

    <div class="col-md-6 col-xs-12 mb-3">
        <label for="fns_name" class="form-label">Name</label>
        <input @if( !empty($student->name)) value="{{$student->name}}" @endif type="text" maxlength="100" name="fns_name" class="form-control" id="fns_name" placeholder="name">
    </div>

    <div class="col-md-6 col-xs-12 mb-3">
        <label for="fns_last_name" class="form-label">Last Name</label>
        <input @if( !empty($student->last_name)) value="{{$student->last_name}}" @endif type="text" maxlength="100" name="fns_last_name" class="form-control" id="fns_last_name" placeholder="last name">
    </div>

    <div class="col-md-6 col-xs-12 mb-3">
        <label for="fns_address" class="form-label">Address</label>
        <textarea class="form-control nullable" name="fns_address" id="fns_address" rows="3">@if( !empty($student->address)) {{$student->address}} @endif</textarea>
    </div>

</form>