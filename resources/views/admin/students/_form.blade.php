<div class="modal fade" id="ajaxModel" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="formInput" name="formInput" action="">
                @csrf
                <input type="hidden" name="id" id="formId">
                <div class="modal-header">
                    <h5 class="modal-title"> <label id="headForm"></label> {{ Helper::head($title) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>NIS</label>
                            <input type="number" class="form-control" name="nis" id="nis" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>NISN</label>
                            <input type="number" class="form-control" name="nisn" id="nisn" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" id="name" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Jenis Kelamin</label>
                            <select class="form-control selectric" id="jkl" name="jkl" style="width:100%">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Class</label>
                            <select class="form-control selectric" id="class_id" name="class_id" style="width:100%">
                                @foreach (Helper::get_data('class_students') as $v )
                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Hobby</label>
                            <input type="text" class="form-control" name="hobby" id="hobby" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="saveBtn" value="create">Save</button>
                    <button type="submit" class="btn btn-success" id="updateBtn" value="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('jsScriptAjax')
<script type="text/javascript">
    //Tampilkan form input
    function createForm() {
        $('#formInput').trigger("reset");
        $("#headForm").empty();
        $("#headForm").append("Form Input");
        $('#saveBtn').show();
        $('#updateBtn').hide();
        $('#formId').val('');
        $('#ajaxModel').modal('show');
    }

    //Tampilkan form edit
    function editForm(id) {
        let urlx = "{{ $title }}"
        $.ajax({
            url: urlx + '/' + id + '/edit',
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $("#headForm").empty();
                $("#headForm").append("Form Edit");
                $('#formInput').trigger("reset");
                $('#ajaxModel').modal('show');
                $('#saveBtn').hide();
                $('#updateBtn').show();
                $('#formId').val(data.id);
                $('#name').val(data.name);
                $('#nis').val(data.nis);
                $('#nisn').val(data.nisn);
                $('#class').val(data.class).trigger('change');
                $('#jkl').val(data.jkl).trigger('change');
                $('#hobby').val(data.hobby);
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
</script>
@endpush
