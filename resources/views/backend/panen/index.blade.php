@extends('layouts.home')
@section('title', 'Data Panen')

@section('css')
    <link rel="stylesheet" href="{{ asset('select2-boostrap-5/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('select2-boostrap-5/select2-bootstrap-5-theme.min.css') }}" />
    <link href="{{ asset('DataTables/datatables.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/dist/sweetalert2/sweetalert2.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
        }
    </style>
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
                            <h3 class="card-title mb-0">Data Panen</h3>
                            <!-- Tombol dengan margin-left auto agar dorong ke kanan -->
                            <button class="btn btn-primary btn-sm ms-auto" onclick="tambahPanen()">+ Tambah Panen</button>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="list-data" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="15px">No.</th>
                                        <th>Nama</th>
                                        <th>Panen Grup</th>
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
    <!-- Modal Tambah/Edit Panen -->
    <div class="modal fade" id="modalPanen" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <form onsubmit="event.preventDefault(); simpanPanen();">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPanenTitle">Tambah Panen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label>Tanggal</label>
                            <input type="text" id="tanggal" class="form-control" name="tanggal"
                                value="{{ now()->format('Y-m-d') }}" required>
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
                            <input type="number" class="form-control" name="harga_jual" disabled>
                        </div>
                        <div class="mb-3">
                            <label>Jumlah Panen (Kg)</label>
                            <input type="number" class="form-control" name="jumlah_panen" required>
                        </div>
                        <div class="mb-3">
                            <label>Total</label>
                            <input type="number" class="form-control" name="total" disabled>
                        </div>
                        <div class="mb-3">
                            <label>Pembuat</label>
                            <input type="text" class="form-control" name="pembuat" disabled>
                            <input type="text" class="form-control" name="id_pembuat" hidden>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSimpanPanen" class="btn btn-primary">Simpan</button>
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
                ajax: '/list-data-permissions',
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'permissions_grup',
                        name: 'permissions_grup'
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
                        url: `/permissions/${id}`,
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

        const loggedInUser = @json(Auth::user()->name);
        const loggedInUserId = @json(Auth::user()->id);
        let mode = 'tambah'; // Default mode

        function tambahPanen() {
            mode = 'tambah';
            $('#modalPanenTitle').text('Tambah Panen');
            $('#btnSimpanPanen').text('Simpan');
            $('#modalPanen input[name="id"]').val('');
            $('#modalPanen select[name="nama_tanaman"]').val('').trigger('change');
            $('#modalPanen input[name="jumlah_panen"]').val('');
            $('#modalPanen input[name="harga_jual"]').val('0');
            $('#modalPanen input[name="total"]').val('0');
            $('#modalPanen input[name="pembuat"]').val(loggedInUser);
            $('#modalPanen input[name="id_pembuat"]').val(loggedInUserId);
            $('#modalPanen').modal('show');
            
        }

        function fetchHarga() {
            const tanggal = $('#modalPanen input[name="tanggal"]').val();
            const nama_tanaman = $('#modalPanen select[name="nama_tanaman"]').val();

            if (!tanggal && !nama_tanaman) {
                // Kalau dua-duanya kosong, nggak usah fetch
                $('#modalPanen input[name="harga_jual"]').val('0');
                return;
            }
            $.ajax({
                url: '/get-harga',
                method: 'GET',
                data: {
                    tanggal: tanggal,
                    nama_tanaman: nama_tanaman
                },
                success: function(res) {
                    if (res.harga !== null) {
                        $('#modalPanen input[name="harga_jual"]').val(res.harga);
                    } else {
                        $('#modalPanen input[name="harga_jual"]').val('0');
                    }
                    hitungTotal();
                },
                error: function(err) {
                    console.error('Gagal mengambil harga:', err);
                }
            });
        }

        $('#modalPanen input[name="tanggal"]').on('change', fetchHarga);
        $('#modalPanen select[name="nama_tanaman"]').on('change', fetchHarga);

        $('#modalPanen input[name="jumlah_panen"]').on('input', function() {
            hitungTotal();
        });

        function hitungTotal() {
            const harga = parseFloat($('#modalPanen input[name="harga_jual"]').val()) || 0;
            const jumlah = parseFloat($('#modalPanen input[name="jumlah_panen"]').val()) || 0;
            const total = harga * jumlah;

            $('#modalPanen input[name="total"]').val(total.toFixed(0)); // jika ingin 2 desimal
        }

        function editdata(id) {
            $.get(`/permissions/${id}/edit`, function(response) {
                mode = 'edit';
                $('#modalPanenTitle').text('Edit Panen');
                $('#btnSimpanPanen').text('Simpan Perubahan');
                $('#modalPanen input[name="id"]').val(response.id);
                $('#modalPanen input[name="name"]').val(response.name);
                $('#modalPanen input[name="permissions_grup"]').val(response.permissions_grup);
                $('#modalPanen').modal('show');
            }).fail(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal mengambil data permissions!'
                });
            });
        }

        function simpanPanen() {
            let id = $('#modalPanen input[name="id"]').val();
            let formData = {
                _token: '{{ csrf_token() }}',
                name: $('#modalPanen input[name="name"]').val(),
                permissions_grup: $('#modalPanen input[name="permissions_grup"]').val(),
            };

            let url = '/permissions';
            let method = 'POST';

            if (mode === 'edit') {
                formData._method = 'PUT';
                url = `/permissions/${id}`;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function() {
                    $('#modalPanen').modal('hide');
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
                dropdownParent: $('#modalPanen')
            });
        });
    </script>
    <script>
        flatpickr("#tanggal", {
            dateFormat: "Y-m-d",
            defaultDate: "{{ now()->format('Y-m-d') }}",
            altInput: true,
            altFormat: "d-m-Y",
        });
    </script>

@endsection
