@extends('_partials/master')
@section('title', 'Mapel')
@section('page-head')
<!--Page Title-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="page-title">
    <h1 class="page-header text-overflow">Mapel</h1>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End page title-->

<!--Breadcrumb-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="demo-pli-home"></i></a></li>
    <li class="active">Mapel</li>
</ol>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End breadcrumb-->
@endsection
@section('content')
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Data Mapel</span>
        <a href="{{route('mapel.create')}}" class="btn btn-primary">Tambah</a>
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
                    <th>Mapel</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($mapels as $mapel)
                    <tr>
                        <td scope="row">#</td>
                        <td>{{$mapel->nama}}</td>

                        <td>
                            <form method="post" action="{{route('mapel.destroy', $mapel->id)}}">
                                @csrf
                                @method('delete')
                                <a href="{{route('mapel.edit', $mapel->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Jika Anda menghapus mapel maka akan menghapus data mapel dari guru. Apakah Anda ingin melanjutkan penghapusan ?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$mapels->links()}}
    </div>
    <div class="panel-footer">

    </div>
</div>
@endsection
