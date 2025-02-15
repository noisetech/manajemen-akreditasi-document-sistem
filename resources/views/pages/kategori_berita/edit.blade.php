@extends('layouts.be')

@section('title', 'Kategori Berita')


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
                <h3>Kategori Berita</h3>
                <p class="text-subtitle text-muted">Edit Kategori Berita</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kategori Berita</li>
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

    <div class="card shadow">

        <div class="card-body">
            <form action="{{ route('kategori_berita.update', $kategori_berita->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="nama">Kategori:</label>
                    <input type="text" name="kategori" class="form-control  @error('kategori') is-invalid @enderror" value="{{ $kategori_berita->kategori }}">
                    @error('kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
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
