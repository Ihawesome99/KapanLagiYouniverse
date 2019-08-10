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
                <h6 class="m-0 font-weight-bold text-primary">Form @yield('judul')</h6>            
            </div>
            <div class="card-body">
                <form action="{{route('crud.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" placeholder="Masukkan Nama lengkap" class="form-control @if($errors->first('name')) is-invalid @endif" value="{{old('name')}}">
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Masukkan Email valid" class="form-control @if($errors->first('email')) is-invalid @endif" value="{{old('email')}}">
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="dob" class="form-control @if($errors->first('dob')) is-invalid @endif" value="{{old('dob')}}">
                        <div class="invalid-feedback">{{ $errors->first('dob') }}</div>
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="numeric" name="no_hp" placeholder="Masukkan Nomor Telepon" class="form-control @if($errors->first('no_hp')) is-invalid @endif" value="{{old('no_hp')}}">
                        <div class="invalid-feedback">{{ $errors->first('no_hp') }}</div>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control @if($errors->first('gender')) is-invalid @endif" name="gender">
                            <option value="">Pilih Gender</option>
                            @if(old('gender') === 'Male')
                            <option value="Male" selected>Male</option>
                            <option value="Female">Female</option>
                            @elseif (old('gender') === 'Female')
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
                        <input type="file" name="foto" class="form-control @if($errors->first('foto')) is-invalid @endif" value="{{old('foto')}}">
                        <div class="invalid-feedback">{{ $errors->first('foto') }}</div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tabel @yield('judul')</h6>            
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th><th>Nama</th><th>Email</th><th>No Hp</th><th>Tgl Lahir</th><th>Gender</th><th>Foto</th><th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $datas)
                        <tr>
                            <td>{{++$number}}</td>
                            <td>{{$datas[0]}}</td>
                            <td>{{$datas[1]}}</td>
                            <td>{{$datas[2]}}</td>
                            <td>{{$datas[3]}}</td>
                            <td>{{$datas[4]}}</td>
                            <td>
                                @if($datas[5] !== '-')
                                <img src="{{'/storage/'.$datas[5]}}" width="100px">
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                <a href="{{route('crud.edit', $datas[6])}}" class="btn btn-primary"><span class="fa fa-edit"></span></a>                           
                                <form class="form--button" action="{{route('crud.drop', $datas[6])}}" method="POST">
                                    @csrf
                                    <button onclick="return confirm('Apakah anda yakin ?')" type="submit" class="btn btn-danger"><span class="fa fa-trash"></span></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td>Data tidak ada</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
<!-- End Section -->