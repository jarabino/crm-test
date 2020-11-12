<div class="form-group">
    <label for="name">@lang('messages.name')</label>
    <input type="text" name="name" class="form-control" id="name" placeholder="@lang('messages.name')" value="{{ old('name', $company->name) }}">

</div>
<div class="form-group">
    <label for="email">@lang('messages.email')</label>
    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{ old('email', $company->email) }}">

</div>

<div class="form-group">
    <label for="">@lang('messages.logo')</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="logo" name="logo">
        <label class="custom-file-label" for="logo">Choose file</label>
    </div>

</div>


<div class="form-group">
    <label for="website">@lang('messages.website')</label>
    <input type="text" name="website" class="form-control" id="website" placeholder="Enter Website" value="{{ old('website', $company->website) }}">

</div>

<button type="submit" class="btn btn-primary">{{$submitButtonText}}</button>
@push('scripts')
<script>

$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
@endpush