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
                <p class="text-subtitle text-muted">List Fakultas</p>
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
                <a href="{{ route('fakultas.tambah') }}" class="badge bg-primary tambah text-white">
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
                            <th class="text-start">Status</th>
                            <th class="text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fakultas as $f)
                        <tr>
                            <td class="text-start">{{ $f->name }}</td>
                            <td class="text-start">
                                <span class="badge bg-primary">
                                    {{ $f->status_aktif }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-start">

                                    <a href="{{ route('fakultas.edit', $f->id) }}" class="badge mx-1 bg-warning tambah text-white">
                                        Edit
                                    </a>

                                    <a href="{{ route('fakultas.hapus', $f->id) }}" class="badge bg-danger tambah text-white">
                                        Hapus
                                    </a>
                                </div>
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

            {{ $fakultas->links()}}
        </div>
    </div>



</div>



@endsection
