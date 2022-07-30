<?php

namespace App\Http\Controllers\Apps;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PengumumanController extends Controller
{
    protected string $start, $end;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->start = Helper::getsetting('start');
        $this->end = Helper::getsetting('end');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (empty(Session::get('user'))) {
            return redirect()->to('');
        }
        $start = $this->start;
        $end = $this->end;
        return view('apps.pengumuman', compact('start', 'end'));
    }
}
