@extends('layouts.main',['title'=>'Cart'])
@section('content')
<x-content>
    <div class="row">
        <div class="col">
            <div class="row">
                @foreach ( $data as $row)
                <div class="col-3">
                    <div class="card">
                        <img src="{{ $row->foto }}" class="card-img-top">
                        <div class="card-body" style="height: 75px">
                            <h5 class="card-title">{{ $row->nama_menu }}</h5>
                        </div>
                        <div class="card-footer">
                            Rp. {{ $row->harga }}
                            <a href="{{ route('cart.add',['menu'=>$row->id]) }}"
                                class="btn btn-sm btn-primary float-right">
                                Add
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Transaksi
                </div>
                <div class="card-body p-0" style="min-height: 200px;">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( \Cart::getContent() as $row )
                            <tr>
                                <td>
                                    {{ $row->name }} <br>
                                    {{$row->quantity}} x {{ number_format($row->price,0,',','.')}} <br>
                                </td>
                                <td>
                                    {{ number_format($row->quantity * $row->price,0,',','.') }}
                                </td>
                                <td>
                                    <a href="{{ route('cart.update',['id'=>$row->id,'type'=>'plus']) }}"
                                        class="btn text-primary p-0 mr-1">
                                        <i class="fas fa-plus-square"></i>
                                    </a>
                                    <a href="{{ route('cart.update',['id'=>$row->id,'type'=>'minus']) }}"
                                        class="btn text-primary p-0 mr-1">
                                        <i class="fas fa-minus-square"></i>
                                    </a>
                                    <a href="{{ route('cart.update',['id'=>$row->id,'type'=>'remove']) }}"
                                        class="btn text-danger p-0">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <form class="card-footer" method="POST" action="{{ route('card.store') }}">
                    @php
                    $subtotal = \Cart::getTotal();
                    $pajak = $subtotal * 10 / 100;
                    $total = $subtotal + $pajak;
                    @endphp
                    @csrf
                    <div class="form-group row">
                        <div class="col">Sub Total :</div>
                        <div class="col text-right">{{ number_format($subtotal,0,',','.') }}</div>
                    </div>
                    <div class="form-group row">
                        <div class="col">Pajak PPN (10%) :</div>
                        <div class="col text-right">{{ number_format($pajak,0,',','.') }}</div>
                    </div>
                    <div class="form-group row">
                        <div class="col">Total :</div>
                        <div class="col text-right">{{ number_format($total,0,',','.') }}</div>
                    </div>
                    <div class="form-group row">
                        <div class="col">Cash :</div>
                        <div class="col text-right">
                            <x-input type="number" name="cash" />
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('cart.destroy') }}" class="btn btn-danger">Clear Cart</a>
                        <x-btn-save class="float-right" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-content>
@endsection