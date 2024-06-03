@extends('layouts.master')
@section('title')
    Setting-show/invoice
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">invoice </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                      invoive preview </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <div>
                                <h5>petrochem performance chemicals limitcals limited l.l.c<br>
                                </h5>
                                <p>p.o box 19844,sana,republic of yemen ,tel:+9671 440210-fax:+9671 440370</p>
                            </div>

                            <div class="billed-from">
                                <a class="desktop-logo logo-light active" href="http://127.0.0.1:8000/index"><img src="http://127.0.0.1:8000/assets/img/brand/logo.png" class="main-logo" alt="logo"></a>

                            </div>
                            <!-- billed-from -->
                        </div><hr><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">Invoice issuing </label>
                                <h3 class="invoice-info-row"><span>Location :</span>
                                    <span>{{ $invoice->store->store_name }}</span></h3>
                                <h3 class="invoice-info-row"><span>client :</span>
                                    <span>{{ $invoice->client->client_name }}</span></h3>
                                <h3 class="invoice-info-row"><span>name :</span>
                                    <span>{{ $invoice->user->name }}</span></h3>
                                <h3 class="invoice-info-row"><span>Rig namer</span>
                                    <span>{{ $invoice->digger->Rig_name }}</span></h3>
                                <h3 class="invoice-info-row"><span>Well_no </span>
                                    <span>{{ $invoice->digger->Well_no }}</span></h3>

                            </div>
                            <div class="col-md">
                                <div class="col-md">
                                    <label class="tx-gray-600">goods export nots </label>
                                    <h3 class="invoice-info-row"><span>Drive name</span>
                                        <span>{{ $invoice->transport->trans_name }}</span></h3>
                                    <h3 class="invoice-info-row"><span>plate_no </span>
                                        <span>{{ $invoice->transport->plate_no  }}</span></h3>
                                    <h3 class="invoice-info-row"><span>trans_phone</span>
                                        <span>{{ $invoice->transport->trans_phone  }}</span></h3>
                                    <h3 class="invoice-info-row"><span> data: </span>
                                        <span>{{ $invoice->invoice_Date }}</span></h3>
                                    <h3 class="invoice-info-row"></h3>

                                </div>
                            </div>

                        </div>
                        <br><h1> Invoice detalis</h1>
                        <div class="card-body">
                            <div class="table-responsive mg-t-40">
                                <table class="table table-invoice border text-md-nowrap mb-0"style="background-color:#1a73ef">
                                    <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0"style="color: white;">No</th>
                                        <th class="wd-15p border-bottom-0"style="color: white;">item</th>
                                        <th class="wd-20p border-bottom-0"style="color: white;">unit</th>
                                        <th class="wd-15p border-bottom-0"style="color: white;">quantity</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($invoice->details as $item)


                                        <tr >
                                            <td >{{$loop->iteration}}</td>
                                            <td >{{ $item->item->item_name }}</td>
                                            <td >{{$item->unit}}</td>
                                            <td >{{$item->quantity}}</td>


                                        </tr>



                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="mg-b-40">
                        <a class="btn btn-primary rounded-10  float-left mt-3 mr-2"    href="{{route('issue.index')}}">
                            <i class="fa fa-home "></i> back_to_invoice
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script src="{{ asset('frontend/js/form_validation/jquery.form.js') }}"></script>
    <script src="{{ asset('frontend/js/form_validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('frontend/js/form_validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('frontend/js/pickadate/picker.js') }}"></script>
    <script src="{{ asset('frontend/js/pickadate/picker.date.js') }}"></script>
    @if(config('app.locale') == 'ar')
        <script src="{{ asset('frontend/js/form_validation/messages_ar.js') }}"></script>
        <script src="{{ asset('frontend/js/pickadate/ar.js') }}"></script>
    @endif
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <!-- Internal Modal js-->
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>


@endsection
