@extends('layouts.laporan',['title'=>'Laporan Harian'])
@section('content')
<div class="container-fluid">
    <h3 class="text-center mt-2">
        {{ config('app.name') }}
    </h3>
    <p class="text-center">
        <small>
            Jl. Raya Pangandaran Km.1, Desa Padaherang <br>
            Kec. Padaherang - Kab. Pangandaran
        </small>
    </p>
    @php
    $bulan = ['Januari','Februari','Maret',
    'April','Mei','Juni',
    'Juli','Agustus','September',
    'Oktober','November','Desember'];
    @endphp
    <p>
        Judul : Laporan Perbulan <br>
        Bulan : {{ $bulan[(request()->bulan - 1)] }} {{ request()->tahun }}
    </p>
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ( $data as $row )
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ date('d/m/Y', strtotime($row->tanggal)) }}</td>
                <td>{{ number_format($row->jumlah,0,',','.') }}</td>
            </tr>
            @endforeach
        <tfoot>
            <tr class="border-bottom">
                <th colspan="2">Total</th>
                <th>{{ number_format($data->sum('jumlah'),0,',','.') }}</th>
            </tr>
        </tfoot>
        </tbody>
    </table>
</div>
@endsection