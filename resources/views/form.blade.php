@extends('layouts.main',['title'=>'Forms'])
@section('content')
<x-content :title="[
 'name'=>'Forms',
 'icon'=>'fas fa-edit'
]">
    <div class="row">
        <div class="col-lg-6">
            <form class="card card-primary" method="POST">
                <div class="card-header">
                    <h5 class="card-title">Example Forms</h5>
                </div>
                <div class="card-body">
                    @csrf
                    <x-group>
                        <label>Nama Lengkap</label>
                        <x-input name="nama" />
                    </x-group>
                    <x-group>
                        <label>Jenis Kelamin</label>
                        <x-select name="jk" :data-option="[
                            ['value'=>'','option'=>'Pilih'],
                            ['value'=>'L','option'=>'Laki-Laki'],
                            ['value'=>'P','option'=>'Perempuan'],
                            ]" />
                    </x-group>
                    <x-group>
                        <label>Alamat</label>
                        <x-textarea name="alamat" />
                    </x-group>
                </div>
                <div class="card-footer">
                    <x-btn-save />
                    <x-btn-update />
                    <x-btn-delete />
                    <x-btn-back href="{{ route('welcome') }}" />
                </div>
            </form>
        </div>
    </div>
</x-content>
@endsection