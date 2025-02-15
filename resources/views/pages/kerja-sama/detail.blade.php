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
<div class="page-content">
    <a href="{{ route('kerja_sama') }}" class="btn btn-sm btn-primary mb-3">
        Kembali
    </a>
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="width: 100%;">
                    <tr>
                        <th>Tanggal Kerja Sama</th>
                        <td>{{ \Carbon\Carbon::parse($kerja_sama->tanggal_kerja_sama)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>{!! $kerja_sama->keterangan !!}</td>
                    </tr>

                    <tr>
                        <th>Patner:</th>
                        <td>
                            <div class="d-flex justify-content-end">
                                <a href="" class="btn btn-sm btn-primary my-3">Tambah</a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" style="width: 100%;">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Logo</th>
                                        <th>Aksi</th>
                                    </tr>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>



@endsection
