@extends('layouts.main',['title'=>'Menu'])
@section('content')
<x-content :title="[
 'name'=>'Menu',
 'icon'=>'fas fa-utensils'
]">
    <div class="row">
        <div class="col-md-6">
            <form class="card card-primary" action="{{ route('menu.update',['menu'=>$row->id]) }}" method="POST"
                enctype="multipart/form-data">
                <div class="card-header">
                    <h5 class="card-title">Ubah Menu</h5>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <x-group>
                        <img src="{{ $row->foto }}" class="img-flud" />
                    </x-group>
                    <x-group>
                        <label>Nama Menu</label>
                        <x-input name="nama_menu" :value="$row->nama_menu" />
                    </x-group>
                    <x-group>
                        <label>Harga</label>
                        <x-input name="harga" type="number" :value="$row->harga" />
                    </x-group>
                    <x-group>
                        <label>Ganti File Foto/Gambar</label>
                        <x-input name="file_foto" type="file" />
                    </x-group>
                    <x-group>
                        <label>Kategori</label>
                        <x-select name="kategori" :value="$row->kategori" :data-option="[
                            ['value'=>'','option'=>'Pilih'],
                            ['value'=>'makanan','option'=>'Makanan'],
                            ['value'=>'minuman','option'=>'Minuman'],
                            ]" />
                    </x-group>
                </div>
                <div class="card-footer">
                    <x-btn-update />
                </div>
            </form>
        </div>
    </div>
</x-content>
@endsection