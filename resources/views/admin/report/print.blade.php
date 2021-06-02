<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    {{-- <title>Cetak Laporan {{$paymentData->payment_code}} || {{$paymentData->student}}</title> --}}
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap/bootstrap.min.css')}}">
    {{-- <link rel="stylesheet" href="/modules/fontawesome/css/all.min.css"> --}}

    <!-- Template CSS -->
    {{--
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/components.css"> --}}
    <style>
        .no-print {
            display: none !important;
        }

        .borderless td,
        .borderless th {
            border: none;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }

    </style>
</head>

<body onload="window.print();">
    {{-- <body> --}}
    <div class="container-fluid">
        <div class="card card-body border-0 px-0">
            <div class="row">
                <div class="col-12">
                    <div class="h3 text-center">Absensi</div>
                </div>
            </div>
            <hr class="mb-0">
            {{-- <div class="float-right text-right">{{$paymentData->now_date}}
        </div> --}}
        <div class="mt-2">
            <div class="h5 text-center">Riwayat Absensi</div>
        </div>
        <div class="row mt-1">
            <div class="col-12">
                {{-- <div class="row">
                    <div class="col-6">
                        <table class="table borderless">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold p-0">Kode Pembayaran</td>
                                    <td class="p-0">: {{$paymentData->payment_code}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold p-0">Tanggal</td>
                    <td class="p-0">: {{$paymentData->payment_date}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold p-0">Kelas</td>
                    <td class="p-0">: {{$paymentData->class}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold p-0">NISN</td>
                    <td class="p-0">: {{$paymentData->nisn}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold p-0">Nama Siswa</td>
                    <td class="p-0">: {{$paymentData->student}}</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td class="font-weight-bold p-0">Petugas Pembayaran</td>
                    <td class="p-0">: {{$paymentData->officer}}</td>
                </tr>
                </tbody>
                </table>
            </div>
        </div> --}}

        <div class="mt-5">
            <table class="table table-striped table-hover">
                <thead class="thead-inverse">
                    <th>No</th>
                    <th>Siswa | NISN</th>
                    <th>Jadwal</th>
                    <th>Kelas</th>
                    <th>Waktu</th>
                    <th>Tanggal</th>
                    <th>Lokasi Absen (Lat | Long)</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    {{-- <th>Aksi</th> --}}
                </thead>
                <tbody>
                    @foreach($absents as $i => $absent)
                    <tr>
                        <td scope="row">{{++$i}}</td>
                        <td>{{$absent->student->nama}} | {{ $absent->student->NISN }}</td>
                        <td>{{ $absent->schedule->teacher_mapel->mapel->nama }}</td>
                        <td>{{ $absent->schedule->class->nama }}</td>
                        <td>{{ $absent->waktu }}</td>
                        <td>{{ $absent->created_at->format('d-m-Y') }}</td>
                        <td>
                            {{json_decode($absent->lokasi)->lat}} | {{json_decode($absent->lokasi)->long}}
                            {{-- <a class="btn btn-sm btn-success" target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ json_decode($absent->lokasi)->lat }},{{ json_decode($absent->lokasi)->long }}">Cek Lokasi</a> --}}
                        </td>
                        <td>{{ $absent->keterangan ?? '-' }}</td>
                        <td>{{ $absent->keterangan ?? '-' }}</td>
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
    </div>
    </div>
    </div>
    </div>
</body>

</html>
