<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faktur Pembayaran</title>
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
    }

    .invoice {
        width: 70mm;
    }

    table {
        width: 100%;
    }

    .center {
        text-align: center;
    }

    .right {
        text-align: right;
    }

    hr {
        border-top: 1px solid #8c8b8b;
    }
    </style>
</head>

<body onload="javascript:window.print()">
    <div class="invoice">
        <h3 class="center">{{ config('app.name') }}</h3>
        <p class="center">
            Jl. Raya Padaherang Km.1, Desa Padaherang <br>
            Kec.Padaherang - Kab.Pangandaran
        </p>
        <hr>
        <p>
            Kode Transaksi : {{ $transaksi->kode }} <br>
            Tanggal : {{ date('d/m/Y H:i:s', strtotime($transaksi->created_at)) }} <br>
            Kasir : {{ $kasir->nama }}
        </p>
        <hr>
        <table>
            @foreach ( $data as $row )
            <tr>
                <td>{{ $row->qty }} {{ $row->nama_menu }} x {{ $row->harga }}</td>
                <td class="right">{{ number_format($row->harga * $row->qty,0,',','.') }}</td>
            </tr>
            @endforeach
        </table>
        <hr>
        <p class="right">
            Sub Total : {{ number_format($transaksi->sub_total,0,',','.') }} <br>
            Pajak PPN(10%) : {{ number_format($transaksi->pajak,0,',','.') }} <br>
            Total : {{ number_format($transaksi->total,0,',','.') }} <br>
            Tunai : {{ number_format($transaksi->tunai,0,',','.') }} <br>
            Kembalian : {{ number_format($transaksi->kembalian,0,',','.') }} <br>
        </p>
        <h3 class="center">Terima Kasih</h3>
    </div>
</body>

</html>