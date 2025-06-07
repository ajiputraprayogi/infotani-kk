@extends('layouts.home')
@section('title', 'Data Permissions')

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
                <div class="col-md-12">
                    <div class="card mb-4">
                        <!-- Card Header -->
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title mb-0">Data Permissions</h3>
                            <!-- Tombol dengan margin-left auto agar dorong ke kanan -->
                            <button class="btn btn-primary btn-sm ms-auto" onclick="tambahPermissions()">+ Tambah Permissions</button>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="list-data" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="15px">No.</th>
                                        <th>Nama</th>
                                        <th>Permissions Grup</th>
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
    <!-- Modal Tambah/Edit Permissions -->
    <div class="modal fade" id="modalPermissions" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="event.preventDefault(); simpanPermissions();">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPermissionsTitle">Tambah Permissions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label>Permissions Grup</label>
                            <input type="text" class="form-control" name="permissions_grup" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSimpanPermissions" class="btn btn-primary">Simpan</button>
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

        let mode = 'tambah'; // Default mode

        function tambahPermissions() {
            mode = 'tambah';
            $('#modalPermissionsTitle').text('Tambah Permissions');
            $('#btnSimpanPermissions').text('Simpan');
            $('#modalPermissions input[name="id"]').val('');
            $('#modalPermissions input[name="name"]').val('');
            $('#modalPermissions input[name="permissions_grup"]').val('');
            $('#modalPermissions').modal('show');
        }

        function editdata(id) {
            $.get(`/permissions/${id}/edit`, function(response) {
                mode = 'edit';
                $('#modalPermissionsTitle').text('Edit Permissions');
                $('#btnSimpanPermissions').text('Simpan Perubahan');
                $('#modalPermissions input[name="id"]').val(response.id);
                $('#modalPermissions input[name="name"]').val(response.name);
                $('#modalPermissions input[name="permissions_grup"]').val(response.permissions_grup);
                $('#modalPermissions').modal('show');
            }).fail(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal mengambil data permissions!'
                });
            });
        }

        function simpanPermissions() {
            let id = $('#modalPermissions input[name="id"]').val();
            let formData = {
                _token: '{{ csrf_token() }}',
                name: $('#modalPermissions input[name="name"]').val(),
                permissions_grup: $('#modalPermissions input[name="permissions_grup"]').val(),
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
                    $('#modalPermissions').modal('hide');
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

@endsection
