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
            @if(session()->has('success_msg'))
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success_msg') }}
                </div>
            </div>
            @endif
            <form action="{{route('company.update', $company->id)}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('put') }}
            @include('company.form', ['submitButtonText' => 'Save', 'company' => $company])
            </form>
            </div>
        </div>
    </div>
</main>
@endsection
@push('scripts')

@endpush