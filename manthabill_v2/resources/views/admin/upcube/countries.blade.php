<x-upcube.admin.admin-template-layout >
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-sm btn-primary">Tambah</button>
                        </div>
                        <div class="card-body">
                            <table id="tableCountries" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
