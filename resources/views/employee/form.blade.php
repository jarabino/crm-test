<div class="form-group">
    <label for="first_name">@lang('messages.first_name')</label>
    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter First Name" value="{{ old('first_name', $employee->first_name) }}">
</div>
<div class="form-group">
    <label for="last_name">@lang('messages.last_name')</label>
    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter Last Name" value="{{ old('last_name', $employee->last_name) }}">
</div>
<div class="form-group">
    <label for="mobile_no">@lang('messages.phone')</label>
    <input type="number" name="mobile_no" class="form-control" id="mobile_no" placeholder="Enter Mobile Number" value="{{ old('mobile_no', $employee->mobile_no) }}">
</div>
<div class="form-group">
<label for="company_id">@lang('messages.company')</label>
<select class="form-control" id="company_id" name="company_id" >
    <option value="">Select Company</option>
    @foreach($companies as $company)
        @if(isset($employee->company)) {
        <option value="{{$company->id}}" @if($employee->company->id == $company->id) selected @endif>{{$company->name}}</option>
        @else
        <option value="{{$company->id}}">{{$company->name}}</option>
        @endif
    @endforeach
</select>
</div>
<div class="form-group">
    <label for="email">@lang('messages.email')</label>
    <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{ old('email', $employee->email) }}">
</div>
<button type="submit" class="btn btn-primary">{{$submitButtonText}}</button>
