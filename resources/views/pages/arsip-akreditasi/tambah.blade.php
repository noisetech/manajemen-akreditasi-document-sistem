@extends('layouts.be')

@section('title', 'Manajemen Akreditasi')


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
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Akreditasi</h3>
                <p class="text-subtitle text-muted">Tambah Akreditasi</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Akreditasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">

    <a href="{{ route('arsip_akreditasi') }}" class="btn btn-sm btn-primary mb-2">
        Kembali
    </a>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('arsip-akreditasi.simpan') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Fakultas:</label>
                            <select name="fakultas" class="form-control">
                                <option value="">--Pilih Fakultas--</option>
                                @foreach ($fakultas as $f )
                                <option value="{{ $f->id }}">{{ $f->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Sumber Data:</label>
                            <input type="text" name="sumber_data" class="form-control">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Jenis:</label>
                            <input type="text" name="jenis" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">No Urutan:</label>
                            <input type="text" name="no_urutan" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">No Butir:</label>
                            <input type="text" name="no_butir" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Bobot:</label>
                            <input type="text" name="bobot" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Elemen LAM:</label>
                            <input type="text" name="elemen_penilaian_lam" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Deskriptior:</label>
                    <textarea name="deskripsi" class="form-control deskriptor"></textarea>
                </div>

                <div class="form-group">
                    <label for="">Penilaian:</label>
                    <textarea name="penilaian" id="" class="form-control nilai"></textarea>
                </div>

                <div class="form-group">
                    <label for="">File Pendukung:</label>
                    <input type="file" name="file_pendukung" class="form-control" id="file_pendukung" accept="application/pdf">
                </div>
                <div id="pdf-preview" class="mt-3" style="display: none;">
                    <iframe id="pdf-viewer" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                </div>

                <button class="btn btn-sm btn-primary" type="submit">
                    Simpan
                </button>
            </form>
        </div>
    </div>


</div>



@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: "textarea.deskriptor",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image media",
        relative_urls: false,
    });

    tinymce.init({
        selector: "textarea.nilai",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image media",
        relative_urls: false
    });
</script>
<script>
    document.getElementById('file_pendukung').addEventListener('change', function(event) {
        let file = event.target.files[0];

        if (file && file.type === "application/pdf") {
            let fileURL = URL.createObjectURL(file);
            document.getElementById('pdf-viewer').src = fileURL;
            document.getElementById('pdf-preview').style.display = 'block';
        } else {
            document.getElementById('pdf-preview').style.display = 'none';
        }
    });
</script>
@endpush
