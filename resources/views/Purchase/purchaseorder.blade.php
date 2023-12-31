@extends('index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Purchase Order</h4>
                <p class="card-description">
                    Form Purchase Order
                </p>
                <form class="forms-sample" method="post" action="{{ route('mitra.send.po') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="text" class="form-control" id="tanggal" name="tanggal"
                            placeholder="Nama Pelanggan" value="{{ date('Y-m-d') }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>SPK</label>
                        <input type="file" name="spk" id="spk" class="file-upload-default" accept=".pdf"
                            required>
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload SPK">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>BA</label>
                        <input type="file" name="ba" id="ba" class="file-upload-default" accept=".pdf"
                            required>
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload BA">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <input type="reset" class="btn btn-outline-secondary" value="Reset">&nbsp;
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
