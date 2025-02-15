@extends('layouts.be')

@section('title', 'Kerja Sama')


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
    <h3>Kerja Sama</h3>
</div>


<a href="{{ route('kerja_sama') }}" class="btn btn-sm btn-primary my-2">
    Kembali
</a>

<div class="page-content">
    <div class="card shadow">

        <div class="card-body">
            <form action="{{ route('kerja-sama.simpan') }}" enctype="multipart/form-data" method="post">
                @csrf


                <div class="form-group">
                    <label for="">Tangal Post:</label>
                    <input type="date" class="form-control" name="tanggal_post">
                </div>

                <div class="form-group">
                    <label>Keterangan:</label>
                    <textarea class="form-control content-visi @error('content_keterangan') is-invalid @enderror" name="content_keterangan" rows="10">{!! old('content_keterangan') !!}</textarea>
                    @error('content_keterangan')
                    <div class="invalid-feedback" style="display: block">
                        {{ $message }}
                    </div>
                    @enderror
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
        selector: "textarea.content-visi",
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
@endpush
