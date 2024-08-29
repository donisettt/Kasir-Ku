@extends('layouts.main',['title'=>'Menu'])
@section('content')
<x-content :title="[
 'name'=>'Menu',
 'icon'=>'fas fa-utensils'
]">
    <div class="row">
        <div class="col-md-6">
            <form class="card card-primary" action="{{ route('menu.store') }}" method="POST"
                enctype="multipart/form-data">
                <div class="card-header">
                    <h5 class="card-title">Tambah Menu</h5>
                </div>
                <div class="card-body">
                    @csrf
                    <x-group>
                        <label>Nama Menu</label>
                        <x-input name="nama_menu" />
                    </x-group>
                    <x-group>
                        <label>Harga</label>
                        <x-input name="harga" type="number" />
                    </x-group>
                    <x-group>
                        <label>File Foto/Gambar</label>
                        <x-input name="file_foto" type="file" />
                    </x-group>
                    <x-group>
                        <label>Kategori</label>
                        <x-select name="kategori" :data-option="[
                            ['value'=>'','option'=>'Pilih'],
                            ['value'=>'makanan','option'=>'Makanan'],
                            ['value'=>'minuman','option'=>'Minuman'],
                            ]" />
                    </x-group>
                </div>
                <div class="card-footer">
                    <x-btn-save />
                </div>
            </form>
        </div>
    </div>
</x-content>
@endsection