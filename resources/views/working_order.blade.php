@extends('layouts.layout')

@section('auth')
<h4 class="pull-left page-title">Form Working Order</h4>
<ol class="breadcrumb pull-right">
    <li><a href="#">{{Auth::user()->name}}</a></li>
    <li class="active">Form Working Order</li>
</ol>
<div class="clearfix"></div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <form class="form-horizontal" role="form">
                <div class="panel panel-primary">
                    <div class="col-md-4">
                        <button class="button-secondary" type="button">KEMBALI</button>
                        <button class="button-primary" type="button">SIMPAN</button>
                    </div>
                    <div>
                        <p>&nbsp;</p>
                    </div>
                    <div class="panel-heading">
                        <h3 class="panel-title">Form Header</h3>
                    </div>
                    <div class="panel-body">

                        {{-- NOMOR WORK ORDER --}}
                        <div class="form-group">
                            <label class="col-md-2">NOMOR WORK ORDER</label>
                            <div class="col-md-6">
                                <input id="work_order" type="text" class="form-control" readonly="readonly" value="00002/WO/TEL/05/2024">
                            </div>
                        </div>

                        {{-- TIPE WORK ORDER --}}
                        <div class="form-group">
                            <label class="col-sm-2">TIPE WORK ORDER</label>
                            <div class="col-sm-6">
                                <select class="form-control">
                                    <option>LAPORAN GANGGUAN</option>
                                    <option>PEKERJAAN</option>
                                </select>
                            </div>
                        </div>

                        {{-- DEPARTEMEN --}}
                        <div class="form-group">
                            <label class="col-sm-2">DEPARTEMEN</label>
                            <div class="col-sm-6">
                                <select class="form-control">
                                    <option>TELKOM</option>
                                    <option>SCADA</option>
                                    <option>PROSIS</option>
                                    <option>UPT</option>
                                    <option>DISPATCHER</option>
                                </select>
                            </div>
                        </div>

                        {{-- KATEGORI PEKERJAAN --}}
                        <div class="form-group">
                            <label class="col-sm-2">KATEGORI PEKERJAAN</label>
                            <div class="col-sm-6">
                                <select class="form-control">
                                    <option>PERBAIKAN</option>
                                    <option>IMPROVEMMENT</option>
                                    <option>PEMBANGUNAN</option>
                                </select>
                            </div>
                        </div>

                        {{-- TANGGAL EFEKTIF --}}
                        <div class="form-group">
                            <label class="col-sm-2">TANGGAL EFEKTIF</label>
                            <div class="input-group col-sm-6">
                                <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                            </div><!-- input-group -->
                        </div>
                    </div> <!-- panel-body -->
                </div> <!-- panel -->

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Form Detail</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group" id="work-detail-container">

                            </div>
                            <div>
                                <button type="button" id="addDetailButton">+ Tambah Detail</button>
                            </div>
                        </form>
                    </div> <!-- panel-body -->
                </div> <!-- panel -->
            </form>
        </div> <!-- col -->
    </div>
</div>

<!-- Plugins js -->
@endsection

{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}

@section('script')
<script>
    $(document).ready(function() {
        //var detailIndex = 0;

        $('#addDetailButton').click(function() {
            $('#work-detail-container').append(`
        <div class="col-md-12" id="work-detail">
            <div class="col-sm-2">
                <button type="button" id="removeDetailButton">HAPUS</button>
            </div>
            <div class="col-sm-10">
                <div class="col-md-8">
                    <div>
                        <div class="col-md-6">
                            <div>
                                <label>LOKASI</label>
                            </div>
                            <div>
                                <select class="form-control">
                                    <option>GI KUDUS 150 KV</option>
                                    <option>GI UNGARAN 150 KV</option>
                                    <option>GI SEMARANG 150 KV</option>
                                    <option>GI SALATIGA 150 KV</option>
                                    <option>GI DEMAK 150 KV</option>
                                    <option>GI JEPARA 150 KV</option>
                                    <option>GI BOYOLALI 150 KV</option>
                                    <option>GI BATANG 150 KV</option>
                                    <option>GI KENDAL 150 KV</option>
                                    <option>GI WLERI 150 KV</option>
                                    <option>GITET UNGARAN 500 KV</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label>ALAT</label>
                            </div>
                            <div>
                                <select class="form-control">
                                    <option>MODEM</option>
                                    <option>ROUTER</option>
                                    <option>MUX</option>
                                    <option>RADIO VHF</option>
                                    <option>REPEATERR</option>
                                    <option>RECEIVER</option>
                                    <option>TRANSMITER</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>&nbsp;</p>
                    </div>
                    <div>
                        <label>DESKRIPSI</label>
                    </div>
                    <div>
                        <textarea class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                        <label>KATEGORI GANGGUAN</label>
                    </div>
                    <div>
                        <select class="form-control">
                            <option>TP OFF</option>
                            <option>TP LINK DOWN</option>
                            <option>TP ERROR</option>
                        </select>
                    </div>
                    <div>
                        <p>&nbsp;</p>
                    </div>
                    <div>
                        <label>LAMPIRAN FOTO</label>
                    </div>
                    <div>
                        <input type="file" id="myFile1" name="filename">
                        <br>
                        <input type="file" id="myFile2" name="filename">
                        <br>
                        <input type="file" id="myFile3" name="filename">
                    </div>
                </div>
            </div>
            <div>
                <p>&nbsp;</p>
            </div>
        </div>
        `);
        });

        $(document).on('click', '#removeDetailButton', function() {
            $(this).closest('#work-detail').remove();
        });
    });
</script>
@endsection