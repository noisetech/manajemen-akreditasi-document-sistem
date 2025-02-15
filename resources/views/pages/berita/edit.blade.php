@extends('layouts.be')

@section('title', 'Berita')
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
                <h3>Berita</h3>
                <p class="text-subtitle text-muted">Edit Berita</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Berita</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">

    @if (session('status'))
    <div class="alert alert-success my-3">
        {{ session('status') }}
    </div>
    @endif

    <a href="{{ route('berita') }}" class="btn btn-sm btn-primary mb-3">
        Kembali
    </a>

    <div class="card shadow">

        <div class="card-body">
            <form action="{{ route('berita.update', $berita->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                @method('put')

                <div class="form-group">
                    <label for="">Kategori Berita:</label>
                    <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" id="">
                        <option value="">--Pilih--</option>
                        @foreach ($kategori_berita as $k)
                        <option value="{{ $k->id }}" {{ $berita->kategori_berita_id == $k->id ? 'selected' : '' }}>
                            {{ $k->kategori }}
                        </option>
                        @endforeach
                    </select>
                    @error('kategori')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="">Judul:</label>
                    <input type="text" value="{{ $berita->judul }}" name="judul" class="form-control @error('judul') is-invalid @enderror">
                    @error('judul')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="">Thumbnail:</label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" id="thumbnail" accept="image/*" onchange="previewImage()">
                    @error('thumbnail')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mt-2">
                        <img id="preview" src="{{ $berita->tumbnail ? Storage::url($berita->tumbnail) : '' }}"
                            alt="Preview" style="max-width: 200px; display: {{ $berita->tumbnail ? 'block' : 'none' }}">
                    </div>
                </div>


                <div class="form-group">
                    <label for="">Content:</label>
                    <textarea name="content" class="form-control content @error('content') is-invalid @enderror" id="content">{!! $berita->content !!}</textarea>
                    @error('content')
                    <div class="text-danger">{{ $message }}</div>
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
        selector: "textarea.content",
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
    function previewImage() {
        const image = document.querySelector('#thumbnail');
        const imgPreview = document.querySelector('#preview');

        if (image.files && image.files[0]) {
            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        } else {
            imgPreview.src = "{{ $berita->tumbnail ? Storage::url($berita->tumbnail) : '' }}";
        }
    }
</script>
@endpush
