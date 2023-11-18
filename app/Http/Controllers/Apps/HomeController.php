<?php

namespace App\Http\Controllers\Apps;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $start, $end;

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
        $curretDate = Carbon::now('Asia/Makassar')->format('Y-m-d H:i:s');
        if ($this->start > $curretDate ||  $this->end < $curretDate)
            return redirect()->route('pengumuman');

        if (empty(Session::get('user'))) {
            return redirect()->to('');
        }

        return view('apps.index');
    }

    public function login()
    {
        if (!empty(Session::get('user'))) {
            return redirect()->to('pemilihan');
        }

        return view('apps.auth.index');
    }

    public function logout()
    {
        Session::remove('user');
        return redirect()->to('');
    }

    public function userLogin(Request $request)
    {
        $curretDate = Carbon::now()->format('Y-m-d H:m:s');

        $user = Student::where('nis', $request->nis)->where('nisn', $request->nisn)->first();
        if (!$user) {
            return redirect()->to('')->with('success', 'Siswa Tidak Ditemukan');
        }

        Session::put('user', $user->id);
        return redirect()->to('pemilihan');
    }

    public function pendaftaran()
    {
        $curretDate = Carbon::now('Asia/Makassar')->format('Y-m-d H:i:s');
        if ($this->start < $curretDate)
            return redirect()->to('')->with('success', 'Pendafataran Sudah Ditutup');
        return view('apps.pendaftaran');
    }
}
