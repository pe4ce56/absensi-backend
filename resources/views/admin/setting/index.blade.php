@extends('_partials/master')
@section('title', 'Pengaturan')
@section('page-head')
<!--Page Title-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="page-title">
    <h1 class="page-header text-overflow">Pengaturan</h1>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End page title-->


<!--Breadcrumb-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="demo-pli-home"></i></a></li>
    <li class="active">Pengaturan</li>
</ol>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End breadcrumb-->
@endsection
@section('content')
<div class="panel">
    <form method="post" action="{{route('setting.update')}}" enctype="multipart/form-data">
        @csrf
        <div class="panel-heading" style="padding: .75rem">
            <a href="{{route('dashboard.index')}}" class="btn btn-primary btn-sm">Kembali</a>
        </div>
        <div class="panel-body">
            <div class="row" style="margin-top: 1.5rem">
                <div class="col-0 col-md-2"></div>
                <div class="col-md-9">
                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                        <strong>Well done!</strong> {{Session::get('success')}}
                    </div>
                    @endif

                    <div class="form-group @error('app_name') has-error @enderror">
                        <label class="control-label">Nama Aplikasi*</label>
                        <input type="text" class="form-control" name="app_name"
                            value="{{$data['configuration']['app-name'] ?? ''}}">
                        @error('app_name')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('app_logo') has-error @enderror">
                        <label class="control-label">Logo Aplikasi*</label>

                        <div style="margin-bottom:.75rem">
                            <img src="{{asset('app/'. ($data['configuration']['app-logo'] ?? ''))}}" class="img-lg"
                                alt="Profile Picture">
                        </div>

                        <input type="file" name="app_logo" class="form-control" accept="image/*">
                        @error('app_logo')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- <div class="form-group @error('password_conf') has-error @enderror">
                        <label class="control-label">Konfirmasi Passowrd*</label>
                        <input type="text" class="form-control" name="password_conf" value="{{old('password_conf')}}">
                        @error('password_conf')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div> --}}

                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
        <div class="panel-footer">
        </div>
    </form>
</div>
@endsection