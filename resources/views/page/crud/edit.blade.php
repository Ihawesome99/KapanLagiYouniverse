<!-- Extend ke template.blade.php -->
@extends('template')
<!-- End Extends -->

<!-- Section Judul Menu -->
@section('judul')
CRUD
@endsection
<!-- End Section -->

<!-- Section Content -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit @yield('judul')</h6>            
            </div>
            <div class="card-body">
            <form action="{{route('crud.edit', $data[6])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" placeholder="Masukkan Nama lengkap" class="form-control @if($errors->first('name')) is-invalid @endif" value="{{$data[0]}}">
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Masukkan Email valid" class="form-control @if($errors->first('email')) is-invalid @endif" value="{{$data[1]}}">
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="dob" class="form-control @if($errors->first('dob')) is-invalid @endif" value="{{date('Y-m-d',strtotime($data[3]))}}">
                        <div class="invalid-feedback">{{ $errors->first('dob') }}</div>
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="numeric" name="no_hp" placeholder="Masukkan Nomor Telepon" class="form-control @if($errors->first('no_hp')) is-invalid @endif" value="{{$data[2]}}">
                        <div class="invalid-feedback">{{ $errors->first('no_hp') }}</div>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control @if($errors->first('gender')) is-invalid @endif" name="gender">
                            <option value="">Pilih Gender</option>
                            @if($data[4] === 'Male')
                            <option value="Male" selected>Male</option>
                            <option value="Female">Female</option>
                            @elseif ($data[4] === 'Female')
                            <option value="Male">Male</option>
                            <option value="Female" selected>Female</option>
                            @else
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            @endif
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('gender') }}</div>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        @if($data[5] !== '-')
                        <div style="width:100px;height:100%">
                            <img width="100%" height="100%" src="{{'/storage/'.$data[5]}}">
                        </div>
                        @else
                        <div>
                            Image belum ada
                        </div>
                        @endif
                        <input type="file" name="foto" class="form-control @if($errors->first('foto')) is-invalid @endif" value="{{old('foto')}}">
                        <div class="invalid-feedback">{{ $errors->first('foto') }}</div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
<!-- End Section -->