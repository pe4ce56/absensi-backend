@extends('_partials/master')
@section('title', 'Kelas')
@section('page-head')
<!--Page Title-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="page-title">
    <h1 class="page-header text-overflow">Kelas</h1>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End page title-->


<!--Breadcrumb-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="demo-pli-home"></i></a></li>
    <li class="active">Kelas</li>
</ol>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End breadcrumb-->
@endsection
@section('content')
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Data Kelas</span>
        <a href="{{route('kelas.create')}}" class="btn btn-primary">Tambah</a>
    </div>
    <div class="panel-body">
        @if (Session::has('success'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
            <strong>Well done!</strong> {{Session::get('success')}}
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-inverse">
                    <th>#</th>
                    <th>Nama Kelas</th>
                    <th>Jumlah Siswa</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($kelasses as $kelas)
                    <tr>
                        <td scope="row">#</td>
                        <td>{{$kelas->nama}}</td>
                        <td>{{count($kelas->students)}}</td>
                        <td>
                            <form method="post" action="{{route('kelas.destroy', $kelas->id)}}">
                                @csrf
                                @method('delete')
                                <a href="{{route('kelas.edit', $kelas->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Menghapus kelas berarti menghapus seluruh data siswa dan jadwal yang berada dalam kelas. Apakah Anda ingin melanjutkan penghapusan ?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$kelasses->links()}}
    </div>
    <div class="panel-footer">

    </div>
</div>
@endsection
