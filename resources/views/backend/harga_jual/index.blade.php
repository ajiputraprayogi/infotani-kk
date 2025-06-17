@extends('layouts.home')
@section('title', 'Data Harga Jual')

@section('css')
    <link rel="stylesheet" href="{{ asset('select2-boostrap-5/select2.min.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('select2-boostrap-5/select2-bootstrap-5-theme.min.css') }}" />
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
                <div class="col-md-12">
                    <div class="card mb-4">
                        <!-- Card Header -->
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title mb-0">Data Harga Jual</h3>
                            <!-- Tombol dengan margin-left auto agar dorong ke kanan -->
                            <button class="btn btn-primary btn-sm ms-auto" onclick="tambahHargaJual()">+ Tambah Harga
                                Jual</button>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="list-data" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="15px">No.</th>
                                        <th>Tanggal</th>
                                        <th>Nama Tanaman</th>
                                        <th>Harga Jual</th>
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
    <!-- Modal Tambah/Edit Harga Jual -->
    <div class="modal fade" id="modalHargaJual" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="event.preventDefault(); simpanHargaJual();">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalHargaJualTitle">Tambah Harga Jual</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="{{ now()->format('Y-m-d') }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label>Nama Tanaman</label>
                            <select name="nama_tanaman" id="nama_tanaman" class="form-select" required>
                                <option value="" disabled selected>Pilih Nama Tanaman</option>
                                @foreach ($tanaman as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_tanaman }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Harga Jual (Kg)</label>
                            <input type="number" class="form-control" name="harga_jual" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSimpanHargaJual" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('select2-boostrap-5/select2.full.min.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.js') }}"></script>
    <script src="{{ asset('backend/dist/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000
        });

        $(function() {
            $('#list-data').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [0, "desc"]
                ],
                ajax: '/list-data-harga-jual',
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'nama_tanaman_t',
                        name: 'nama_tanaman_t',
                    },
                    {
                        data: 'harga_jual',
                        name: 'harga_jual'
                    },
                    {
                        render: function(data, type, row) {
                            return `
                            <button type="button" onclick="editdata(${row.id})" class="btn btn-sm btn-success">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="hapusdata(${row.id})">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        `;
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
                        url: `/harga-jual/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil menghapus data!'
                            });
                            $('#list-data').DataTable().ajax.reload(null, false);
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

        function tambahHargaJual() {
            mode = 'tambah';
            $('#modalHargaJualTitle').text('Tambah Harga Jual');
            $('#btnSimpanHargaJual').text('Simpan');
            $('#modalHargaJual input[name="id"]').val('');
            $('#modalHargaJual input[name="tanggal"]').val();
            $('#modalHargaJual select[name="nama_tanaman"]').val('').trigger('change');
            $('#modalHargaJual input[name="harga_jual"]').val('');
            $('#modalHargaJual').modal('show');
        }

        function editdata(id) {
            $.get(`/harga-jual/${id}/edit`, function(response) {
                mode = 'edit';
                $('#modalHargaJualTitle').text('Edit Harga Jual');
                $('#btnSimpanHargaJual').text('Simpan Perubahan');
                $('#modalHargaJual input[name="id"]').val(response.id);
                $('#modalHargaJual select[name="nama_tanaman"]').val(response.nama_tanaman).trigger('change');
                $('#modalHargaJual input[name="harga_jual"]').val(response.harga_jual);
                $('#modalHargaJual').modal('show');
            }).fail(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal mengambil data permissions!'
                });
            });
        }

        function simpanHargaJual() {
            let id = $('#modalHargaJual input[name="id"]').val();
            let formData = {
                _token: '{{ csrf_token() }}',
                tanggal: $('#modalHargaJual input[name="tanggal"]').val(),
                nama_tanaman: $('#modalHargaJual select[name="nama_tanaman"]').val(),
                harga_jual: $('#modalHargaJual input[name="harga_jual"]').val(),
            };

            let url = '/harga-jual';
            let method = 'POST';

            if (mode === 'edit') {
                formData._method = 'PUT';
                url = `/harga-jual/${id}`;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function() {
                    $('#modalHargaJual').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: mode === 'edit' ? 'Data berhasil diperbarui!' :
                            'Data berhasil ditambahkan!'
                    });
                    $('#list-data').DataTable().ajax.reload(null, false);
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
    <script>
        $(document).ready(function() {
            $('#nama_tanaman').select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#modalHargaJual')
            });
        });
    </script>
@endsection
