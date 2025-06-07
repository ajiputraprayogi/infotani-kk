@extends('layouts.home')
@section('title', 'Data Roles')

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
                            <h3 class="card-title mb-0">Data Roles</h3>
                            <!-- Tombol dengan margin-left auto agar dorong ke kanan -->
                            <button class="btn btn-primary btn-sm ms-auto" onclick="tambahRoles()">+ Tambah Roles</button>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="list-data" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="15px">No.</th>
                                        <th>Nama</th>
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
    <!-- Modal Tambah/Edit Roles -->
    <div class="modal fade" id="modalRoles" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form onsubmit="event.preventDefault(); simpanRoles();">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalRolesTitle">Tambah Roles</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <!-- Global Check All -->
                        <div class="mb-3">
                            <label for="permissions">Pilih Permission</label>
                            <div class="card p-3 mt-2">
                                <div class="row" id="permission-container">
                                    @foreach ($permission as $grub => $items)
                                        <div class="col-md-4 mb-3">
                                            <div class="card border">
                                                <div
                                                    class="card-header py-2 d-flex justify-content-between align-items-center">
                                                    <strong>{{ $grub }}</strong>
                                                    <!-- Check All per grup -->
                                                    <div class="form-check">
                                                        <input class="form-check-input check-all-grup" type="checkbox"
                                                            id="check_all_{{ Str::slug($grub) }}"
                                                            data-grup="{{ Str::slug($grub) }}">
                                                        <label class="form-check-label"
                                                            for="check_all_{{ Str::slug($grub) }}">
                                                            Check All
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="card-body py-2">
                                                    @foreach ($items as $perm)
                                                        <div class="form-check">
                                                            <input class="form-check-input grup-{{ Str::slug($grub) }}"
                                                                type="checkbox" name="permission[]"
                                                                value="{{ $perm->id }}" id="perm_{{ $perm->id }}">
                                                            <label class="form-check-label" for="perm_{{ $perm->id }}">
                                                                {{ $perm->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-check d-flex justify-content-end">
                                    <input class="form-check-input" type="checkbox" id="check_all_global">
                                    <label class="form-check-label" for="check_all_global" style="margin-left: 0.3rem;">
                                        Check All Semua Permission
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSimpanRoles" class="btn btn-primary">Simpan</button>
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
        // Global Check All: cek semua permission (semua grup)
        $('#check_all_global').on('change', function() {
            var checked = $(this).is(':checked');
            $('input[name="permission[]"]').prop('checked', checked);
            $('.check-all-grup').prop('checked', checked);
        });

        // Check All per grup
        $('.check-all-grup').on('change', function() {
            var grup = $(this).data('grup');
            var checked = $(this).is(':checked');
            $('.grup-' + grup).prop('checked', checked);

            // Jika grup dicentang/diuncheck, update global juga
            updateGlobalCheckAll();
        });

        // Checkbox permission per item diubah, update check all grup dan global
        $('input[type=checkbox][name="permission[]"]').on('change', function() {
            // Update check all per grup
            $('.check-all-grup').each(function() {
                var grup = $(this).data('grup');
                var allCheckedInGroup = $('.grup-' + grup + ':not(:checked)').length === 0;
                $(this).prop('checked', allCheckedInGroup);
            });

            // Update global check all
            updateGlobalCheckAll();
        });

        function updateGlobalCheckAll() {
            var allChecked = $('input[name="permission[]"]:not(:checked)').length === 0;
            $('#check_all_global').prop('checked', allChecked);
        }
    </script>
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
                ajax: '/list-data-roles',
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
                        url: `/roles/${id}`,
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

        function tambahRoles() {
            mode = 'tambah';
            $('#modalRolesTitle').text('Tambah Roles');
            $('#btnSimpanRoles').text('Simpan');
            $('#modalRoles input[name="id"]').val('');
            $('#modalRoles input[name="name"]').val('');
            $('#modalRoles').modal('show');
        }

        // function editdata(id) {
        //     $.get(`/roles/${id}/edit`, function(response) {
        //         mode = 'edit';
        //         $('#modalRolesTitle').text('Edit Roles');
        //         $('#btnSimpanRoles').text('Simpan Perubahan');
        //         $('#modalRoles input[name="id"]').val(response.id);
        //         $('#modalRoles input[name="name"]').val(response.name);
        //         $('#modalRoles').modal('show');
        //     }).fail(function() {
        //         Toast.fire({
        //             icon: 'error',
        //             title: 'Gagal mengambil data roles!'
        //         });
        //     });
        // }

        function editdata(id) {
            $.get(`/roles/${id}/edit`, function(response) {
                mode = 'edit';
                $('#modalRolesTitle').text('Edit Roles');
                $('#btnSimpanRoles').text('Simpan Perubahan');
                // Akses data dari response.role, bukan langsung response
                $('#modalRoles input[name="id"]').val(response.role.id);
                $('#modalRoles input[name="name"]').val(response.role.name);

                // Reset semua checkbox permission
                $('input[name="permission[]"]').prop('checked', false);

                // Pastikan response.permissions ada dan array
                if (response.permissions && Array.isArray(response.permissions)) {
                    response.permissions.forEach(function(permissionId) {
                        $('#perm_' + permissionId).prop('checked', true);
                    });
                }

                $('#modalRoles').modal('show');
            }).fail(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal mengambil data roles!'
                });
            });
        }

        // function simpanRoles() {
        //     let id = $('#modalRoles input[name="id"]').val();
        //     let formData = {
        //         _token: '{{ csrf_token() }}',
        //         name: $('#modalRoles input[name="name"]').val(),
        //     };

        //     let url = '/roles';
        //     let method = 'POST';

        //     if (mode === 'edit') {
        //         formData._method = 'PUT';
        //         url = `/roles/${id}`;
        //     }

        //     $.ajax({
        //         url: url,
        //         type: 'POST',
        //         data: formData,
        //         success: function() {
        //             $('#modalRoles').modal('hide');
        //             Toast.fire({
        //                 icon: 'success',
        //                 title: mode === 'edit' ? 'Data berhasil diperbarui!' :
        //                     'Data berhasil ditambahkan!'
        //             });
        //             $('#list-data').DataTable().ajax.reload(null, false);
        //         },
        //         error: function() {
        //             Toast.fire({
        //                 icon: 'error',
        //                 title: mode === 'edit' ? 'Gagal memperbarui data!' : 'Gagal menambahkan data!'
        //             });
        //         }
        //     });
        // }

        function simpanRoles() {
            let id = $('#modalRoles input[name="id"]').val();
            let formData = {
                _token: '{{ csrf_token() }}',
                name: $('#modalRoles input[name="name"]').val(),
                permission: $('input[name="permission[]"]:checked').map(function() {
                    return this.value;
                }).get()
            };

            let url = '/roles';
            let method = 'POST';

            if (mode === 'edit') {
                formData._method = 'PUT';
                url = `/roles/${id}`;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function() {
                    $('#modalRoles').modal('hide');
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
