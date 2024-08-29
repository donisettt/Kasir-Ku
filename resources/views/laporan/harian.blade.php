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
    <p>
        Judul : Laporan Harian <br>
        Tanggal : {{ date('l, d F Y', strtotime(request()->tanggal)) }} <br>
    </p>
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kasir</th>
                <th>Waktu</th>
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
                <td>{{ $row->nama }}</td>
                <td>{{ date('d/m/Y H:i:s', strtotime($row->created_at)) }}</td>
                <td>{{ number_format($row->total,0,',','.') }}</td>
            </tr>
            @endforeach
        <tfoot>
            <tr class="border-bottom">
                <th colspan="3" class="text-center">Total</th>
                <th>{{ number_format($data->sum('total'),0,',','.') }}</th>
            </tr>
        </tfoot>
        </tbody>
    </table>
</div>
@endsection