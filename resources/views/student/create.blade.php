@extends('layouts.app')

{{-- @section('content') --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Add Student</h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('add-student') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">Student Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Student Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Student Course</label>
                            <input type="text" name="course" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Student Section</label>
                            <input type="text" name="section" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Save Student</button>
                            <a href="{{ url('stduent-list') }}" class="btn btn-danger float-end">BACK</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- @endsection --}}