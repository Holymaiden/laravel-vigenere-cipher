<div class="modal fade" id="ajaxModel" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="formInput" name="formInput" action="">
                @csrf
                <input type="hidden" name="id" id="formId">
                <input type="hidden" id="_method" name="_method" value="">
                <div class="modal-header">
                    <h5 class="modal-title"> <label id="headForm"></label> {{ Helper::head($title) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>President</label>
                            <select name="student_id" id="student_id" class="form-control select2">
                                <option value="">-- Select President --</option>
                                @foreach (Helper::get_data('students') as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Vice</label>
                            <select name="student_vice_id" id="student_vice_id" class="form-control select2">
                                <option value="">-- Select Vice --</option>
                                @foreach (Helper::get_data('students') as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Vision</label>
                            <textarea class="form-control" name="vision" id="vision" required></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Mission</label>
                            <textarea class="form-control" name="mission" id="mission" required></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image" id="image" required />
                            <input type="hidden" name="image_old" id="image_old" />
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
        $('#_method').val('POST');
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
                $('#_method').val('PUT');
                $('#saveBtn').hide();
                $('#updateBtn').show();
                $('#formId').val(data.id);
                $('#student_id').val(data.student_id).trigger('change');
                $('#student_vice_id').val(data.student_vice_id).trigger('change');
                $('#vision').val(data.vision);
                $('#mission').val(data.mission);
                $('#image_old').val(data.image);
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
