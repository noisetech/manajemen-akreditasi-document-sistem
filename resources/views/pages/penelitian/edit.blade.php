@extends('layouts.be')

@section('title', 'Penelitian')


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
    <h3>Penelitian</h3>
</div>



<div class="page-content">



    <a href="{{ route('penelitian') }}" class="btn btn-sm btn-primary mb-2">
        Kembali
    </a>

    <div class="card shadow">

        <div class="card-body">
            <form action="{{ route('penelitian.update', $penelitian->id) }}" method="post">
                @csrf
                @method('PUT')


                <div class="form-group">
                    <label for="">Judul:</label>
                    <input type="text" name="judul" class="form-control" placeholder="Masukan judul" value="{{ $penelitian->judul }}">
                </div>

                <div class="form-group">
                    <label for="">Tanggal Penelitian:</label>
                    <input type="date" name="tanggal_penelitian" class="form-control" value="{{ $penelitian->tanggal_penelitian }}">
                </div>

                <div class="form-group">
                    <label for="">Penulis:</label>
                    <input type="text" id="input-tags" name="penulis" class="form-control" placeholder="Masukan penulis" value="{{ $penelitian->penulis }}">
                </div>

                <div class="form-group">
                    <label for="">Keterangan:</label>

                    <textarea class="form-control content-visi @error('content_misi') is-invalid @enderror" name="keterangan" placeholder="Masukkan Misi" rows="10">{{ old('keterangan', $penelitian->keterangan) }}</textarea>
                    @error('content_misi')
                    <div class="invalid-feedback" style="display: block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

        </div>

        <button class="btn btn-sm btn-primary" type="submit">
            Simpan
        </button>
        </form>
    </div>
</div>


</div>



@endsection


@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.bootstrap2.min.css">
@endpush



@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
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



    $(document).ready(function() {
        $("#input-tags").selectize({
            delimiter: ",",
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input,
                };
            },
        });
    });
</script>
@endpush
