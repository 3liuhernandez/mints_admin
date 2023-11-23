<form id="form_new_member" action="{{ route('memberships.store') }}">
    @csrf
    <hr>
    <div class="mb-3">
        <label for="fnm_coordination_id" class="form-label">Coordinations</label>
        <select name="fnm_coordination_id" id="fnm_coordination_id" class="form-control">
            <option value="">Select a coordination</option>
            @foreach($coords as $key => $value)
                <option value="{{$value->code}}">{{$value->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="fnm_role" class="form-label">Role</label>
        <input type="date" name="fnm_role" class="form-control nullable" id="fnm_role">
    </div>
    <hr/>
    <div class="mb-3">
        <label for="fnm_name" class="form-label">Name</label>
        <input type="text" maxlength="100" name="fnm_name" class="form-control" id="fnm_name" placeholder="name">
    </div>
    <div class="mb-3">
        <label for="fnm_last_name" class="form-label">Last Name</label>
        <input type="text" maxlength="100" name="fnm_last_name" class="form-control" id="fnm_last_name" placeholder="last name">
    </div>
    <div class="mb-3">
        <label for="fnm_dni" class="form-label">D.N.I</label>
        <input type="number" name="fnm_dni" class="form-control nullable" id="fnm_dni" placeholder="DNI">
    </div>
    <div class="mb-3">
        <label for="fnm_address" class="form-label">Address</label>
        <textarea class="form-control nullable" name="fnm_address" id="fnm_address" rows="3"></textarea>
    </div>
</form>