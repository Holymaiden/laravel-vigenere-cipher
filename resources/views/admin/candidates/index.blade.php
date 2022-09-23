@extends('admin._layouts.index')

@push('cssScript')
@include('admin._layouts.css.css-table')
@endpush

@push('candidates')
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

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4></h4>
                        <div class="card-header-form">
                            {!! Helper::btn_create($title) !!}
                        </div>
                    </div>
                    <div class="card-body">

                        @include('_card.filter')

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" width="8%">No</th>
                                        <th scope="col">President</th>
                                        <th scope="col">Vice</th>
                                        <th scope="col">President Class</th>
                                        <th scope="col">Vice Class</th>
                                        <th scope="col">Vision</th>
                                        <th scope="col">Mission</th>
                                        <th scope="col">Image</th>
                                        <th scope="col" width="12%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="datatabel">
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between flex-wrap">
                            <div class="text-center">
                                <div id="contentx"></div>
                            </div>
                            <div class="text-center">
                                <ul class="pagination twbs-pagination">
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@include('admin.'.$title.'._form')

@endsection

@push('jsScript')
@include('admin._layouts.js.js-table')

<script type="text/javascript">
    $(document).ready(function() {
        let urlx = "{{ $title }}";

        $("#pilihan").on('change', function(event) {
            let pilih = $('#pilihan').val();
            if (pilih == '0') {
                $('#option').show();
            } else {
                $('#option').hide();
            }
        });

        loadpage('', "{{ config('constants.PAGINATION') }}");

        var $pagination = $('.twbs-pagination');
        var defaultOpts = {
            totalPages: 1,
            prev: '&#8672;',
            next: '&#8674;',
            first: '&#8676;',
            last: '&#8677;',
        };
        $pagination.twbsPagination(defaultOpts);

        function loaddata(page, cari, jml) {
            $.ajax({
                url: urlx + '/data',
                data: {
                    "page": page,
                    "cari": cari,
                    "jml": jml
                },
                type: "GET",
                datatype: "json",
                success: function(data) {
                    $(".datatabel").html(data.html);
                }
            });
        }

        function loadpage(cari, jml) {
            $.ajax({
                url: urlx + '/data',
                data: {
                    "cari": cari,
                    "jml": jml
                },
                type: "GET",
                datatype: "json",
                success: function(response) {
                    console.log(response);
                    if ($pagination.data("twbs-pagination")) {
                        $pagination.twbsPagination('destroy');
                        $(".datatabel").html('<tr><td colspan="8">Data not found</td></tr>');
                    }
                    $pagination.twbsPagination($.extend({}, defaultOpts, {
                        startPage: 1,
                        totalPages: response.total_page,
                        visiblePages: 8,
                        prev: '&#8672;',
                        next: '&#8674;',
                        first: '&#8676;',
                        last: '&#8677;',
                        onPageClick: function(event, page) {
                            if (page == 1) {
                                var to = 1;
                            } else {
                                var to = page * jml - (jml - 1);
                            }
                            if (page == response.total_page) {
                                var end = response.total_data;
                            } else {
                                var end = page * jml;
                            }
                            $('#contentx').text('Showing ' + to + ' to ' + end +
                                ' of ' + response.total_data + ' entries');
                            loaddata(page, cari, jml);
                        }

                    }));
                }
            });
        }

        // proses simpan
        $('#saveBtn').click(function(e) {
            $('input:checkbox').removeAttr('checked');
            e.preventDefault();
            let formData = new FormData(formInput);
            formData.append('image', image);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: urlx + "/store",
                data: formData,
                type: "POST",
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#formInput').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    loadpage('', "{{ config('constants.PAGINATION') }}");
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
            formData.append('image', image);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: urlx + "/" + id,
                data: formData,
                type: "POST",
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#formInput').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    loadpage('', "{{ config('constants.PAGINATION') }}");
                    iziToast.success({
                        title: 'Successfull.',
                        message: 'Update it data!',
                        position: 'topRight'
                    });
                },
                error: function(data) {
                    $('#formInput').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    loadpage('', "{{ config('constants.PAGINATION') }}");
                    iziToast.error({
                        title: 'Failed.',
                        message: 'Update it data!',
                        position: 'topRight'
                    });
                }
            });
        });

        // proses delete
        $('body').on('click', '.deleteData', function() {
            var id = $(this).data("id");
            swal({
                    title: 'Are you sure?',
                    text: 'You want to delete this data!',
                    icon: 'warning',
                    dangerMode: true,
                    buttons: {
                        confirm: {
                            text: 'Yes, delete it!',
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
                            url: urlx + '/' + id,
                            success: function(data) {
                                loadpage('', "{{ config('constants.PAGINATION') }}")
                                iziToast.success({
                                    title: 'Successfull.',
                                    message: 'Delete it data!',
                                    position: 'topRight',
                                    timeout: 1500
                                });
                            },
                            error: function(data) {
                                iziToast.error({
                                    title: 'Failed,',
                                    message: 'Delete it data!',
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
