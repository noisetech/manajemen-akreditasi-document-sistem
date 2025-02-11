@extends('layouts.be')

@section('title', 'Visi Misi')


@section('content')


<style>
    table.dataTable th.dt-left,
    table.dataTable td.dt-left {
        text-align: start !important;
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
    <h3>Visi Misi</h3>
</div>
<div class="page-content">
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="{{ route('visi_misi.tambah') }}" class="badge bg-primary tambah text-white">
                    Tambah Permission
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" style="width: 100%;">
                    <thead>
                        <tr>

                            <th class="text-center">Visi</th>
                            <th class="text-center">Misi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($visi_misi as $v )
                        <tr>
                            <td>{!! $v->visi !!}</td>
                            <td>{!! $v->misi !!}</td>
                            <td>
                                <a href="{{ route('visi_misi.hapus', $v->id) }}" class="btn btn-sm btn-danger">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Data Kosong</td>
                        </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- Modal Tambah-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Permission</h5>
                </div>
                <div class="modal-body">
                    <form action="#" id="form-simpan" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="">Permission:</label>
                            <input type="text" name="permission" class="form-control">
                            <span id="permission_error" class="text-danger error-text my-2 text-sm">

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

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                url: "{{ route('permission.data') }}",
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
                    data: 'name',
                    name: 'name'
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
            url: '/dashboard/permission/simpan',
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
                    url: "/dashboard/permission/hapus",
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
