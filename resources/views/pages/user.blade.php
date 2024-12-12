<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel - Basic</title>
    <link rel="icon" href="{{ asset('assets/dist/img/icon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/dist/img/icon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-5.3.2/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-6.4.2/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('assets/dist/img/icon.png') }}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                    Laravel Basic
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Data User</a>
                        <a class="nav-link" href="#">Data A</a>
                        <a class="nav-link " href="#">Data B</a>
                    </div>
                </div>
            </div>
        </nav>

        @if (session('success'))
            <div class="alert alert-primary alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-4">
            <h3 class="card-header">
                Daftar User
                <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal" data-bs-target="#tambahModal"><i class="fa-solid fa-plus"></i> Tambah User</button>
            </h3>
            <div class="card-body">
                <table id="table-user" class="text-nowrap table-striped table-head-fixed table-hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ date('d-m-Y', strtotime($user->tgl_lahir)) }}</td>
                                <td>{{ $user->jekel }}</td>
                                <td>{{ $user->alamat }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-warning btn-sm btn-ubah" data-bs-toggle="modal" data-bs-target="#ubahModal" data-id_user="{{ $user->id_user }}" data-nama="{{ $user->nama }}" data-tgl_lahir="{{ $user->tgl_lahir }}" data-jekel="{{ $user->jekel }}" data-alamat="{{ $user->alamat }}"><i class="fa-regular fa-pen-to-square"></i> Ubah</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-hapus" data-bs-toggle="modal" data-bs-target="#hapusModal" data-id_user="{{ $user->id_user }}"><i class="fa-regular fa-trash-can"></i> Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <input type="hidden" id="proses" value="{{ old('proses') }}"">

        <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/tambah-user" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            @if ($errors->any() && old('proses') === 'tambah')
                                <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                                    Priksa kembali inputan anda!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <input type="hidden" name="proses" value="tambah">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="form1-1" class="form-label">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="form1-1" name="nama" value="{{ old('nama') }}" placeholder="Isikan Nama Lengkap">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <label for="form1-2" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="form1-2" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                                    @error('tgl_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <label for="form1-3" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select @error('jekel') is-invalid @enderror" id="form1-3" name="jekel" value="{{ old('jekel') }}">
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-laki" {{ old('jekel') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jekel') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jekel')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="form1-4" class="form-label">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="form1-4" name="alamat" placeholder="Isikan Alamat Lengkap">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Batal</button>
                            <button type="reset" class="btn btn-outline-warning"><i class="fa-solid fa-eraser"></i> Reset</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ubahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/ubah-user" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            @if ($errors->any() && old('proses') === 'ubah')
                                <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                                    Priksa kembali inputan anda!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <input type="hidden" name="proses" value="ubah">
                            <input type="hidden" id="form2-id" name="id_user">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="form2-1" class="form-label">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"" id="form2-1" name="nama" value="{{ old('nama') }}" placeholder="Isikan Nama Lengkap">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <label for="form2-2" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"" id="form2-2" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                                    @error('tgl_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <label for="form2-3" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select @error('jekel') is-invalid @enderror"" id="form2-3" name="jekel" value="{{ old('jekel') }}">
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    @error('jekel')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="form2-4" class="form-label">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror"" id="form2-4" name="alamat" placeholder="Isikan Alamat Lengkap">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Batal</button>
                            <button type="reset" class="btn btn-outline-warning"><i class="fa-solid fa-eraser"></i> Reset</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="hapusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/hapus-user" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" id="form3-id" name="id_user">
                            <p class="pt-3 text-center">Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Tidak</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i> Ya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/bootstrap-5.3.2/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/userjs.js') }}"></script>
</body>

</html>
