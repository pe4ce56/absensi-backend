@extends('_partials/master')
@section('title', 'Edit Jadwal')
@section('css')
<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-head')
<!--Page Title-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="page-title">
    <h1 class="page-header text-overflow">Edit Jadwal {{$jadwal->teacher_mapel->teacher->nama}} - {{$jadwal->teacher_mapel->mapel->nama}}</h1>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End page title-->


<!--Breadcrumb-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{route('jadwal.index')}}">Jadwal</a></li>
    <li class="active">Edit</li>
</ol>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End breadcrumb-->
@endsection
@section('content')
<div class="panel">
    <form method="post" action="{{route('jadwal.update', $jadwal->id)}}">
        @csrf
        @method('put')
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

                    <div class="form-group @error('day') has-error @enderror">
                        <label class="control-label">Hari*</label>
                        <select id="day-single" name="day" class="form-control">
                            <option selected disabled>Pilih hari ...</option>

                            @foreach($dayList as $key => $day)
                            <option value="{{$key}}" {{$key == $jadwal->hari ? 'selected' : null}}>{{ucfirst($day)}}</option>
                            @endforeach
                        </select>
                        @error('day')
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('time') has-error @enderror">
                        <label class="control-label">Waktu*</label>
                        <input class="form-control" type="time" min="06:30" max="15:45" name="time" value="{{preg_replace('/:\d\d$/', '', $jadwal->waktu)}}">
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
    //$('#guru-mapel-single').select2()
    //$('#kelas-single').select2()
    $('#day-single').select2()

</script>
@endsection
