@extends('_partials/master')
@section('title', 'Absensi')
@section('css')
<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
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
{{-- {{ dd(request()->get('class')) }} --}}
@section('content')
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Absensi Datang</span>
        <!-- <a href="{{route('guru.create')}}" class="btn btn-primary">Tambah</a> -->
    </div>
    <div class="panel-body">
        <form method="get" style="display: flex; width: 150px">
            {{-- <div class="form-group @error('mapels') has-error @enderror">
            </div> --}}
            <select id="select2" class="form-control w-25" onchange="javascript:location.href = this.value;">
                <optgroup label="Kelas">
                    <option value="/absent">-</option>
                    @foreach($kelases as $key => $kelas)
                    <option value="/absent?class={{$kelas->id}}" {{ request()->get('class') == $kelas->id ? 'selected' : ''}}>{{ $kelas->nama }}</option>
                    @endforeach
                </optgroup>
            </select>

            {{-- <input type="submit" class="btn btn-primary" value="Filter" style="margin-left: 10px"> --}}
        </form>

        @if (Session::has('success'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
            <strong>Well done!</strong> {{Session::get('success')}}
        </div>
        @endif

        <div class="table-responsive" style="margin-top: 1rem">
            <table class="table table-striped table-hover">
                <thead class="thead-inverse">
                    <th>#</th>
                    <th>Siswa | NISN</th>
                    <th>Jadwal</th>
                    <th>Kelas</th>
                    <th>Waktu</th>
                    <th>Tanggal</th>
                    <th>Lokasi Absen</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    {{-- <th>Aksi</th> --}}
                </thead>
                <tbody>
                    @foreach($absents as $i => $absent)
                    <tr>
                        <td scope="row">#</td>
                        <td>{{$absent->student->nama}} | {{ $absent->student->NISN }}</td>
                        <td>{{ $absent->schedule->teacher_mapel->mapel->nama }}</td>
                        <td>{{ $absent->schedule->class->nama }}</td>
                        <td>{{ $absent->waktu }}</td>
                        <td>{{ $absent->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a class="btn btn-sm btn-success" target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ json_decode($absent->lokasi)->lat }},{{ json_decode($absent->lokasi)->long }}">Cek Lokasi</a>
                        </td>
                        <td>{{ $absent->keterangan ?? '-' }}</td>
                        <td>
                            <strong>
                                <input type="radio" name="status-{{$i}}" {{ $absent->status === '' || $absent->status === null ? 'checked' : null }} disabled>N/A
                                <input type="radio" name="status-{{$i}}" {{ $absent->status === 's' ? 'checked' : null }} disabled>S
                                <input type="radio" name="status-{{$i}}" {{ $absent->status === 'i' ? 'checked' : null }} disabled>I
                                <input type="radio" name="status-{{$i}}" {{ $absent->status === 'a' ? 'checked' : null }} disabled>A
                            </strong>
                            {{-- {{ $absent->status ?? '-' }} --}}
                        </td>
                        {{-- <td></td> --}}
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

        <form method="post" action="{{route('print')}}">
            @csrf
            <input type="hidden" name="class" value="{{request()->get('class')}}">
            <button type="submit" class="btn btn-dark" {{count($absents) < 1 ? 'disabled' : null}}>Print <i class="ti-printer"></i></button>
        </form>
        {{-- {{$absents->links()}} --}}
    </div>
    <div class="panel-footer">

    </div>
</div>

@endsection
@section('js')
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script>
    $('#select2').select2()

</script>
@endsection
