@extends('apps._layouts.index')

@push('cssScript')
@include('apps._layouts.css.css')
@endpush

@section('content')
<div class="card card-danger">
        <div class="card-header">
                <h4 class="text-danger">Pengumuman</h4>
        </div>

        <div class="card-body">
                <div class="alert alert-danger alert-has-icon">
                        <div class="alert-icon"><i class="far fa-clock"></i></div>
                        <div class="alert-body" style="text-align:center">
                                <div class="alert-title" id="dateNow">Tolong Dibaca!</div>
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
                }

                if (after)
                        $('#dateNow').html('Pemilihan telah selesai ' + text + ' yang lalu');
        }

        $(document).ready(function() {
                setInterval(getDate, 1000);
                setInterval(setDate, 1000);
        });
</script>
@endpush