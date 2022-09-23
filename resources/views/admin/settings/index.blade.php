@extends('admin._layouts.index')

@push('cssScript')
@include('admin._layouts.css.css-table')
@endpush

@push('settings')
active
@endpush

@push($title)
active
@endpush

@section('content')

<section class="section">

    @component('_card.head')
    {{ $title }}
    @endcomponent

    <div class="section-body">

        <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            Change information about your website.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form id="formInput" name="formInput" enctype="multipart/form-data">
                        @csrf
                        <input name="_method" type="hidden" value="POST" id="methodId">
                        <input type="hidden" name="id" id="formId">

                        <div class="card-header">
                            <h4>Profile</h4>
                            <div class="card-header-form">
                                <div class="form-group">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="myCheck" value="">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">edit</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Key Vigenere Ciphere</label>
                                    <input type="text" class="form-control" name="key" value="" placeholder="Ex: Dipa" required="" id="key">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Start Vote</label>
                                    <input type="text" class="form-control datetimepicker" name="start" value="" id="start">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>End Vote</label>
                                    <input type="text" class="form-control datetimepicker" name="end" value="" id="end">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <button type="submit" class="btn btn-danger" id="resetBtn" value="">
                                        Reset Voting
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary" id="updateBtn" value="">
                                Update Changes
                            </button>
                            <button type="submit" class="btn btn-success" id="saveBtn" value="">
                                Save Changes
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>

</section>

@endsection

@push('jsScript')
@include('admin._layouts.js.js-table')

<script type="text/javascript">
    $(document).ready(function() {
        let title = "{{ $title }}";
        getData(title);

        function getData(title) {
            $.ajax({
                url: title + '/data',
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    if (data.id == undefined) {
                        $('#methodId').val('POST');
                    } else {
                        $('#methodId').val('PUT');
                    }
                    console.log(data)
                    $("#myCheck").prop("checked", false);
                    $('#formId').val(data.id);
                    $("#key").val(data.key);
                    $("#start").val(data.start);
                    $("#end").val(data.end);
                    cekDisable();
                },
                error: function() {
                    iziToast.error({
                        title: 'Failed,',
                        message: 'Unable to display data!',
                        position: 'topRight'
                    });
                }
            });
        }

        $("#myCheck").on('change', function(event) {
            let cek = $("#myCheck").val();
            cek == 0 ? cekEnable() : cekDisable();
        });

        function cekDisable() {
            $("#myCheck").val(0);
            $("#key").prop("disabled", true);
            $("#start").prop("disabled", true);
            $("#end").prop("disabled", true);
            $("#saveBtn").hide()
            $("#updateBtn").hide()
            $("#resetBtn").hide()
        }

        function cekEnable() {
            $("#myCheck").val(1);
            $("#key").prop("disabled", false);
            $("#start").prop("disabled", false);
            $("#end").prop("disabled", false);
            $("#resetBtn").show()
            let idData = $("#formId").val();
            idData >= 1 ? $("#updateBtn").show() : $("#saveBtn").show();

        }

        // proses simpan
        $('#saveBtn').click(function(e) {
            $('input:checkbox').removeAttr('checked');
            e.preventDefault();
            let formData = new FormData(formInput);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: title + "/store",
                data: formData,
                type: "POST",
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    getData(title)
                    iziToast.success({
                        title: 'Successfull.',
                        message: 'Create it data!',
                        position: 'topRight'
                    });
                },
                error: function(data) {
                    getData(title)
                    iziToast.error({
                        title: 'Failed.',
                        message: 'Create it data!',
                        position: 'topRight'
                    });
                }
            });
        });

        // proses update
        $('#updateBtn').click(function(e) {
            let id = $('#formId').val();
            e.preventDefault();
            let formData = new FormData(formInput);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: title + "/" + id,
                data: formData,
                type: "POST",
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    getData(title)
                    iziToast.success({
                        title: 'Successfull.',
                        message: 'Update it data!',
                        position: 'topRight'
                    });
                },
                error: function(data) {
                    getData(title)
                    iziToast.error({
                        title: 'Failed.',
                        message: 'Update it data!',
                        position: 'topRight'
                    });
                }
            });
        });

        $('body').on('click', '#resetBtn', function(e) {
            e.preventDefault();
            swal({
                    title: 'Are you sure?',
                    text: 'You want to reset data voting!',
                    icon: 'warning',
                    dangerMode: true,
                    buttons: {
                        confirm: {
                            text: 'Yes, reset it!',
                            className: 'btn btn-success'
                        },
                        cancel: {
                            visible: true,
                            className: 'btn btn-danger'
                        }
                    }
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "DELETE",
                            url: 'votes',
                            success: function(data) {
                                iziToast.success({
                                    title: 'Successfull.',
                                    message: 'Reset it data!',
                                    position: 'topRight',
                                    timeout: 1500
                                });
                            },
                            error: function(data) {
                                iziToast.error({
                                    title: 'Failed,',
                                    message: 'Reset it data!',
                                    position: 'topRight',
                                    timeout: 1500
                                });
                            }
                        });
                    } else {
                        swal.close();
                    }
                });
        });

    });
</script>


@endpush
