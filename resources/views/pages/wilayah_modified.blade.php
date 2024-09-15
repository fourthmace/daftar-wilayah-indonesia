@extends('layouts.main')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/adminlte/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/toastify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/showLoadingSpinner.css') }}">

    <link rel="stylesheet" href="{{ asset('css/pages/wilayah_modified.css') }}">
@endpush

@push('jscript')
    <script src="{{ asset('js/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/plugins/adminlte/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/plugins/showToastify.js') }}"></script>
    <script src="{{ asset('js/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/showLoadingSpinner.js') }}"></script>

    <script src="{{ asset('js/pages/wilayah_modified.js') }}"></script>
@endpush

@section('content')
<div class="content mt-4">
		<div class="container-fluid">
            <div class="row px-2">
                <div class="col-12">
                    <h1>{{ env('WILAYAN_VERSION_NAME') }}</h1>
                    <hr>
                    <div class="d-flex mt-3">
                        <a href="" id="download_excel" class="btn btn-info btn-md" style="width: max-content;">
                            <i class="fa fa-download"></i> &nbsp; excel
                        </a>
                        <a href="" id="download_json" class="btn btn-info btn-md ml-2" style="width: max-content;">
                            <i class="fa fa-download"></i> &nbsp; json
                        </a>
                    </div>
                </div>
				<div class="col-12 mt-5">
                    <div class="card card-secondary card-outline">
						<div class="card-header">
							<table id="table_wilayah_modified" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>
											No
										</th>
										<th>
											Tipe
										</th>
										<th>
											Kode
										</th>
										<th>
											Kode Provinsi
										</th>
										<th>
											Kode Kabupaten/Kota
										</th>
										<th>
											Kode Kecamatan
										</th>
										<th>
											Kode Kelurahan/Desa
										</th>
										<th>
                                            Nama
										</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
@endsection
