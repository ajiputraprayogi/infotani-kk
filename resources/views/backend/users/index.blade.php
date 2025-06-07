@extends('layouts.home')
@section('title', 'Data Users')

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
                            <h3 class="card-title mb-0">Data Users</h3>
                            <!-- Tombol dengan margin-left auto agar dorong ke kanan -->
                            <button class="btn btn-primary btn-sm ms-auto" onclick="tambahUser()">+ Tambah User</button>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="list-data" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="15px">No.</th>
                                        <th>Nama</th>
                                        <th>Email</th>
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
    <!-- Modal Tambah/Edit User -->
    <div class="modal fade" id="modalUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="event.preventDefault(); simpanUser();">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalUserTitle">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label>Password <small><i style="color:red">(*Isi hanya saat tambah atau ingin ganti password)</i></small></label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="role">Pilih Role</label>
                            <select class="form-select" name="role" id="role" required>
                                <option value="" disabled selected>-- Pilih Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}-{{$role->name}}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSimpanUser" class="btn btn-primary">Simpan</button>
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
                ajax: '/list-data-users',
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
                        data: 'email',
                        name: 'email'
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
                        url: `/users/${id}`,
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

        function tambahUser() {
            mode = 'tambah';
            $('#modalUserTitle').text('Tambah User');
            $('#btnSimpanUser').text('Simpan');
            $('#modalUser input[name="id"]').val('');
            $('#modalUser input[name="name"]').val('');
            $('#modalUser input[name="email"]').val('');
            $('#modalUser input[name="password"]').val('');
            $('#modalUser select[name="role"]').val('');
            $('#modalUser').modal('show');
        }

        function editdata(id) {
            $.get(`/users/${id}/edit`, function(response) {
                mode = 'edit';
                // Kosongkan value
                $('#modalUserTitle').text('Tambah User');
                $('#btnSimpanUser').text('Simpan');
                $('#modalUser input[name="id"]').val('');
                $('#modalUser input[name="name"]').val('');
                $('#modalUser input[name="email"]').val('');
                $('#modalUser input[name="password"]').val('');
                $('#modalUser select[name="role"]').val('');
                // Set data sesuai tabel
                $('#modalUserTitle').text('Edit User');
                $('#btnSimpanUser').text('Simpan Perubahan');
                $('#modalUser input[name="id"]').val(response.id);
                $('#modalUser input[name="name"]').val(response.name);
                $('#modalUser input[name="email"]').val(response.email);
                $('#modalUser input[name="password"]').val(''); // Kosongkan password untuk edit
                $('#modalUser select[name="role"]').val(response.role_id + '-' + response.role_name);
                $('#modalUser').modal('show');
            }).fail(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal mengambil data user!'
                });
            });
        }

        function simpanUser() {
            let id = $('#modalUser input[name="id"]').val();
            let formData = {
                _token: '{{ csrf_token() }}',
                name: $('#modalUser input[name="name"]').val(),
                email: $('#modalUser input[name="email"]').val(),
                password: $('#modalUser input[name="password"]').val(),
                role: $('#modalUser select[name="role"]').val()
            };

            let url = '/users';
            let method = 'POST';

            if (mode === 'edit') {
                formData._method = 'PUT';
                url = `/users/${id}`;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function() {
                    $('#modalUser').modal('hide');
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
