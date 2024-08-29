@extends('layouts.main',['title'=>'Menu'])
@section('content')
<x-content :title="[
 'name'=>'Menu',
 'icon'=>'fas fa-utensils'
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
                    <x-btn-add href="{{ route('menu.create') }}" />
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
                        <th>Menu</th>
                        <th>Harga</th>
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
                        <td>
                            <img src="{{ $row->foto }}" class="img-fluid mr-2 rounded" width="120" align="left" />
                            {{ $row->nama_menu }} <br>
                            <small>
                                <span class="text-muted"> Kategori : </span> {{ ucwords($row->kategori) }}
                            </small>
                        </td>
                        <td>Rp {{ number_format($row->harga,0,',','.') }}</td>
                        <td class="text-right">
                            <x-btn-act-edit href="{{ route('menu.edit',['menu'=>$row->id]) }}" />
                            <x-btn-act-delete :data-url="route('menu.destroy',['menu'=>$row->id])" />
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