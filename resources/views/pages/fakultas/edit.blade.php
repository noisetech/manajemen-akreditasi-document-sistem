@extends('layouts.be')

@section('title', 'Fakultas')


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
                <h3>Fakultas</h3>
                <p class="text-subtitle text-muted">Tambah Fakultas</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Fakultas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">

    <a href="{{ route('fakultas') }}" class="btn btn-sm btn-primary mb-3">
        Kembali
    </a>
    <div class="card shadow">

        <div class="card-body">
            <form action="{{ route('fakultas.update', $fakultas->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="">Fakultas:</label>
                    <input type="text" name="fakultas" class="form-control" value="{{ $fakultas->name }}">
                </div>

                <div class="form-group">
                    <label for="">Status:</label>
                    <select name="status_aktif" class="form-control">
                        <option value="">--Pilih--</option>
                        <option value="aktif" {{ $fakultas->status_aktif == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ $fakultas->status_aktif == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <button class="btn btn-sm btn-primary" type="submit">
                    Simpan
                </button>
            </form>
        </div>
    </div>



</div>



@endsection
