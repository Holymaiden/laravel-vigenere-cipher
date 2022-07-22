@extends('apps._layouts.index')

@push('cssScript')
@include('apps._layouts.css.css')
@endpush

@section('content')
<livewire:wizard />
@endsection

@push('jsScript')
@include('apps._layouts.js.js')
@endpush