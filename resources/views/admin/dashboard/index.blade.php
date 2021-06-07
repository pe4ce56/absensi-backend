@extends('_partials/master')
@section('title', 'Dashboard')
@section('page-head')
<!--Page Title-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="page-title">
    <h1 class="page-header text-overflow">Dashboard</h1>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End page title-->

<div class="pad-all text-center">
    <h3>Selamat Datang.</h3>
    <p1>Banyak aktifitas yang bisa dilakukan hari ini.</p>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-warning panel-colorful media middle pad-all">
            <div class="media-left">
                <div class="pad-hor">
                    <i class="ti-user"></i>
                </div>
            </div>
            <div class="media-body">
                <p class="text-2x mar-no text-semibold">{{$data['teacher_count']}}</p>
                <p class="mar-no">Guru</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-info panel-colorful media middle pad-all">
            <div class="media-left">
                <div class="pad-hor">
                    <i class="ti-user"></i>
                </div>
            </div>
            <div class="media-body">
                <p class="text-2x mar-no text-semibold">{{$data['student_count']}}</p>
                <p class="mar-no">Siswa</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-mint panel-colorful media middle pad-all">
            <div class="media-left">
                <div class="pad-hor">
                    <i class="ti-direction"></i>
                </div>
            </div>
            <div class="media-body">
                <p class="text-2x mar-no text-semibold">{{$data['class_count']}}</p>
                <p class="mar-no">Kelas</p>
            </div>
        </div>
    </div>

</div>
@endsection
