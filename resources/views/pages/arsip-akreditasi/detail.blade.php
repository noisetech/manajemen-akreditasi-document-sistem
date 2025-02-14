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
                <p class="text-subtitle text-muted">Detail Arsip Akreditasi</p>
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


    <a href="{{ route('arsip_akreditasi') }}" class="btn btn-sm btn-primary mb-3">
        Kembali
    </a>


    @if (session('status'))
    <div class="alert alert-success my-3">
        {{ session('status') }}
    </div>
    @endif
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Fakultas</th>
                        <td>{{ $arsip_akreditasi->fakultas->name }}</td>
                    </tr>
                    <tr>
                        <th>Sumber data</th>
                        <td>{{ $arsip_akreditasi->sumber_data }}</td>
                    </tr>
                    <tr>
                        <th>Jenis</th>
                        <td>{{ $arsip_akreditasi->jenis }}</td>
                    </tr>
                    <tr>
                        <th>No urutan</th>
                        <td>{{ $arsip_akreditasi->no_urutan }}</td>
                    </tr>
                    <tr>
                        <th>No butir</th>
                        <td>{{ $arsip_akreditasi->no_butir }}</td>
                    </tr>

                    <tr>
                        <th>Bobot</th>
                        <td>{{ $arsip_akreditasi->bobot }}</td>
                    </tr>

                    <tr>
                        <th>Deskripsi</th>
                        <td>{!! $arsip_akreditasi->deskripsi !!}</td>
                    </tr>

                    <tr>
                        <th>Elemen Penilaian LAM</th>
                        <td>{!! $arsip_akreditasi->elemen_penilaian_lam !!}</td>
                    </tr>

                    <tr>
                        <th>Penilaian</th>
                        <td>{!! $arsip_akreditasi->penilaian !!}</td>
                    </tr>

                    <tr>
                        <th>Peninjauan Auditor</th>
                        <td>
                            @if ($arsip_akreditasi->peninjauan_auditor == 'pending')
                            <a href="{{ route('arsip-akreditasi.change-status', ['id' => $arsip_akreditasi->id, 'status' => 'approve']) }}"
                                class="badge bg-success text-white">
                                Approve
                            </a>

                            <a href="{{ route('arsip-akreditasi.change-status', ['id' => $arsip_akreditasi->id, 'status' => 'reject']) }}"
                                class="badge bg-danger text-white">
                                Reject
                            </a>
                            @else
                            {{ $arsip_akreditasi->peninjauan_auditor }}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">Dokumen pendukung:</th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div id="pdf-preview" class="mt-3" style="{{ $arsip_akreditasi->file_pendukung ? '' : 'display: none;' }}">
                                <iframe id="pdf-viewer" style="width: 100%; height: 500px;" frameborder="0"
                                    src="{{ $arsip_akreditasi->file_pendukung ? asset('storage/'.$arsip_akreditasi->file_pendukung) : '' }}">
                                </iframe>
                            </div>
                        </td>
                    </tr>


                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    document.getElementById('file_pendukung').addEventListener('change', function(event) {
        let file = event.target.files[0];

        if (file && file.type === "application/pdf") {
            let fileURL = URL.createObjectURL(file);
            document.getElementById('pdf-viewer').src = fileURL;
            document.getElementById('pdf-preview').style.display = 'block';
        } else {
            document.getElementById('pdf-preview').style.display = 'none';
        }
    });
</script>
@endpush
