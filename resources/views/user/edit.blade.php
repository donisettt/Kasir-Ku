@extends('layouts.main',['title'=>'User'])
@section('content')
<x-content :title="[
 'name'=>'User',
 'icon'=>'fas fa-users'
]">
    <div class="row">
        <div class="col-md-6">
            <form class="card card-primary" action="{{ route('user.update',['user'=>$row->id]) }}" method="POST">
                <div class="card-header">
                    <h5 class="card-title">Ubah User</h5>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <x-group>
                        <label>Nama Lengkap</label>
                        <x-input name="nama" :value="$row->nama" />
                    </x-group>
                    <x-group>
                        <label>Username</label>
                        <x-input name="username" :value="$row->username" />
                    </x-group>
                    <x-group>
                        <label>Role</label>
                        <x-select name="role" :value="$row->role" :data-option="[
                            ['value'=>'','option'=>'Pilih'],
                            ['value'=>'kasir','option'=>'Kasir'],
                            ['value'=>'manajer','option'=>'Manajer'],
                            ]" />
                    </x-group>
                    <x-group>
                        <label>Password Baru</label>
                        <x-input name="password" type="password" />
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