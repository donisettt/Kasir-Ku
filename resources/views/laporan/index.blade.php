@extends('layouts.main',['title'=>'Laporan'])
@section('content')
<x-content :title="[
 'name'=>'Laporan',
 'icon'=>'fas fa-clipboard'
]">
    <div class="row">
        <div class="col-6">
            <form class="card" method="POST" target="_blank" action="{{ route('laporan.harian') }}">
                <div class="card-header">
                    <h5 class="card-title">Laporan Harian</h5>
                </div>
                <div class="card-body">
                    @csrf
                    <x-group>
                        <label>Tanggal</label>
                        <x-input name="tanggal" type="date" />
                    </x-group>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        Buat Laporan
                    </button>
                </div>
            </form>
        </div>
        <div class="col-6">
            <form class="card" method="POST" target="_blank" action="{{ route('laporan.perbulan') }}">
                <div class="card-header">
                    <h5 class="card-title">Laporan Perbulan</h5>
                </div>
                <div class="card-body">
                    @csrf
                    <x-group class="row">
                        <div class="col">
                            @php
                            $data = [
                            ['value'=>'','option'=>'Pilih'],
                            ['value'=>1,'option'=>'Januari'],
                            ['value'=>2,'option'=>'Februari'],
                            ['value'=>3,'option'=>'Maret'],
                            ['value'=>4,'option'=>'April'],
                            ['value'=>5,'option'=>'Mei'],
                            ['value'=>6,'option'=>'Juni'],
                            ['value'=>7,'option'=>'Juli'],
                            ['value'=>8,'option'=>'Agustus'],
                            ['value'=>9,'option'=>'September'],
                            ['value'=>10,'option'=>'Oktober'],
                            ['value'=>11,'option'=>'November'],
                            ['value'=>12,'option'=>'Desember'],
                            ];
                            @endphp
                            <label for="">Bulan</label>
                            <x-select name="bulan" :data-option="$data" />
                        </div>
                        <div class="col">
                            @php
                            $data = [];
                            $data[] = ['value'=>'','option'=>'Pilih'];
                            for ($i=date('Y'); $i>=(date('Y')-10); $i--) {
                            $data[] = ['value'=>$i,'option'=>$i];
                            }
                            @endphp
                            <label>Tahun</label>
                            <x-select name="tahun" :data-option="$data" />
                        </div>
                    </x-group>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        Buat Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-content>
@endsection