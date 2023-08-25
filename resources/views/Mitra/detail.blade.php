@extends('index')
@section('content')
    <!--Info Detail-->
    <div class="row">
        <div class="col-md-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">{{ $mitra->id_mitra }}</p>
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
                                        {{ $mitra->no_telp }}
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
                                        {{ $mitra->alamat }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2">Koordinat</label>:
                                    <div class="col-sm-9">
                                        {{ $mitra->Koordinat }}
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
                        <img src="{{ asset($mitra->logo) }}" alt="image" style="max-width: 100%; max-heigth: 100%;"
                            class="mx-auto">
                    </center>
                </div>
            </div>
        </div>
    </div>
@endsection