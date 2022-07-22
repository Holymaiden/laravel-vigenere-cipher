<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Pemilihan Calon Ketua Osis SMAN 2 Bone</h4>
            </div>
            <div class="card-body">
                <div class="row mt-4">
                    <div class="col-12 col-lg-8 offset-lg-2">
                        <div class="wizard-steps">
                            <div class="wizard-step {{ $currentStep == 1 ? 'wizard-step-active' : '' }}">
                                <div class="wizard-step-icon">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Candidate
                                </div>
                            </div>
                            <div class="wizard-step {{ $currentStep == 2 ? 'wizard-step-active' : '' }}">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Hope
                                </div>
                            </div>
                            <div class="wizard-step {{ $currentStep == 3 ? 'wizard-step-active' : '' }}">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-flag"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Finish
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form class="wizard-content mt-2">
                    <div class="wizard-pane {{ $currentStep != 1 ? 'd-none' : '' }}" id="step-1">

                        @error('student_id') <div class="alert alert-danger">Anda Harus Memilih Kandidat</div>@enderror<br />
                        @foreach($data as $v)
                        <div class="form-group row align-items-center">
                            <div class="col-6 col-sm-4 ">
                                <label class="imagecheck mb-4">
                                    <input wire:model="student_id" name="student_id" type="radio" value="{{ $v->id }}" class="imagecheck-input" />
                                    <figure class="imagecheck-figure">
                                        <img src="{{ url('public/uploads/candidates') }}/{{$v->image}}" alt="}" class="imagecheck-image">
                                    </figure>
                                </label>
                                <label class="imagecheck-label">
                                    Nama : {{ $v->student->name }}<br />
                                    Kelas : {{ $v->student->class->name }}<br />
                                    Visi : "{{ $v->vision }}"<br />
                                    Misi : "{{ $v->mission }}"<br />
                                </label>
                            </div>
                        </div>
                        @endforeach
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-lg-4 col-md-6 text-right">
                                <button type="button" wire:click="firstStepSubmit" class="btn nextBtn  btn-icon icon-right btn-primary">Next <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="wizard-pane {{ $currentStep != 2 ? 'd-none' : '' }}" id="step-2">
                        @error('harapan') <div class="alert alert-danger">Anda Harus Mengisi Harapan</div>@enderror<br />
                        <div class="form-group row align-items-center">
                            <label class="col-md-2 text-md-right text-left">Harapan</label>
                            <div class="col-lg-8 ">
                                <textarea wire:model="harapan" name="harapan" class="form-control" style="height: 166px;"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-6 text-left">
                                <a href="#" wire:click="back(1)" class="btn btn-icon icon-left btn-primary"><i class="fas fa-arrow-left"> Back</i></a>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-lg-4 col-md-6 text-right">
                                <a href="#" wire:click="secondStepSubmit" class="btn btn-icon icon-right btn-primary">Next <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="wizard-pane {{ $currentStep != 3 ? 'd-none' : '' }}" id="step-3">
                        <div>
                            <label class="col-md-12 text-center my-5">
                                <h3>Apakah Anda Yakin Ingin Memilih Calon Ini?</h3>
                            </label>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-6 text-left">
                                <a href="#" wire:click="back(2)" class="btn btn-icon icon-left btn-primary"><i class="fas fa-arrow-left"> Back</i></a>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-lg-4 col-md-6 text-right">
                                <a href="#" wire:click="submitForm" class="btn btn-icon icon-right btn-primary">Finish <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>