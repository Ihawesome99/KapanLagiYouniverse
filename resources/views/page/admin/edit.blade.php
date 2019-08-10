<!-- Extend ke template.blade.php -->
@extends('template')
<!-- End Extends -->

<!-- Section Judul Menu -->
@section('judul')
Admin
@endsection
<!-- End Section -->

<!-- Section Content -->
@section('content')
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-2">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit @yield('judul')</h6>            
        </div>
        <div class="card-body">
            <form action="{{route('admin.update', $data->id)}}" method="post">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" placeholder="Masukkan Nama lengkap" class="form-control @if($errors->first('name')) is-invalid @endif" value="{{$data->name}}">
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email valid" class="form-control @if($errors->first('email')) is-invalid @endif" value="{{$data->email}}">
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan Password" class="form-control @if($errors->first('password')) is-invalid @endif">
                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
<!-- End Section -->