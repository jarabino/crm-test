@extends('layouts.base')

@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Employee</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">@lang('messages.employee')</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <a href="{{route('employee.create')}}" class="btn btn-success mb-2">@lang('messages.new_employee')</a>
                <div class="table-container">
                @if(session()->has('success_msg'))
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success_msg') }}
                    </div>
                </div>
                @endif
                    <table id="employeeTable" class="display">
                        <thead class="card-header py-3">
                            <tr>
                                <th scope="col"><h5>Id</h5></th>
                                <th scope="col"><h5>@lang('messages.last_name')</h5></th>
                                <th scope="col"><h5>@lang('messages.first_name')</h5></th>
                                <th scope="col"><h5>@lang('messages.company')</h5></th>
                                <th scope="col"><h5>@lang('messages.email')</h5></th>
                                <th scope="col"><h5>@lang('messages.phone')</h5></th>
                                <th scope="col"><h5>Actions</h5></th>
                            </tr>


                        </thead>

                        @foreach($employees as $employee)
                            <tr>
                                <td>{{$employee->id}}</td>
                                <td>{{$employee->last_name}}</td>
                                <td>{{$employee->first_name}}</td>
                                <td>{{$employee->company->name}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->mobile_no}}</td>
                                <td>
                                    <a
                                        href="{{ route('employee.edit', $employee->id) }}"
                                        class="btn btn-warning btn-sm"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form 
                                    action="{{ route('employee.destroy', $employee->id) }}"
                                    method="POST"
                                    id="delete_form_{{ $employee->id }}" 
                                    class="d-none"
                                >
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <input 
                                        type="hidden" 
                                        name="employee_id" 
                                        value="{{ $employee->id }}"
                                    >
                                </form>
                                <a
                                    href="#"
                                    class="btn btn-danger btn-sm delete_btn"
                                    data-id="{{ $employee->id }}"
                                >
                                    <i class="fas fa-trash"></i>
                                </a>
                                </td>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('scripts')
<script>
    $(document).ready( function () {
            $('#employeeTable').DataTable();
            $(document).on('click', '.delete_btn', function () {
                let employeeId = $(this).data('id');
                $(`#delete_form_${employeeId}`).trigger('submit');
            });
    });

</script>
@endpush