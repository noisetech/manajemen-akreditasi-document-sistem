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
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="{{ route('kerja_sama.tambah') }}" class="badge bg-primary tambah text-white">
                    Tambah Kerja Sama
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" style="width: 100%;">
                    <thead>
                        <tr>


                            <th class="text-start">Tanggal Post</th>
                            <th class="text-start">Keteragan</th>

                            <th class="text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kerja_sama as $v )
                        <tr>

                            <td class="text-start">
                                {{ \Carbon\Carbon::parse($v->tanggal_post)->format('d-m-Y') }}
                            </td>

                            <td class="text-start">
                                {!! $v->keterangan !!}
                            </td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('kerja-sama.detail', $v->id) }}" class="badge bg-secondary text-white">
                                        Detail
                                    </a>

                                    <a href="{{ route('kerja_sama.edit', $v->id) }}" class="badge bg-warning mx-1 text-white">
                                        Edit
                                    </a>

                                    <a href="" class="badge bg-danger text-white">
                                        Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Data Kosong</td>
                        </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>



@endsection
