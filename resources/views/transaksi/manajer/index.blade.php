@extends('layouts.main',['title'=>'Transaksi'])
@section('content')
<x-content :title="[
 'name'=>'Transaksi',
 'icon'=>'fas fa-cash-register'
]">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h5 class="card-title">
                        Total Penjualan : Rp {{ number_format($data->sum('total'),0,',','.') }} dari
                        {{ $data->count('id')}} Transaksi
                    </h5>
                </div>
                <div class="col">
                    @include('transaksi.manajer.search')
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <x-table-list>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Kasir</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = $data->firstItem();
                    @endphp
                    @forelse ( $data as $row )
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ date('d/m/Y h:i:s', strtotime($row->created_at)) }}</td>
                        <td>
                            <span class="badge {{ $row->status == 'success' ? 'badge-success' : 'badge-danger' }}">
                                {{ $row->status }}
                            </span>
                        </td>
                        <td>{{ $row->qty_total }}</td>
                        <td>Rp {{ number_format($row->total,0,',','.') }}</td>
                        <td>
                            <a href="{{ route('transaksi.show',['transaksi'=>$row->id]) }}" class="btn btn-sm btn-info">
                                Detail Transaksi
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="7">Data tidak ada.</td>
                    </tr>
                    @endforelse
                </tbody>
            </x-table-list>
        </div>
        <div class="card-footer">
            {{ $data->appends([
                'nama'=>request()->nama,
                'tanggal'=>request()->tanggal,
                'bulan'=>request()->bulan,
                'tahun'=>request()->tahun,
                ])->links('page') }}
        </div>
    </div>
</x-content>
@endsection