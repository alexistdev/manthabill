<x-upcube.admin.admin-template-layout>
    @push('customCSS')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
        <!--datatable responsive css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>

        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    @endpush
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Master Data Countries</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adm.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Countries</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <x-upcube.admin.notification-message/>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                <i class="mdi mdi-folder-multiple-plus"></i> Add
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="tableCountries" class="table table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Created</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    <!-- START: Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{route('adm.countries.save')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label
                                    for="name" class="form-label">NAMA NEGARA</label>
                                <input type="text" name="name" id="name" class="form-control"
                                       value="{{old('name')}}" maxlength="255"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END: Modal Tambah -->

    <!-- START: Modal EDIT -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{route('adm.countries.update')}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                @if($errors->edit->has('country_id'))
                                    <span
                                        class="text-danger errorMessage">{{$errors->edit->first('country_id')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="country_id" class="form-control" id="country_id"
                                       value="{{old('country_id')}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label
                                    for="name" class="form-label">NAMA NEGARA</label>
                                <input type="text" name="name" id="editName" class="form-control"
                                       value="{{old('name')}}" maxlength="255"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END: Modal EDIT -->

    <!-- START: Modal DELETE -->
    <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{route('adm.countries.delete')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                @if($errors->delete->has('country_id'))
                                    <span
                                        class="text-danger errorMessage">{{$errors->delete->first('country_id')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="country_id" class="form-control" id="country_delete_id"
                                       value="{{old('country_id')}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <p>Apakah anda ingin menghapus data ini ?</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END: Modal DELETE -->
    @push('customJS')
        <!-- Required datatable js -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!--datatable js-->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script>
            $(document).ready(function () {
                let base_url = "{{route('adm.countries')}}";

                setTimeout(function () {
                        $('.alert').fadeOut('slow');
                    }, 2000
                );

                /** saat tombol edit di klik */
                $(document).on("click", ".open-edit", function (e) {
                    e.preventDefault();
                    let fid = $(this).data('id');
                    let fname = $(this).data('name');
                    $('#country_id').val(fid);
                    $('#editName').val(fname);
                });

                /** saat tombol hapus di klik */
                $(document).on("click", ".open-hapus", function (e) {
                    e.preventDefault();
                    let fid = $(this).data('id');
                    $('#country_delete_id').val(fid);

                });

                $('#tableCountries').DataTable({
                    ajax: {
                        type: 'GET',
                        url: base_url,
                        async: true,
                        dataType: 'json',
                    },
                    columns: [
                        {
                            data: 'index',
                            class: 'text-center',
                            defaultContent: '',
                            orderable: false,
                            searchable: false,
                            width: '10%',
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1; //auto increment
                            }
                        },
                        {data: 'name', class: 'text-left'},
                        {data: 'created_at', class: 'text-center', width: '15%'},
                        {data: 'action', class: 'text-center', width: '15%', orderable: false},
                    ],
                    "bDestroy": true
                });
            });
        </script>

    @endpush
</x-upcube.admin.admin-template-layout>
