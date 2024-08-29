@extends('layouts.main',['title'=>'Table List'])
@section('content')
<x-content :title="[
 'name'=>'Table List',
 'icon'=>'fas fa-list'
]">
    <x-alert-success />
    <x-alert-success type="edit" />
    <x-alert-success type="delete" />
    <div class="card">
        <div class="card-header">
            <x-btn-add />
        </div>
        <div class="card-body p-0">
            <x-table-list>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>P/L</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Dodo Sidodo</td>
                        <td>L</td>
                        <td>
                            <x-btn-act-show />
                            <x-btn-act-edit />
                            <x-btn-act-delete data-url="{{ route('list.delete',['list'=>'1']) }}" />
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Alexandrian</td>
                        <td>P</td>
                        <td>
                            <x-btn-act-show />
                            <x-btn-act-edit />
                            <x-btn-act-delete data-url="{{ route('list.delete',['list'=>'2']) }}" />
                        </td>
                    </tr>
                </tbody>
            </x-table-list>
        </div>
    </div>
</x-content>
@endsection
@push('modal')
<x-modal-delete />
@endpush