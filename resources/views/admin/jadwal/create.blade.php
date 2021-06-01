@extends('_partials/master')
@section('title', 'Tambah Jadwal')
@section('css')
<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-head')
<!--Page Title-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="page-title">
    <h1 class="page-header text-overflow">Tambah Jadwal</h1>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End page title-->


<!--Breadcrumb-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{route('jadwal.index')}}">Jadwal</a></li>
    <li class="active">Create</li>
</ol>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End breadcrumb-->
@endsection
@section('content')
<div class="panel">
    <form method="post" action="{{route('jadwal.store')}}">
        @csrf
        <div class="panel-heading" style="padding: .75rem">
            <a href="{{route('jadwal.index')}}" class="btn btn-primary btn-sm">Kembali</a>
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

                    <div class="form-group @error('teacher_mapel') has-error @enderror">
                        <label class="control-label">Guru Mapel*</label>
                        <select id="guru-mapel-single" name="teacher_mapel" class="form-control">
                            <option selected disabled>Pilih guru mapel ...</option>
                            @foreach($guruMapels as $guruMapel)
                            <option value="{{$guruMapel->id}}">{{$guruMapel->teacher->nama}} - {{ $guruMapel->mapel->nama }}</option>
                            @endforeach
                        </select>
                        @error('teacher_mapel')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('class') has-error @enderror">
                        <label class="control-label">Kelas*</label>
                        <select id="kelas-single" name="class" class="form-control">
                            <option selected disabled>Pilih kelas ...</option>
                            @foreach($kelases as $kelas)
                            <option value="{{$kelas->id}}">{{$kelas->nama}}</option>
                            @endforeach
                        </select>
                        @error('class')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('day') has-error @enderror">
                        <label class="control-label">Hari*</label>
                        <select id="day-single" name="day" class="form-control">
                            <option selected disabled>Pilih hari ...</option>

                            <option value="1">Senin</option>
                            <option value="2">Selasa</option>
                            <option value="3">Rabu</option>
                            <option value="4">Kamis</option>
                            <option value="5">Jumat</option>
                        </select>
                        @error('day')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('time') has-error @enderror">
                        <label class="control-label">Waktu*</label>
                        <input class="form-control" type="time" min="06:30" max="15:45" name="time">
                        @error('time')
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
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script>
    $('#guru-mapel-single').select2()
    $('#kelas-single').select2()
    $('#day-single').select2()

</script>
@endsection
