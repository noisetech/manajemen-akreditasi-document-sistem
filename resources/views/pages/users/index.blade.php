@extends('layouts.be')

@section('title', 'Users')


@section('content')


<style>
    table.dataTable th.dt-left,
    table.dataTable td.dt-left {
        text-align: left !important;
    }

    .dt-input {
        margin-right: 10px !important;
    }
</style>

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Users</h3>
                <p class="text-subtitle text-muted">List Users</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="#" class="badge bg-primary tambah text-white">
                    Tambah Akun
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" style="width: 100%;" id="datatable">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th>Email</th>
                            <th>Role</th>


                            <th>Status Akun</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>



    <!-- Modal Tambah-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                </div>
                <div class="modal-body">
                    <form action="#" id="form-simpan" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="">Nama:</label>
                            <input type="text" name="nama" class="form-control">
                            <span id="nama_error" class="text-danger error-text my-2 text-sm">

                            </span>
                        </div>

                        <div class="form-group">
                            <label for="">Email:</label>
                            <input type="text" name="email" class="form-control">
                            <span id="email_error" class="text-danger error-text my-2 text-sm">

                            </span>
                        </div>


                        <div class="form-group">
                            <label for="">Password:</label>
                            <input type="password" name="password" class="form-control">
                            <span id="password_error" class="text-danger error-text my-2 text-sm">

                            </span>
                        </div>

                        <div class="form-group">
                            <label for="">Level Akun:</label>
                            <select name="level_akun" class="form-control" id="level_akun"></select>
                            <span id="level_akun_error" class="text-danger error-text my-2 text-sm">
                            </span>

                        </div>

                        <div class="form-group">
                            <label for="">Fakultas:</label>
                            <select name="fakultas" class="form-control" id="fakultas"></select>
                            <span id="fakultas_error" class="text-danger error-text my-2 text-sm">
                            </span>

                        </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" id="tutupTambah">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Tambah -->


    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Permission</h5>
                </div>
                <div class="modal-body">
                    <form action="#" id="form-update" method="post">
                        @csrf

                        <input type="text" name="id" class="form-control" hidden id="id_permission">

                        <div class="form-group">
                            <label for="">Permission:</label>
                            <input type="text" name="permission" class="form-control" id="permission">
                            <span id="permission_error" class="text-danger error-text my-2 text-sm">

                            </span>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" id="tutupEdit">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Edit -->

</div>



@endsection

@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        new DataTable('#datatable', {
            processing: true,
            searching: true,
            serverSide: true,
            fixedHeader: true,
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            lengthMenu: [
                [10, 20, 25, -1],
                [10, 20, 25, "50"]
            ],

            order: [],
            ajax: {
                url: "{{ route('users.data') }}",
                type: "get",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    'orderable': false,
                    'searchable': false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
                },

                {
                    data: 'status_aktif',
                    name: 'status_aktif'
                },


                {
                    data: 'action',
                    name: 'action'
                },
            ],
            pagingType: "full_numbers",
            lengthMenu: [5, 10, 25, 50],
            columnDefs: [{
                    targets: '_all',
                    className: 'dt-left'
                } // Mengatur semua kolom rata kiri
            ],
            language: {
                paginate: {
                    first: '<i class="bi bi-arrow-90deg-left"></i>',
                    last: '<i class="bi bi-arrow-90deg-right"></i>',
                    next: '<i class="bi bi-arrow-right"></i>',
                    previous: '<i class="bi bi-arrow-left"></i>'
                }
            }
        });
    });

    $('#form-simpan').on('submit', function(e) {

        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/internal/users/simpan',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Berhasil',
                        text: "Data disimpan",
                        icon: 'success',
                        timer: 1000,
                    });
                    $('#form-simpan')[0].reset();
                    $('#exampleModal').modal('hide');
                    // Pastikan selector ini sesuai dengan ID DataTable yang Anda inisialisasi
                    $('#datatable').DataTable().ajax.reload(); // Perbaikan di sini, sesuaikan ID
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Tangkap pesan error dari response JSON
                    let errors = xhr.responseJSON.errors;
                    // console.log(errors);

                    // Iterasi setiap error dan tampilkan pada elemen yang sesuai
                    $.each(errors, function(key, value) {
                        $('#' + key + '_error').text(value[0]); // Ambil pesan error pertama
                    });
                }


            }
        });
    });

    $(document).on('click', '.tambah', () => {
        $('#exampleModal').modal('show');
    });
    $(document).on('click', '#tutupTambah', () => {
        $('#exampleModal').modal('hide');
        $('#form-simpan')[0].reset();
        $('#permission_error').text('');
    });

    $('#exampleModal').on('hidden.bs.modal', function(event) {
        $('#exampleModal').modal('hide');
        $('#form-simpan')[0].reset();
        $('#permission_error').text('');
    })

    $(document).on('click', '#edit', function() {
        $('#modalEdit').modal('show');

        let id = $(this).attr('data-id');


        $.ajax({
            type: "GET",
            url: "/dashboard/permission/getDataById/" + id,
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(respose) {
                $('#id_permission').val(respose.id);
                $('#permission').val(respose.name);

            },
        });
    });

    $('#form-update').on('submit', function(e) {

        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/dashboard/permission/update',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Berhasil',
                        text: "Data diubah",
                        icon: 'success',
                        timer: 1000,
                    });
                    $('#form-update')[0].reset();
                    $('#modalEdit').modal('hide');
                    $('#datatable').DataTable().ajax.reload();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function(key, value) {
                        $('#' + key + '_error').text(value[0]);
                    });
                }


            }
        });
    });

    $('#level_akun').select2({
        dropdownParent: $('#exampleModal'),
        multiple: false,
        width: '100%',
        placeholder: '--Pilih--',
        allowClear: true,
        ajax: {
            url: "/internal/users/listRole",
            dataType: 'json',
            delay: 500,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.text,
                            id: item.id
                        };
                    })
                };
            }
        }
    });


    $('#fakultas').select2({
        dropdownParent: $('#exampleModal'),
        multiple: false,
        width: '100%',
        placeholder: '--Pilih--',
        allowClear: true,
        ajax: {
            url: "/internal/users/listFakultas",
            dataType: 'json',
            delay: 500,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.text,
                            id: item.id
                        };
                    })
                };
            }
        }
    });




    $(document).on('click', '.hapus', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        Swal.fire({
            title: 'Hapus data?',
            text: "Data akan terhapus!",
            icon: 'warning',
            confirmButton: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "/internal/users/hapus",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(respose) {
                        if (respose.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                text: 'Berhasil',
                                title: 'Data dihapus',
                                showConfirmButton: true,
                            });
                            $('#datatable').DataTable().ajax.reload(); // Perbaikan di sini, sesuaikan ID
                        }
                    },
                });
            }
        });
    });
</script>
@endpush
