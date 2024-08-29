@extends('layouts.main',['title'=>'Profile'])
@section('content')
<x-content :title="[
 'name'=>'Profile',
 'icon'=>'fas fa-user'
]">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('profile.update') }}" method="POST" class="card card-primary">
                <div class="card-header p-1"></div>
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
                        <label>Password Baru</label>
                        <x-input name="password" type="password" />
                    </x-group>
                    <x-group>
                        <label>Konfirmasi Password Baru</label>
                        <x-input name="password_confirmation" type="password" />
                    </x-group>
                </div>
                <div class="card-footer">
                    <x-btn-update />
                    <x-btn-back href="{{ route('profile.index') }}" />
                </div>
            </form>
        </div>
    </div>
</x-content>
@endsection