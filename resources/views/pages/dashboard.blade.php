@extends('layouts.be')

@section('title', 'Dashboard')


@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>


<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body py-4 px-5">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    <img src="{{ asset('be/dist/assets/images/faces/1.jpg') }}" alt="Face 1">
                                </div>
                                <div class="ms-3 name">
                                    <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                                    <h6 class="text-muted mb-0">Selamat Datang..</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="card shadow">
        <div class="card-body">
            <h6>Selamat Datang di Sistem Informasi Akreditas Fakultas Universitas Yarsi Indonesia</h6>
            <p>
                Sistem Informasi Akreditas Fakultas Universitas Yarsi Indonesia merupakan sebuah sistem informasi yang digunakan untuk mengelola data-data akreditas fakultas Universitas Yarsi Indonesia.
            </p>
        </div>
    </div>
</div>

@endsection
