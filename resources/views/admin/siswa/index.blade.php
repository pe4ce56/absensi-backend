@extends('_partials/master')
@section('title', 'Siswa')
@section('page-head')
<!--Page Title-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="page-title">
    <h1 class="page-header text-overflow">Siswa</h1>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End page title-->


<!--Breadcrumb-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="demo-pli-home"></i></a></li>
    <li class="active">Siswa</li>
</ol>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End breadcrumb-->
@endsection
@section('content')
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Data Siswa</span>
        <a href="{{route('siswa.create')}}" class="btn btn-primary">Tambah</a>
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
                    <th>NISN</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Whatsapp</th>
                    <th>Alamat</th>
                    <th>TTL</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($siswas as $siswa)
                    <tr>
                        <td scope="row">#</td>
                        <td>{{$siswa->NISN}}</td>
                        <td>{{$siswa->user->username}}</td>
                        <td>{{$siswa->nama}}</td>
                        <td>{{strtoupper($siswa->jk)}}</td>
                        <td>{{$siswa->whatsapp}}</td>
                        <td>{{$siswa->alamat}}</td>
                        <td>{{$siswa->tanggal_lahir}}</td>
                        <td>{{$siswa->class->nama}}</td>

                        <td>
                            <form method="post" action="{{route('siswa.destroy', $siswa->id)}}">
                                @csrf
                                @method('delete')
                                <a href="{{route('siswa.edit', $siswa->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Menghapus siswa berarti menghapus seluruh data rekap absent siswa. Apakah Anda ingin melanjutkan penghapusan ?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$siswas->links()}}
    </div>
    <div class="panel-footer">

    </div>
</div>
@endsection
