@extends('index')
@section('content')
    @php
        use App\Models\Mitra;
    @endphp
    <!--Info Detail-->
    <div class="row">
        @if (auth()->guard('admin')->check())
            <div class="col-lg-12 grid-margin">
                <div class="row">
                    <div class="col-md-12 d-grid gap-2 d-md-flex">
                        <a href="{{ url()->previous() }}" class="btn btn-info">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Profil Mitra ID {{ $mitra->id_mitra }}
                        @if (auth()->guard('mitra')->check())
                            <button class="btn btn-light btn-rounded btn-icon">
                                <a href="{{ route('mitra.edit.form', $mitra->id_mitra) }}">
                                    <i class="ti-pencil"></i>
                                </a>
                            </button>
                        @endif
                    </p>
                    <form class="form-sample">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">Nama Mitra</label>:
                                    <div class="col-sm-9">
                                        {{ $mitra->nama }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">Email</label>:
                                    <div class="col-sm-9">
                                        {{ $mitra->email }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">No. Telp</label>:
                                    <div class="col-sm-9">
                                        +{{ $mitra->no_telp }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">NIK</label>:
                                    <div class="col-sm-9">
                                        {{ $mitra->nik }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">NPWP</label>:
                                    <div class="col-sm-9">
                                        {{ $mitra->npwp }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">Alamat</label>:
                                    <div class="col-sm-9">
                                        @if (Auth::guard('mitra')->check())
                                            @if (Mitra::whereNotNull('jalan')->where(
                                                        'id_mitra',
                                                        auth()->guard('mitra')->user()->id_mitra)->exists())
                                                {{ $mitra->jalan }}, {{ $mitra->kelurahan }}, {{ $mitra->kecamatan }},
                                                {{ $mitra->{'kota/kab'} }}, {{ $mitra->provinsi }}, {{ $mitra->kodepos }}
                                            @endif
                                        @else
                                            @if (Mitra::whereNotNull('jalan')->where('id_mitra', $mitra->id_mitra)->exists())
                                                {{ $mitra->jalan }}, {{ $mitra->kelurahan }}, {{ $mitra->kecamatan }},
                                                {{ $mitra->{'kota/kab'} }}, {{ $mitra->provinsi }}, {{ $mitra->kodepos }}
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">Koordinat</label>:
                                    <div class="col-sm-9">
                                        @if (Auth::guard('mitra')->check())
                                            @if (Mitra::whereNotNull('latitude')->where(
                                                        'id_mitra',
                                                        auth()->guard('mitra')->user()->id_mitra)->exists())
                                                {{ $mitra->latitude }}, {{ $mitra->longitude }} &nbsp;&nbsp;
                                                <a class="btn btn-sm btn-primary"
                                                    href="https://www.google.com/maps?q={{ $mitra->latitude }},{{ $mitra->longitude }}"
                                                    target="_blank">Lihat Lokasi</a>
                                            @endif
                                        @else
                                            @if (Mitra::whereNotNull('latitude')->where('id_mitra', $mitra->id_mitra)->exists())
                                                {{ $mitra->latitude }}, {{ $mitra->longitude }} &nbsp;&nbsp;
                                                <a class="btn btn-sm btn-primary"
                                                    href="https://www.google.com/maps?q={{ $mitra->latitude }},{{ $mitra->longitude }}"
                                                    target="_blank">Lihat Lokasi</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Logo Mitra</p>
                    <center>
                        @if (Auth::guard('mitra')->check())
                            @if (Mitra::whereNotNull('logo')->where(
                                        'id_mitra',
                                        auth()->guard('mitra')->user()->id_mitra)->exists())
                                <img src="{{ asset('logo/' . $mitra->logo) }}" alt="image"
                                    style="width: 300px; heigth: 300px;" class="mx-auto">
                            @else
                                <img src="{{ asset('assets/images/profil.jpg') }}" alt="image"
                                    style="width: 300px; heigth: 300px;" class="mx-auto">
                            @endif
                        @else
                            @if (Mitra::whereNotNull('logo')->where(
                                        'id_mitra',
                                        $mitra->id_mitra)->exists())
                                <img src="{{ asset('logo/' . $mitra->logo) }}" alt="image"
                                    style="width: 300px; heigth: 300px;" class="mx-auto">
                            @else
                                <img src="{{ asset('assets/images/profil.jpg') }}" alt="image"
                                    style="width: 300px; heigth: 300px;" class="mx-auto">
                            @endif
                        @endif
                    </center>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const latitude = urlParams.get('latitude');
            const longitude = urlParams.get('longitude');

            // Menampilkan nilai latitude dan longitude dalam elemen
            document.getElementById("latitude").value = latitude || 'Tidak ada data';
            document.getElementById("longitude").value = longitude || 'Tidak ada data';
        });
    </script>
@endsection
