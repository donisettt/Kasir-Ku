<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\LogActivity;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'manajer') {
            $data = Transaksi::where('user_id', $user->id)
                ->orderBy('id', 'desc')
                ->paginate(50);
            return view('transaksi.index', [
                'data' => $data
            ]);
        } else {
            $nama = $request->nama;
            $tanggal = $request->tanggal;
            $bulan = $request->bulan;
            $tahun = $request->tahun;
            $data = Transaksi::join('users', 'users.id', 'transaksis.user_id')
                ->select(
                    'transaksis.id as id',
                    'nama',
                    'transaksis.created_at as created_at',
                    'status',
                    'qty_total',
                    'total'
                )
                ->when($nama, function ($q, $nama) {
                    return $q->where('nama', 'like', "%{$nama}%");
                })
                ->when($tanggal, function ($q, $tanggal) {
                    return $q->whereDay('transaksis.created_at', $tanggal);
                })
                ->when($bulan, function ($q, $bulan) {
                    return $q->whereMonth('transaksis.created_at', $bulan);
                })
                ->when($tahun, function ($q, $tahun) {
                    return $q->whereYear('transaksis.created_at', $tahun);
                })
                ->orderBy('transaksis.id', 'desc')
                ->paginate(50);
            return view('transaksi.manajer.index', [
                'data' => $data
            ]);
        }
    }
    public function show(Transaksi $transaksi)
    {
        $kasir = Auth::user();
        $kasir = Auth::user();
        if ($kasir->role == 'manajer') {
            $kasir = User::find($transaksi->user_id);
        }
        $transaksi->kode = date('Ymd') . '0' . $kasir->id . '0' . $transaksi->id;
        $data = TransaksiDetail::join('menus', 'menus.id', 'transaksi_details.menu_id')
            ->where('transaksi_id', $transaksi->id)
            ->select('transaksi_details.id as id', 'nama_menu', 'transaksi_details.harga as harga', 'qty', 'foto')
            ->get();
        $data->map(function ($row) {
            $row->foto = asset("images/{$row->foto}");
            return $row;
        });
        return view('transaksi.show', [
            'transaksi' => $transaksi,
            'data' => $data,
            'kasir' => $kasir
        ]);
    }
    public function status(Transaksi $transaksi, Request $request)
    {
        $request->validate([
            'status' => 'required|in:success,cancel'
        ]);
        $transaksi->update($request->all());
        if ($request->status == 'success') {
            LogActivity::add('mengubah Status Transaksi menjadi Success');
        } else {
            LogActivity::add('mengubah Status Transaksi menjadi Cancel');
        }
        return back()->with('status', 'edit');
    }
    public function cetak(Transaksi $transaksi)
    {
        $kasir = Auth::user();
        if ($kasir->role == 'manajer') {
            $kasir = User::find($transaksi->user_id);
        }
        $transaksi->kode = date('Ymd') . '0' . $kasir->id . '0' . $transaksi->id;
        $data = TransaksiDetail::join('menus', 'menus.id', 'transaksi_details.menu_id')
            ->where('transaksi_id', $transaksi->id)
            ->select('transaksi_details.id as id', 'nama_menu', 'transaksi_details.harga as harga', 'qty')
            ->get();
        return view('transaksi.cetak', [
            'kasir' => $kasir,
            'transaksi' => $transaksi,
            'data' => $data,
        ]);
    }
}