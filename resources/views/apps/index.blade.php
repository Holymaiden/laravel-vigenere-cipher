@extends('apps._layouts.index')

@push('cssScript')
@include('apps._layouts.css.css')
@endpush

@section('content')
@if (Helper::get_data('votes')->where('student_id',Session::get('user'))->count() == 0)
<livewire:wizard />
@else
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pemilihan</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-success">
                    <h4 class="alert-heading">Selamat!</h4>
                    <p>Anda sudah melakukan pemilihan</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('jsScript')
@include('apps._layouts.js.js')
@endpush
