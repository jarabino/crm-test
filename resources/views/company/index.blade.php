@extends('layouts.base')

@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Company</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Company</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <a href="{{route('company.create')}}" class="btn btn-success mb-2">@lang('messages.new_company')</a>
                <div class="table-container">
                @if(session()->has('success_msg'))
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success_msg') }}
                    </div>
                </div>
                @endif
                    <table id="companyTable" class="display">
                        <thead class="card-header py-3">
                            <tr>
                                <th scope="col"><h5>Id</h5></th>
                                <th scope="col"><h5>@lang('messages.name')</h5></th>
                                <th scope="col"><h5>@lang('messages.email')</h5></th>
                                <th scope="col"><h5>@lang('messages.logo')</h5></th>
                                <th scope="col"><h5>@lang('messages.website')</h5></th>
                                <th scope="col"><h5>Actions</h5></th>
                            </tr>


                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                            <tr>
                                <td>{{$company->id}}</td>
                                <td>{{$company->name}}</td>
                                <td>{{$company->email}}</td>
                                <td>
                                    <img class="img-fluid img-thumbnail w-25" src="{{asset('storage/'.$company->logo)}}">
                                </td>
                                <td>{{$company->website}}</td>
                                <td>
                                <a
                                    href="{{ route('company.edit', $company->id) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form 
                                    action="{{ route('company.destroy', $company->id) }}"
                                    method="POST"
                                    id="delete_form_{{ $company->id }}" 
                                    class="d-none"
                                >
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <input 
                                        type="hidden" 
                                        name="company_id" 
                                        value="{{ $company->id }}"
                                    >
                                </form>
                                <a
                                    href="#"
                                    class="btn btn-danger btn-sm delete_btn"
                                    data-id="{{ $company->id }}"
                                >
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
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
        $('#companyTable').DataTable();
        $(document).on('click', '.delete_btn', function () {
                let companyId = $(this).data('id');
                $(`#delete_form_${companyId}`).trigger('submit');
            });
    });

</script>
@endpush