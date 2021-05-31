@extends('_partials/master')
@section('title', 'Tambah Siswa')
@section('css')
<!--Chosen [ OPTIONAL ]-->
<link href="{{asset('assets/plugins/chosen/chosen.min.css')}}" rel="stylesheet">
@endsection
@section('page-head')
<!--Page Title-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="page-title">
    <h1 class="page-header text-overflow">Tambah Siswa</h1>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End page title-->


<!--Breadcrumb-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{route('siswa.index')}}">Siswa</a></li>
    <li class="active">Create</li>
</ol>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End breadcrumb-->
@endsection
@section('content')
<div class="panel">
    <form method="post" action="{{route('siswa.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="panel-heading" style="padding: .75rem">
            <a href="{{route('siswa.index')}}" class="btn btn-primary btn-sm">Kembali</a>
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

                    <div class="form-group @error('nisn') has-error @enderror">
                        <label class="control-label">NISN*</label>
                        <input type="text" class="form-control" name="nisn" value="{{old('nisn')}}">
                        @error('nisn')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('name') has-error @enderror">
                        <label class="control-label">Nama*</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        @error('name')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('password') has-error @enderror">
                        <label class="control-label">Password*</label>
                        <input type="password" class="form-control" name="password" value="{{old('password')}}">
                        @error('password')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('password_conf') has-error @enderror">
                        <label class="control-label">Konfirmasi Password*</label>
                        <input type="password" class="form-control" name="password_conf"
                            value="{{old('password_conf')}}">
                        @error('password_conf')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('gender') has-error @enderror">
                        <label class="control-label">Jenis Kelamin*</label>
                        <div class="radio">
                            <input id="demo-form-radio" class="magic-radio" type="radio" value="m" name="gender"
                                checked>
                            <label for="demo-form-radio">Laki - Laki</label>
                        </div>
                        <div class="radio">
                            <input id="demo-form-radio-2" class="magic-radio" type="radio" value="f" name="gender">
                            <label for="demo-form-radio-2">Perempuan</label>
                        </div>
                        @error('gender')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('birth_date') has-error @enderror">
                        <label class="control-label">Tanggal Lahir*</label>
                        <input type="date" class="form-control" name="birth_date" value="{{old('birth_date')}}">
                        @error('birth_date')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('whatsapp') has-error @enderror">
                        <label class="control-label">Whatsapp*</label>
                        <input type="text" class="form-control" name="whatsapp" value="{{old('whatsapp')}}">
                        @error('whatsapp')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('class_id') has-error @enderror">
                        <label class="control-label">Kelas*</label>
                        {{-- <input type="text" class="form-control" name="class_id" value="{{old('class_id')}}"> --}}
                        <select data-placeholder="Pilih kelas ..." id="demo-chosen-select" name="class_id"
                            class="form-control" tabindex="2">
                            @foreach($kelases as $kelas)
                            <option value="{{$kelas->id}}">{{$kelas->nama}}</option>
                            @endforeach
                        </select>
                        @error('class_id')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('address') has-error @enderror">
                        <label class="control-label">Alamat*</label>
                        <textarea class="form-control" name="address">{{old('address')}}</textarea>
                        @error('address')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('student_pict') has-error @enderror">
                        <label class="control-label">Foto Siswa</label>
                        <input type="file" name="student_pict" class="form-control" accept="image/*"
                            value="{{old('student_pict')}}">
                        @error('student_pict')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
        <div class="panel-footer">
        </div>
    </form>
</div>
@endsection
@section('js')
<!--Chosen [ OPTIONAL ]-->
<script src="{{asset('assets/plugins/chosen/chosen.jquery.min.js')}}"></script>

<script>
    $('#demo-chosen-select').chosen()

</script>
@endsection