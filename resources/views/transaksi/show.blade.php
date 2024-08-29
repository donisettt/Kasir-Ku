@extends('layouts.main',['title'=>'Transaksi'])
@section('content')
<x-content :title="[
 'name'=>'Transaksi',
 'icon'=>'fas fa-cash-register'
]">
    @if (session('status')=='edit')
    <x-alert-success type="edit" />
    @endif
    <div class="card">
        <div class="card-header">
            <a href="{{ route('transaksi.cetak',['transaksi'=>$transaksi->id]) }}" class="btn btn-primary float-right"
                target="_blank">
                <i class="fas fa-print mr-2"></i>Cetak
            </a>
            <div class="row">
                <div class="col">
                    Kode : {{ $transaksi->kode }} <br>
                    Tanggal : {{ date('d F Y H:i:s', strtotime($transaksi->created_at)) }} <br>
                    Kasir : {{ $kasir->nama }}
                </div>
                <div class="col">
                    Sub Total : Rp {{ number_format($transaksi->sub_total,0,',','.') }} <br>
                    Pajak PPN(10%) : Rp {{ number_format($transaksi->pajak,0,',','.') }} <br>
                    Total : Rp {{ number_format($transaksi->total,0,',','.') }} <br>
                    Tunai : Rp {{ number_format($transaksi->tunai,0,',','.') }} <br>
                    Kembalian : Rp {{ number_format($transaksi->kembalian,0,',','.') }} <br>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <x-table-list>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Menu</th>
                        <th>Qty x Harga</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @forelse ( $data as $row )
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            <img src="{{ $row->foto }}" class="img-fluid mr-2 rounded" width="100" align="left" />
                            {{ $row->nama_menu }}
                        </td>
                        <td>{{ $row->qty }} x {{ number_format($row->harga,0,',','.') }}</td>
                        <td>Rp {{ number_format($row->harga * $row->qty,0,',','.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="4">Data tidak ada.</td>
                    </tr>
                    @endforelse
                </tbody>
            </x-table-list>
        </div>
        <div class="card-footer">
            <x-btn-back :href="route('transaksi.index')" />
            @if ($transaksi->status == 'success')
            <a href="{{ route('transaksi.status',['transaksi'=>$transaksi->id,'status'=>'cancel']) }}"
                class="btn btn-danger float-right">Batalkan Transaksi</a>
            @else
            <a href="{{ route('transaksi.status',['transaksi'=>$transaksi->id,'status'=>'success']) }}"
                class="btn btn-success float-right">Accept Transaksi</a>
            @endif
        </div>
    </div>
</x-content>
@endsection