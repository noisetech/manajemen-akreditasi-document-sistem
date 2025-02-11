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

    @if (session('status'))
    <div class="alert alert-success my-3">
        {{ session('status') }}
    </div>
    @endif
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="{{ route('penelitian.tambah') }}" class="badge bg-primary tambah text-white">
                    Tambah Penelitian
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-start">Tanggal Penelitian</th>
                            <th class="text-start">Penulis</th>
                            <th class="text-start">Topik</th>
                            <th class="text-start">Keterangan</th>
                            <th class="text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ( $penelitian as $p )
                        <tr>
                            <td class="text-start">{{ \Carbon\Carbon::parse($p->tanggal_penelitian)->format('d-m-Y') }}</td>
                            <td class="text-start">{{ $p->penulis }}</td>
                            <td class="text-start">{{ $p->judul }}</td>
                            <td class="text-start">{!! $p->keterangan !!}</td>
                            <td class="text-start">
                                <a href="{{ route('penelitian.edit', $p->id ) }}" class="btn btn-sm btn-warning text-white">
                                    Edit
                                </a>

                                <a href="{{ route('penelitian.hapus', $p->id) }}" class="btn btn-sm btn-danger">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Data Kosong</td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>



@endsection
