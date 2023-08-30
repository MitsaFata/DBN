@extends('index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Barang</h4>
                <p class="card-description">
                    Form Edit Barang
                </p>
                    <form class="forms-sample" method="post" action="{{ route('admin.proses.edit', $barang->id_barang) }}">
                        @csrf
                        <div class="form-group">
                            <label for="id_barang">ID Barang</label>
                            <input value="{{ $barang->id_barang }}" type="text" class="form-control" id="id_barang"
                                name="id_barang" placeholder="ID barang" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama barang</label>
                            <input type="text" class="form-control" id="nama_bar" name="nama_bar"
                                placeholder="Nama barang" value="{{ $barang->nama_bar }}">
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" placeholder="stok"
                                value="{{ $barang->stok }}">
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto" id="foto" class="file-upload-default" accept=".jpg, .jpeg, .png">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Foto">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <input type="reset" class="btn btn-light" value="Reset">
                    </form>
            </div>
        </div>
    </div>
@endsection
