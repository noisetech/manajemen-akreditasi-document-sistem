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



    <a href="{{ route('visi_misi') }}" class="btn btn-sm btn-primary mb-3">
        Kembali
    </a>

    <div class="card shadow">

        <div class="card-body">
            <form action="{{ route('visi_misi.simpan') }}" method="post">
                @csrf


                <div class="form-group">
                    <label>Visi:</label>
                    <textarea class="form-control content-visi @error('content_visi') is-invalid @enderror" name="content_visi" placeholder="Masukkan Visi" rows="10">{!! old('content_visi') !!}</textarea>
                    @error('content_visi')
                    <div class="invalid-feedback" style="display: block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Misi:</label>
                    <textarea class="form-control content-misi @error('content_misi') is-invalid @enderror" name="content_misi" placeholder="Masukkan Misi" rows="10">{!! old('content_misi') !!}</textarea>
                    @error('content_misi')
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

    tinymce.init({
        selector: "textarea.content-misi",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image media",
        relative_urls: false
    });
</script>
@endpush
