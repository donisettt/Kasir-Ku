<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }
    public function laporanHarian(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date_format:Y-m-d',
        ]);
        $data = Transaksi::join('users', 'users.id', 'transaksis.user_id')
            ->whereDate('transaksis.created_at', $request->tanggal)
            ->select('nama', 'total', 'transaksis.created_at AS created_at')
            ->get();
        return view('laporan.harian', [
            'data' => $data,
        ]);
    }
    public function laporanPerbulan(Request $request)
    {
        $request->validate([
            'bulan' => 'required|numeric|between:1,12',
            'tahun' => 'required|numeric|digits:4'
        ]);
        $data = Transaksi::whereMonth('created_at', $request->bulan)
            ->whereYear('created_at', $request->tahun)
            ->select(
                DB::raw('DATE(created_at) AS tanggal'),
                DB::raw('sum(total) as jumlah')
            )
            ->groupBy('tanggal')
            ->get();
        return view('laporan.perbulan', [
            'data' => $data,
        ]);
    }
}