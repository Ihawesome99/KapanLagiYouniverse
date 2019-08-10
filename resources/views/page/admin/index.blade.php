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
            <h6 class="m-0 font-weight-bold text-primary">Form @yield('judul')</h6>            
        </div>
        <div class="card-body">
            <form action="{{route('admin.store')}}" method="post">
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
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan Password" class="form-control @if($errors->first('password')) is-invalid @endif" value="{{old('password')}}">
                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tabel @yield('judul')</h6>            
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th><th>Nama</th><th>Email</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $datas)
                    <tr>
                        <td>{{++$number}}</td>
                        <td>{{$datas->name}}</td>
                        <td>{{$datas->email}}</td>
                        <td>
                            <a href="{{route('admin.edit', $datas->id)}}" class="btn btn-primary"><span class="fa fa-edit"></span></a>                           
                            <form class="form--button" action="{{route('admin.drop', $datas->id)}}" method="POST">
                                @csrf
                                <button onclick="return confirm('Apakah anda yakin ?')" type="submit" class="btn btn-danger"><span class="fa fa-trash"></span></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4"></td>
                        <td>Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="text-center">
                {!! $data->appends(request()->all())->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
<!-- End Section -->
