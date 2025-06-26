@extends('layouts.home')
@section('title', 'Data Tanaman')

@section('css')
    <link href="{{ asset('DataTables/datatables.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/dist/sweetalert2/sweetalert2.min.css') }}" />
@endsection

@section('content')
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <!-- Container utama -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <!-- Card Header -->
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title mb-0">Data Jenis Tanaman</h3>
                            @if (auth()->user()->can('tambah-jenis-tanaman'))
                                <!-- Tombol dengan margin-left auto agar dorong ke kanan -->
                                <button class="btn btn-primary btn-sm ms-auto" onclick="tambahJenisTanaman()">+
                                    Tambah</button>
                            @endif
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="list-data-jenis-tanaman" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="15px">No.</th>
                                        <th>Jenis Tanaman</th>
                                        <th class="text-center" width="150px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan di-load disini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-4">
                        <!-- Card Header -->
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title mb-0">Data Tanaman</h3>
                            @if (auth()->user()->can('tambah-tanaman'))
                                <!-- Tombol dengan margin-left auto agar dorong ke kanan -->
                                <button class="btn btn-primary btn-sm ms-auto" onclick="tambahTanaman()">+ Tambah
                                    Tanaman</button>
                            @endif
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="list-data-tanaman" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="15px">No.</th>
                                        <th>Nama Tanaman</th>
                                        <th>Jenis Tanaman</th>
                                        <th class="text-center" width="150px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan di-load disini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!-- Modal Tambah/Edit Tanaman -->
    <div class="modal fade" id="modalTanaman" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="event.preventDefault(); simpanTanaman();">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTanamanTitle">Tambah Tanaman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama_tanaman" required>
                        </div>
                        <div class="mb-3">
                            <label>Jenis Tanaman</label>
                            <select name="jenis_tanaman" id="jenis_tanaman" class="form-select">
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSimpanTanaman" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah/Edit Jenis Tanaman -->
    <div class="modal fade" id="modalJenisTanaman" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="event.preventDefault(); simpanJenisTanaman();">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalJenisTanamanTitle">Tambah Jenis Tanaman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label>Jenis Tanaman</label>
                            <input type="text" class="form-control" name="jenis_tanaman" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSimpanJenisTanaman" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('DataTables/datatables.js') }}"></script>
    <script src="{{ asset('backend/dist/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        const canEditJenisTanaman = {{ auth()->user()->can('edit-jenis-tanaman') ? 'true' : 'false' }};
        const canDeleteJenisTanaman = {{ auth()->user()->can('hapus-jenis-tanaman') ? 'true' : 'false' }};
        const canEditTanaman = {{ auth()->user()->can('edit-tanaman') ? 'true' : 'false' }};
        const canDeleteTanaman = {{ auth()->user()->can('hapus-tanaman') ? 'true' : 'false' }};
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#modalTanaman').on('show.bs.modal', function() {
                if (mode === 'tambah') {
                    $.getJSON('/get-jenis-tanaman', function(data) {
                        console.log(data);
                        const $select = $('#jenis_tanaman');
                        $select.empty().append(
                            '<option value="" disabled selected>-- Pilih Jenis Tanaman --</option>');
                        data.forEach(item => {
                            $select.append(
                                `<option value="${item.id}">${item.jenis_tanaman}</option>`);
                        });
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.error("Gagal load data:", textStatus, errorThrown);
                    });
                }
            });
        });
    </script>
    {{-- Tanaman --}}
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000
        });

        $(function() {
            $('#list-data-tanaman').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [0, "desc"]
                ],
                ajax: '/list-data-tanaman',
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama_tanaman',
                        name: 'nama_tanaman'
                    },
                    {
                        data: 'jenis_tanaman_jt',
                        name: 'jenis_tanaman_jt'
                    },
                    {
                        render: function(data, type, row) {
                            let buttons = '';

                            if (canEditTanaman) {
                                buttons += `
            <button type="button" onclick="editdata(${row.id})" class="btn btn-sm btn-success">
                <i class="bi bi-pencil-square"></i>
            </button>
        `;
                            }

                            if (canDeleteTanaman) {
                                buttons += `
            <button class="btn btn-sm btn-danger" onclick="hapusdata(${row.id})">
                <i class="bi bi-trash-fill"></i>
            </button>
        `;
                            }

                            return buttons;
                        },
                        "className": 'text-center',
                        "orderable": false,
                        "data": null,
                    },
                ],
                pageLength: 10,
                lengthMenu: [
                    [5, 10, 20],
                    [5, 10, 20]
                ]
            });
        });

        function hapusdata(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/tanaman/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil menghapus data!'
                            });
                            $('#list-data-tanaman').DataTable().ajax.reload(null, false);
                        },
                        error: function() {
                            Toast.fire({
                                icon: 'error',
                                title: 'Gagal menghapus data!'
                            });
                        }
                    });
                }
            });
        }

        let mode = 'tambah'; // Default mode

        function tambahTanaman() {
            mode = 'tambah';
            $('#modalTanamanTitle').text('Tambah Tanaman');
            $('#btnSimpanTanaman').text('Simpan');
            $('#modalTanaman input[name="id"]').val('');
            $('#modalTanaman input[name="nama_tanaman"]').val('');
            $('#modalTanaman select[name="jenis_tanaman"]').val('');
            $('#modalTanaman').modal('show');
        }

        function editdata(id) {
            $.get(`/tanaman/${id}/edit`, function(response) {
                mode = 'edit';
                // Kosongkan value
                $('#modalTanamanTitle').text('Tambah Tanaman');
                $('#btnSimpanTanaman').text('Simpan');
                $('#modalTanaman input[name="id"]').val('');
                $('#modalTanaman input[name="nama_tanaman"]').val('');
                $('#modalTanaman select[name="jenis_tanaman"]').val('');
                // Set data sesuai tabel
                $('#modalTanamanTitle').text('Edit Tanaman');
                $('#btnSimpanTanaman').text('Simpan Perubahan');
                $('#modalTanaman input[name="id"]').val(response.id);
                $('#modalTanaman input[name="nama_tanaman"]').val(response.nama_tanaman);
                $('#modalTanaman select[name="jenis_tanaman"]').val(response.jenis_tanaman);
                $('#modalTanaman').modal('show');
            }).fail(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal mengambil data tanaman!'
                });
            });
        }

        function simpanTanaman() {
            let id = $('#modalTanaman input[name="id"]').val();
            let formData = {
                _token: '{{ csrf_token() }}',
                nama_tanaman: $('#modalTanaman input[name="nama_tanaman"]').val(),
                jenis_tanaman: $('#modalTanaman select[name="jenis_tanaman"]').val(),
            };

            let url = '/tanaman';
            let method = 'POST';

            if (mode === 'edit') {
                formData._method = 'PUT';
                url = `/tanaman/${id}`;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function() {
                    $('#modalTanaman').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: mode === 'edit' ? 'Data berhasil diperbarui!' :
                            'Data berhasil ditambahkan!'
                    });
                    $('#list-data-tanaman').DataTable().ajax.reload(null, false);
                },
                error: function() {
                    Toast.fire({
                        icon: 'error',
                        title: mode === 'edit' ? 'Gagal memperbarui data!' : 'Gagal menambahkan data!'
                    });
                }
            });
        }
    </script>

    {{-- Jenis Tanaman --}}
    <script>
        $(function() {
            $('#list-data-jenis-tanaman').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [0, "desc"]
                ],
                ajax: '/list-data-jenis-tanaman',
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'jenis_tanaman',
                        name: 'jenis_tanaman'
                    },
                    {
                        render: function(data, type, row) {
                            let buttonsJenisTanaman = '';

                            if (canEditJenisTanaman) {
                                buttonsJenisTanaman += `
            <button type="button" onclick="editdatajenisTanaman(${row.id})" class="btn btn-sm btn-success">
                <i class="bi bi-pencil-square"></i>
            </button>
        `;
                            }

                            if (canDeleteJenisTanaman) {
                                buttonsJenisTanaman += `
            <button class="btn btn-sm btn-danger" onclick="hapusdatajenisTanaman(${row.id})">
                <i class="bi bi-trash-fill"></i>
            </button>
        `;
                            }

                            return buttonsJenisTanaman;
                        },
                        "className": 'text-center',
                        "orderable": false,
                        "data": null,
                    },
                ],
                pageLength: 10,
                lengthMenu: [
                    [5, 10, 20],
                    [5, 10, 20]
                ]
            });
        });

        function hapusdatajenisTanaman(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/jenis-tanaman/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil menghapus data!'
                            });
                            $('#list-data-jenis-tanaman').DataTable().ajax.reload(null, false);
                        },
                        error: function() {
                            Toast.fire({
                                icon: 'error',
                                title: 'Gagal menghapus data!'
                            });
                        }
                    });
                }
            });
        }

        let mode_jenis = 'tambah'; // Default mode

        function tambahJenisTanaman() {
            mode_jenis = 'tambah';
            $('#modalJenisTanamanTitle').text('Tambah Jenis Tanaman');
            $('#btnSimpanJenisTanaman').text('Simpan');
            $('#modalJenisTanaman input[name="id"]').val('');
            $('#modalJenisTanaman input[name="jenis_tanaman"]').val('');
            $('#modalJenisTanaman').modal('show');
        }

        function editdatajenisTanaman(id) {
            $.get(`/jenis-tanaman/${id}/edit`, function(response) {
                mode_jenis = 'edit';
                // Kosongkan value
                $('#modalJenisTanamanTitle').text('Tambah Jenis Tanaman');
                $('#btnSimpanJenisTanaman').text('Simpan');
                $('#modalJenisTanaman input[name="id"]').val('');
                $('#modalJenisTanaman input[name="jenis_tanaman"]').val('');
                // Set data sesuai tabel
                $('#modalJenisTanamanTitle').text('Edit Jenis Tanaman');
                $('#btnSimpanJenisTanaman').text('Simpan Perubahan');
                $('#modalJenisTanaman input[name="id"]').val(response.id);
                $('#modalJenisTanaman input[name="jenis_tanaman"]').val(response.jenis_tanaman);
                $('#modalJenisTanaman').modal('show');
            }).fail(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal mengambil data jenis tanaman!'
                });
            });
        }

        function simpanJenisTanaman() {
            let id = $('#modalJenisTanaman input[name="id"]').val();
            let formData = {
                _token: '{{ csrf_token() }}',
                jenis_tanaman: $('#modalJenisTanaman input[name="jenis_tanaman"]').val(),
            };

            let url = '/jenis-tanaman';
            let method = 'POST';

            if (mode_jenis === 'edit') {
                formData._method = 'PUT';
                url = `/jenis-tanaman/${id}`;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function() {
                    $('#modalJenisTanaman').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: mode_jenis === 'edit' ? 'Data berhasil diperbarui!' :
                            'Data berhasil ditambahkan!'
                    });
                    $('#list-data-jenis-tanaman').DataTable().ajax.reload(null, false);
                },
                error: function() {
                    Toast.fire({
                        icon: 'error',
                        title: mode_jenis === 'edit' ? 'Gagal memperbarui data!' :
                            'Gagal menambahkan data!'
                    });
                }
            });
        }
    </script>

@endsection
