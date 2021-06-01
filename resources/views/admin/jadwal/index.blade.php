@extends('_partials/master')
@section('title', 'Jadwal')
@section('page-head')
<!--Page Title-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="page-title">
    <h1 class="page-header text-overflow">Jadwal</h1>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End page title-->


<!--Breadcrumb-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="demo-pli-home"></i></a></li>
    <li class="active">Jadwal</li>
</ol>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End breadcrumb-->
@endsection
@section('content')
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Data Jadwal</span>
        <a href="{{route('jadwal.create')}}" class="btn btn-primary">Tambah</a>
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
                    <th>Guru</th>
                    <th>Mapel</th>
                    <th>Waktu</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($jadwals as $jadwal)
                    <tr>
                        <td scope="row">#</td>
                        <td>{{$jadwal->teacher_mapel->teacher->nama}}</td>
                        <td>{{$jadwal->teacher_mapel->mapel->nama}}</td>
                        @php
                        $day = $jadwal->hari;
                        switch($day){
                        case 0 : $day = 'minggu';
                        break;
                        case 1 : $day = 'senin';
                        break;
                        case 2 : $day = 'selasa';
                        break;
                        case 3 : $day = 'rabu';
                        break;
                        case 4 : $day = 'kamis';
                        break;
                        case 5 : $day = 'jumat';
                        break;
                        case 6 : $day = 'sabtu';
                        break;
                        default : null;
                        break;
                        }

                        $waktu = ucfirst($day)." | ".$jadwal->waktu;
                        @endphp
                        <td>{{$waktu}}</td>
                        <td>{{$jadwal->class->nama}}</td>

                        <td>
                            <form method="post" action="{{route('jadwal.destroy', $jadwal->id)}}">
                                @csrf
                                @method('delete')
                                <a href="{{route('jadwal.edit', $jadwal->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Menghapus jadwal berarti menghapus seluruh data absensi siswa yang terkait. Apakah Anda ingin melanjutkan penghapusan ?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$jadwals->links()}}
    </div>
    <div class="panel-footer">

    </div>
</div>
@endsection
