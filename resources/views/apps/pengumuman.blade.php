@extends('apps._layouts.index')

@push('cssScript')
@include('apps._layouts.css.css')
@endpush

@section('content')
<div class="card card-danger">
    <div class="card-header">
        <h4 class="text-danger">Pengumuman</h4>
    </div>

    <div class="card-body text-center">
        <div class="alert alert-danger alert-has-icon">
            <div class="alert-icon"><i class="far fa-clock"></i></div>
            <div class="alert-body" style="text-align:center">
                <div class="alert-title" id="dateNow">Tolong Dibaca!</div>
            </div>
        </div>
        <div id="pemenang">
            <div class="mt-4">
                <h2>Pemenangnya Ialah :</h2><br />
            </div>
            <div class="form-group row">
                @foreach($hasils as $i => $v)
                <div class="col-6 col-sm-4 ">
                    <label class="imagecheck mb-4">
                        <input wire:model="student_id" name="student_id" type="radio" value="{{ $v->id }}" class="imagecheck-input" />
                        <figure class="imagecheck-figure">
                            <img src="{{ url('public/uploads/candidates') }}/{{$v->image}}" alt="}" class="imagecheck-image">
                        </figure>
                    </label>
                    <label class="imagecheck-label">
                        Ketua : {{ $v->student->name }} ({{ $v->student->class->name }})<br />
                        Wakil : {{ $v->studentVice->name }} ({{ $v->studentVice->class->name }})<br /><br />
                        <b>Jumlah Suara</b> : {{ $hasil[$i]->count }}<br />
                        <b>Visi :</b> <br />"{{ $v->vision }}"<br /><br />
                        <b>Misi</b> : <br />"{{ $v->mission }}"<br />
                    </label>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('jsScript')
@include('apps._layouts.js.js')
<script>
    let start = '{{$start}}'
    let end = '{{$end}}'
    let before, after, diff;
    let text = '';
    let now;
    const getDate = () => {
        now = moment().tz('Asia/Makassar').valueOf();
        start = moment(start).tz('Asia/Makassar').valueOf();
        end = moment(end).tz('Asia/Makassar').valueOf();

        before = moment().tz('Asia/Makassar').isBefore(moment(start))
        if (before) {
            diff = start - now;
            now = moment.duration(diff, 'milliseconds')
        }

        after = moment().tz('Asia/Makassar').isAfter(moment(end))
        if (after) {
            diff = now - end;
            now = moment.duration(diff, 'milliseconds')
        };

        if (!before && !after)
            return window.location.href = '/pemilihan';
    }

    const setDate = () => {
        text = '';
        if (now.days() > 0)
            text += now.days() + ' Hari '
        if (now.hours() > 0)
            text += now.hours() + ' Jam '
        if (now.minutes() > 0)
            text += now.minutes() + ' Menit '
        if (now.seconds() > 0)
            text += now.seconds() + ' Detik '
        if (before) {
            $('#dateNow').html('Pemilihan akan dimulai dalam ' + text);
            $('#pemenang').hide();
        }

        if (after) {
            $('#dateNow').html('Pemilihan telah selesai ' + text + ' yang lalu');
            $('#pemenang').show();
        }
        hasil
    }

    $(document).ready(function() {
        setInterval(getDate, 1000);
        setInterval(setDate, 1000);
    });
</script>
@endpush
