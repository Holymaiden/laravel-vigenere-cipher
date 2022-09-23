<?php

namespace App\Http\Livewire;

use App\Helpers\Helper;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Wizard extends Component
{
    public $currentStep = 1;
    public $successMsg = '';
    public $student_id, $harapan;

    public function render()
    {
        $data = Candidate::all();
        return view('livewire.wizard', compact('data'));
    }

    /**
     * Write code on Method
     */
    public function firstStepSubmit()
    {
        $this->validate([
            'student_id' => 'required',
        ]);

        $this->currentStep = 2;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    /**
     * Write code on Method
     */
    public function secondStepSubmit()
    {
        $this->validate([
            'harapan' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function clearForm()
    {
        $this->student_id = '';
        $this->harapan = '';
    }

    public function submitForm()
    {
        $candidate = Candidate::find($this->student_id);
        Vote::create([
            'student_id' => Session::get('user'),
            'candidate' => Helper::encrypt($candidate->student->name),
            'hope' => Helper::encrypt($this->harapan),
        ]);

        $this->successMsg = 'Pemilihan Berhasil';

        $this->clearForm();

        Session::remove('user');
        redirect()->to('')->with('berhasil', 'Berhasil Melakukan Voting');
    }
}
