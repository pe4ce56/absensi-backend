@extends('_partials/master')
@section('title', 'Absensi')
@section('page-head')
<!--Page Title-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="page-title">
    <h1 class="page-header text-overflow">Absensi</h1>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End page title-->

<!--Breadcrumb-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="demo-pli-home"></i></a></li>
    <li class="active">Absensi</li>
</ol>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--End breadcrumb-->
@endsection
@section('content')
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Absensi Datang</span>
        <!-- <a href="{{route('guru.create')}}" class="btn btn-primary">Tambah</a> -->
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
                    <th>Siswa | NISN</th>
                    <th>Jadwal</th>
                    <th>Kelas</th>
                    <th>Waktu</th>
                    <th>Tanggal</th>
                    <th>Koordinat GMaps</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($absents as $absent)
                    <tr>
                        <td scope="row">#</td>
                        <td>{{$absent->student->nama}} | {{ $absent->student->NISN }}</td>
                        <td>{{ $absent->schedule->teacher_mapel->mapel->nama }}</td>
                        <td>{{ $absent->schedule->class->nama }}</td>
                        <td>{{ $absent->waktu }}</td>
                        <td>{{ $absent->created_at->format('d-m-Y') }}</td>
                        <td>{{ $absent->lokasi }}</td>
                        <td>{{ $absent->keterangan ?? '-' }}</td>
                        <td>{{ $absent->keterangan ?? '-' }}</td>
                        <td></td>
                        {{--<td>
                            <form method="post" action="{{route('absensi.destroy', $absensi->id)}}">
                                @csrf
                                @method('delete')
                                <a href="{{route('absensi.edit', $absensi->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda ingin melanjutkan penghapusan ?');">Delete</button>
                            </form>
                        </td>--}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$absents->links()}}
    </div>
    <div class="panel-footer">

    </div>
</div>

<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Absensi Pulang</span>
        <!-- <a href="{{route('guru.create')}}" class="btn btn-primary">Tambah</a> -->
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
                    <th>Siswa | NISN</th>
                    <th>Jadwal</th>
                    <th>Kelas</th>
                    <th>Waktu</th>
                    <th>Tanggal</th>
                    <th>Koordinat GMaps</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($absents as $absent)
                    <tr>
                        <td scope="row">#</td>
                        <td>{{$absent->student->nama}} | {{ $absent->student->NISN }}</td>
                        <td>{{ $absent->schedule->teacher_mapel->mapel->nama }}</td>
                        <td>{{ $absent->schedule->class->nama }}</td>
                        <td>{{ $absent->waktu }}</td>
                        <td>{{ $absent->created_at->format('d-m-Y') }}</td>
                        <td>{{ $absent->lokasi }}</td>
                        <td>{{ $absent->keterangan ?? '-' }}</td>
                        <td>{{ $absent->keterangan ?? '-' }}</td>
                        <td></td>
                        {{--<td>
                            <form method="post" action="{{route('absensi.destroy', $absensi->id)}}">
                                @csrf
                                @method('delete')
                                <a href="{{route('absensi.edit', $absensi->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda ingin melanjutkan penghapusan ?');">Delete</button>
                            </form>
                        </td>--}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$absents->links()}}
    </div>
    <div class="panel-footer">

    </div>
</div>
@endsection