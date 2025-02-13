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
                <p class="text-subtitle text-muted">List Arsip Akreditasi</p>
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


    @if (session('status'))
    <div class="alert alert-success my-3">
        {{ session('status') }}
    </div>
    @endif

    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="{{ route('arsip_akreditasi.tambah') }}" class="btn btn-sm btn-primary mb-2">
                    Tambah
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" style="width: 100%;" id="datatable">
                    <thead>
                        <tr>

                            <th class="text-start">Fakultas</th>
                            <th class="text-start">Sumber Data</th>
                            <th class="text-start">No Urut</th>
                            <th class="text-start">No Butir</th>
                            <th class="text-start">Elemen Penilian LAM</th>
                            <th class="text-start">Deskriptor</th>
                            <th class="text-center">Penilaian</th>
                            <th class="text-start">Dokumen Pendukung</th>
                            <th class="text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $arsip_akreditasi as $a )
                        <tr>
                            <td class="text-start">{{ $a->fakultas->name }}</td>
                            <td class="text-start">{{ $a->sumber_data }}</td>
                            <td class="text-start">{{ $a->no_urutan }}</td>
                            <td class="text-start">{{ $a->no_butir }}</td>
                            <td class="text-start">{{ $a->elemen_penilaian_lam }}</td>
                            <td class="text-start">{!! $a->deskripsi !!}</td>
                            <td class="text-start">{!! $a->penilaian !!}</td>

                            <td>
                                <div class="d-flex justify-content-start">

                                    <a class="badge bg-primary" href="{{ route('arsip-akreditasi.preview', $a->id) }}" target="_blank">
                                        Preview Dokumen
                                    </a>

                                    <a href="{{ route('arsip-akreditasi.edit', $a->id) }}" class="btn mx-1 btn-sm btn-warning text-white">
                                        Edit
                                    </a>

                                    <a href="{{ route('arsip-akreditasi.hapus', $a->id) }}" class="btn btn-sm btn-danger text-white">
                                        Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Data Kosong</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
