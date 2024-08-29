@extends('layouts.main',['title'=>'Profile'])
@section('content')
<x-content :title="[
 'name'=>'Profile',
 'icon'=>'fas fa-user'
]">
    <div class="row">
        <div class="col-md-6">
            @if (session('status') == 'edit')
            <x-alert-success type="edit" />
            @endif
            <div class="card card-primary">
                <div class="card-header p-1"></div>
                <div class="card-body">
                    Nama Lengkap : {{ $row->nama }} <br>
                    Username : {{ $row->username }}
                </div>
                <div class="card-footer">
                    <x-btn-edit href="{{ route('profile.edit') }}" />
                </div>
            </div>
        </div>
    </div>
</x-content>
@endsection