@extends('layouts.main',['title'=>'User'])
@section('content')
<x-content :title="[
 'name'=>'User',
 'icon'=>'fas fa-users'
]">
    @if (session('status')=='save')
    <x-alert-success />
    @endif
    @if (session('status')=='edit')
    <x-alert-success type="edit" />
    @endif
    @if (session('status')=='delete')
    <x-alert-success type="delete" />
    @endif
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <x-btn-add href="{{ route('user.create') }}" />
                </div>
                <div class="col">
                    <x-form-search name="search" />
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <x-table-list>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Role</th>
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
                        <td>{{ $row->username }}</td>
                        <td>{{ ucwords($row->role) }}</td>
                        <td class="text-right">
                            @if ($row->role !== 'admin')
                            <x-btn-act-edit href="{{ route('user.edit',['user'=>$row->id]) }}" />
                            <x-btn-act-delete :data-url="route('user.destroy',['user'=>$row->id])" />
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="5">Data tidak ada.</td>
                    </tr>
                    @endforelse
                </tbody>
            </x-table-list>
        </div>
        <div class="card-footer">
            {{ $data->appends(['search'=>request()->search])->links('page') }}
        </div>
    </div>
</x-content>
@endsection
@push('modal')
<x-modal-delete />
@endpush