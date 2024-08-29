<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogActivity;
use Gate;

class LogActivityController extends Controller
{
    public function index(Request $request)
    {
        $data = Gate::allows('admin') ? $this->all($request) : $this->kasir($request);

        return view('log_activity.index', [
            'data' => $data,
        ]);
    }

    protected function all(Request $request)
    {
        return LogActivity::list($request->nama);
    }

    protected function kasir(Request $request)
    {
        return LogActivity::list($request->nama, ['kasir', 'manajer']);
    }

    public function clear()
    {
        LogActivity::truncate();
        return back()->with('status', 'clear');
    }
}