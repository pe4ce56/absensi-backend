@extends('_partials/master')
@section('title', 'Edit Kelas')
@section('page-head')
<!--Page Title-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="page-title">
    <h1 class="page-header text-overflow">Edit Kelas {{$kelas->nama}}</h1>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End page title-->


<!--Breadcrumb-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{route('kelas.index')}}">Kelas</a></li>
    <li class="active">Edit</li>
</ol>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End breadcrumb-->
@endsection
@section('content')
<div class="panel">
    <form method="post" action="{{route('kelas.update', $kelas->id)}}">
        @csrf
        @method('put')
        <div class="panel-heading" style="padding: .75rem">
            <a href="{{route('kelas.index')}}" class="btn btn-primary btn-sm">Kembali</a>
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

                    <div class="form-group @error('name') has-error @enderror">
                        <label class="control-label">Nama Kelas</label>
                        <input type="text" class="form-control" name="name" value="{{$kelas->nama}}">
                        @error('name')
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
