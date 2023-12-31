@extends('index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Layanan Baru</h4>
                <p class="card-description">
                    Form Layanan Baru
                </p>
                <form class="forms-sample" method="post" action="{{ route('mitra.tambah.layanan') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Layanan</label>
                        <input type="text" class="form-control" id="nama_lay" name="nama_lay"
                            placeholder="Nama Pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="bandwidth">Bandwidth</label>
                        <input type="text" class="form-control" id="bandwidth" name="bandwidth" placeholder="Bandwidth">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga">
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <input type="reset" class="btn btn-outline-secondary" value="Reset">&nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
