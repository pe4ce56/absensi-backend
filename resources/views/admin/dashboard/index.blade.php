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
    <div class="col-md-3">
        <div class="panel panel-warning panel-colorful media middle pad-all">
            <div class="media-left">
                <div class="pad-hor">
                    <i class="demo-pli-file-word icon-3x"></i>
                </div>
            </div>
            <div class="media-body">
                <p class="text-2x mar-no text-semibold">241</p>
                <p class="mar-no">Documents</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-info panel-colorful media middle pad-all">
            <div class="media-left">
                <div class="pad-hor">
                    <i class="demo-pli-file-zip icon-3x"></i>
                </div>
            </div>
            <div class="media-body">
                <p class="text-2x mar-no text-semibold">241</p>
                <p class="mar-no">Zip Files</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-mint panel-colorful media middle pad-all">
            <div class="media-left">
                <div class="pad-hor">
                    <i class="demo-pli-camera-2 icon-3x"></i>
                </div>
            </div>
            <div class="media-body">
                <p class="text-2x mar-no text-semibold">241</p>
                <p class="mar-no">Photos</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-danger panel-colorful media middle pad-all">
            <div class="media-left">
                <div class="pad-hor">
                    <i class="demo-pli-video icon-3x"></i>
                </div>
            </div>
            <div class="media-body">
                <p class="text-2x mar-no text-semibold">241</p>
                <p class="mar-no">Videos</p>
            </div>
        </div>
    </div>

</div>
@endsection
