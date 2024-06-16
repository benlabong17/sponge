@extends('layouts.layout')

@section('auth')
<h4 class="pull-left page-title">Data Bagian</h4>
<ol class="breadcrumb pull-right">
    <li><a href="#">{{Auth::user()->name}}</a></li>
    <li class="active">Data Bagian</li>
</ol>
<div class="clearfix"></div>
@endsection

@section('content')
<div class="container">
    <div class="card-header">
        <div class="btn-group" role="group">
            <div class="form-group">
                <button title="show/hide data filter options" type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#main-table-data-filter" aria-expanded="false" aria-controls="main-table-data-filter">{{ucfirst(__('data filter'))}}..</button>
                <button type="button" name="create_new" id="create_new" class="btn btn-secondary" onclick="location.replace('{{url('create-new-department')}}');"><i class="fa fa-plus"></i> {{ucwords(__('New'))}}</button>
                <button type="button" name="download" id="download" class="btn btn-secondary"><i class="fa fa-fw fa-file-excel-o"></i> {{ucwords(__('Download'))}}</button>
                <button type="button" name="upload" id="upload" class="btn btn-secondary"><i class="fa fa-upload"></i> {{ucwords(__('Upload'))}}</button>
            </div>
        </div>
    </div>

    <div class="collapse" id="main-table-data-filter">
        <div class="card card-body">
            <form method="POST" id="search-form" class="form" role="form">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        {{-- NAMA BAGIAN --}}
                        <div class="row mb-2">
                            <label class="col-md-2">NAMA BAGIAN</label>
                            <div class="col-md-6">
                                <input id="department_name" type="text" class="text-uppercase form-control" name="department_name" title="NAMA BAGIAN" placeholder="NAMA BAGIAN">
                                <input name="department_name_id" id="department_name_id" type="hidden"/>
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="button" onclick="departmentName();"><i class="fa fa-ellipsis-h"></i></button>    
                                </div>
                            </div>
                        </div>
                        <br>

                        {{-- STATUS --}}
                        <div class="row mb-2">
                            <label class="col-sm-2">STATUS</label>
                            <div class="col-sm-6">
                                <select title="STATUS" id="status" class="form-control">
                                    <option value="1">AKTIF</option>
                                    <option value="0">NON AKTIF</option>
                                </select>
                            </div>
                        </div>
                        <br>

                        {{-- TANGGAKL EFEKTIF --}}
                        <div class="row mb-2">
                            <label class="col-sm-2">TANGGAL EFEKTIF</label>
                            <div class="col-sm-6">
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control" name="start" id="start_effective" title="MULAI EFEKTIF" placeholder="MULAI EFEKTIF"/>
                                    <span class="input-group-addon bg-primary text-white b-0">to</span>
                                    <input type="text" class="form-control" name="end" id="end_effective" title="AKHIR EFEKTIF" placeholder="AKHIR EFEKTIF"/>
                                </div>
                            </div>
                        </div>
                        <br>

                        <br>
                        <br>
                        {{-- SEARCH --}}
                        <div class="row">
                            <div class="col col-md-3"><button type="submit" class="btn btn-primary" title="search"><i class="fa fa-search"></i> {{ucwords(__('search'))}}</button> </div>
                        </div>
                    </div> <!-- panel-body -->
                </div> <!-- panel -->
            </form>
        </div>
    </div>  

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Karyawan</h3>
                </div>
                <div class="panel-body">
                    <table  id="main-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                                <th>Bagian</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>No. Telp</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- End Row -->
</div>

<!-- Plugins js -->
<script src="{{ asset('plugins/timepicker/bootstrap-timepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript') }}"></script>
<script src="{{ asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript') }}"></script>
<script src="{{ asset('pages/form-advanced.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script>
    $(function() {
        var oTable = $('#main-table').DataTable({
            filter: false,
            processing: true,
            serverSide: true,
            // deferLoading: 0, //disable auto load
            stateSave: false,
            scrollY: 500,
            scrollX: true,
            language: {
                paginate: {
                  first: "<i class='fa fa-step-backward'></i>",
                  last: "<i class='fa fa-step-forward'></i>",
                  next: "<i class='fa fa-caret-right'></i>",
                  previous: "<i class='fa fa-caret-left'></i>"
                },
                lengthMenu:     "<div class=\"input-group\">_MENU_ &nbsp; / page</div>",
                info:           "_START_ to _END_ of _TOTAL_ item(s)",
                infoEmpty:      ""
            },
            ajax: {
                'url': '{!! route('employee-datatable') !!}',
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                },
                'data': function (d) {
                            d.employee_name = $('#employee_name').val();
                            d.employee_name_id = $('#employee_name_id').val();
                            d.status = $('#status').val();
                        }
            },
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false}, 
                { data : 'name' ,                   name :  'name'                   },
                { data : 'gender' ,                 name :  'gender'                 },
                { data : 'email' ,                  name :  'email'                  },
                { data : 'department' ,             name :  'department'             },
                { data : 'location' ,               name :  'location'               },
                { data : 'status' ,                 name :  'status',                },
                { data : 'telephone' ,              name :  'telephone',             },
            ],
            // order: [[ 2, "desc" ]],
            rowCallback: function( row, data, iDisplayIndex ) {
                var api = this.api();    
                var info = api.page.info();
                var page = info.page;
                var length = info.length;
                var index = (page * length + (iDisplayIndex +1));
            //    $('td:eq(1)', row).html(index);
            },
        }); 
    
        $('#search-form').on('submit', function(e) {
            oTable.draw();
            e.preventDefault();
        });
    });
</script>
@endsection


