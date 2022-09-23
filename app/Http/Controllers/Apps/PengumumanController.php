<?php

namespace App\Http\Controllers\Apps;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Student;
use App\Models\Vote;
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
        $hasil = Vote::select('candidate')->selectRaw('COUNT(*) AS count')->groupBy('candidate')->orderByDesc('count')->get();
        $hasils = [];
        foreach ($hasil as $key => $value) {
            $hasils[$key] = Helper::decrypt($value->candidate);
        }
        $hasil2 = Student::whereIn('name', $hasils)->get();
        foreach ($hasil2 as $key => $value) {
            $hasils[$key] = Candidate::where('student_id', $value->id)->first();
        }
        $hasils = array_reverse($hasils);
        return view('apps.pengumuman', compact('start', 'end', 'hasils', 'hasil'));
    }
}
