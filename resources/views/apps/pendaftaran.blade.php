<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Admin</title>
    <!-- Icon -->
    <link rel="icon" href="{{ url('images/logo_footer.png')}}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ url('stisla') }}/node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ url('stisla') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ url('stisla') }}/assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 offset-xl-2 col-xl-8">
                        <div class="login-brand">
                            <img src="{{ url('images/logo_footer.png') }}" alt="logo" width="75" class="shadow-light rounded-circle">
                        </div>
                        @if($message = Session::get('success'))
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @endif
                        @if($message = Session::get('berhasil'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                        @endif
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Pendaftaran Ketua dan Wakil Ketua Osis SMA Negeri 5 Bone</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('candidates.storeUser') }}" class="needs-validation" novalidate="" id="formDaftar">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="kelas_ketua">Kelas Ketua Osis</label>
                                            <select class="form-control selectric" name="kelas_ketua" id="kelas_ketua">
                                                <option value="">Pilih Kelas</option>
                                                @foreach(Helper::get_data('class_students') as $v)
                                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please fill in your Class
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="student_id" class="control-label">Ketua Osis</label>
                                            <select class="form-control selectric" name="student_id" id="student_id">
                                            </select>
                                            <div class="invalid-feedback">
                                                please fill in your Name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="kelas_wakil">Kelas Wakil Ketua Osis</label>
                                            <select class="form-control selectric" name="kelas_wakil" id="kelas_wakil">
                                                <option value="">Pilih Kelas</option>
                                                @foreach(Helper::get_data('class_students') as $v)
                                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please fill in your Class
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="student_vice_id" class="control-label">Wakil Ketua Osis</label>
                                            <select class="form-control selectric" name="student_vice_id" id="student_vice_id">
                                            </select>
                                            <div class="invalid-feedback">
                                                please fill in your Name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="vision">Visi</label>
                                        <textarea class="form-control py-5" name="vision" id="vision" cols="30" rows="10"></textarea>
                                        <div class="invalid-feedback">
                                            Please fill in your visi
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mission">Misi</label>
                                        <textarea class="form-control py-5" name="mission" id="mission" cols="30" rows="10"></textarea>
                                        <div class="invalid-feedback">
                                            Please fill in your misi
                                        </div>
                                    </div>
                                    <!-- Upload File -->
                                    <div class="form-group">
                                        <label for="file">Foto Calon Ketua Dan Wakil Osis</label>
                                        <input type="file" name="image" id="file" class="form-control">
                                        <div class="invalid-feedback">
                                            Please fill in your file
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" id="btnDaftar">
                                            Daftar
                                        </button>
                                    </div>
                                </form>
                                <div class="text-center mt-4 mb-3">
                                    <a href="{{ url('') }}">
                                        <div class="text-job text-primary">Sudah Punya Akun</div>
                                    </a>
                                </div>
                                {{--<div class="row sm-gutters">
                                <div class="col-6">
                                    <a class="btn btn-block btn-social btn-facebook">
                                        <span class="fab fa-facebook"></span> Facebook
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-block btn-social btn-twitter">
                                        <span class="fab fa-twitter"></span> Twitter
                                    </a>
                                </div>
                            </div> --}}

                            </div>
                        </div>
                        {{-- <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Create One</a>
            </div> --}}
                        <div class="simple-footer">
                            Copyright &copy; 2022
                            <a href="{{ url('/') }}" target="_blank">
                                {{ str_replace('_', ' ', config('Fihaa', 'Fihaa')) }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ url('stisla') }}/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ url('stisla') }}/assets/js/scripts.js"></script>
    <script src="{{ url('stisla') }}/assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            $('#kelas_ketua').change(function() {
                var id = $(this).val();
                $('#student_id').empty();
                $.ajax({
                    url: `{{ url('admin/students/class/${id}') }}`,
                    method: "GET",
                    success: function(data) {
                        data.map((v, i) => {
                            $('#student_id').append(`<option value="${v.id}">${v.name[0].toUpperCase() + v.name.substring(1).toLowerCase()}</option>`)
                        })
                    }
                });
            });
            $('#kelas_wakil').change(function() {
                var id = $(this).val();
                $('#student_vice_id').empty();
                $.ajax({
                    url: `{{ url('admin/students/class/${id}') }}`,
                    method: "GET",
                    success: function(data) {
                        data.map((v, i) => {
                            $('#student_vice_id').append(`<option value="${v.id}">${v.name[0].toUpperCase() + v.name.substring(1).toLowerCase()}</option>`)
                        })
                    }
                });
            });
        });
    </script>

    <!-- Page Specific JS File -->
</body>

</html>
