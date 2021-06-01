@extends('_partials/master')
@section('title', 'Guru')
@section('page-head')
<!--Page Title-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="page-title">
    <h1 class="page-header text-overflow">Guru</h1>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End page title-->

<!--Breadcrumb-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="demo-pli-home"></i></a></li>
    <li class="active">Guru</li>
</ol>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End breadcrumb-->
@endsection
@section('content')
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Data Guru</span>
        <a href="{{route('guru.create')}}" class="btn btn-primary">Tambah</a>
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
                    <th>NIP</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Whatsapp</th>
                    <th>Alamat</th>
                    <th>TTL</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($gurus as $guru)
                    <tr>
                        <td scope="row">#</td>
                        <td>{{$guru->NIP}}</td>
                        <td>{{$guru->user->username}}</td>
                        <td>{{$guru->nama}}</td>
                        <td>{{strtoupper($guru->jk)}}</td>
                        <td>{{$guru->whatsapp}}</td>
                        <td>{{$guru->alamat}}</td>
                        <td>{{$guru->tanggal_lahir}}</td>

                        <td>
                            <form method="post" action="{{route('guru.destroy', $guru->id)}}">
                                @csrf
                                @method('delete')
                                <a href="{{route('guru.edit', $guru->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda ingin melanjutkan penghapusan ?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$gurus->links()}}
    </div>
    <div class="panel-footer">

    </div>
</div>
@endsection
