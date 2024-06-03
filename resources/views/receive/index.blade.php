@extends('layouts.master')
@section('title')
    Invoices-Receive
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />


@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/Receive</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('add'))
        <script>
            window.onload = function() {
                notif({
                    msg: "Added Successfully ",
                    type: "success"
                })
            }

        </script>
    @endif
    @if (session()->has('delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "Deleted Successfully ",
                    type: "success"
                })
            }

        </script>
    @endif
    @if (session()->has('edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: "Edited Successfully ",
                    type: "success"
                })
            }

        </script>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h2>Invoices</h2>
                    @can('add invoices_rec')
                    <a href="{{route('receive.create')}}" class="btn btn-primary  ml-auto"><i class="fa fa-plus"></i>Add Invoice </a>
                    @endcan
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                        <tr>
                            <th>no</th>
                            <th>vender_name</th>
                            <th>invoice_Date</th>
                            <th>Create_by</th>
                            <th>opretions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0?>
                        @foreach($invoices as $invoice)

                                <?php $i++?>
                        <tr>
                            <td>{{$i}}</td>
                            <td> <a href="{{route('receive.show',$invoice->id)}}" >{{$invoice->vend->vendor_name}}</a></td>
                            <td>{{$invoice->invoice_Date}}</td>
                            <td>{{Auth::user()->name}}</td>
                            <td>
                                <div class="dropdown">
                                    <button aria-expanded="false" aria-haspopup="true"
                                            class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                            type="button"> action <i class=" fas fa-caret-down ml-1"></i></button>
                                    <div class="dropdown-menu tx-13">
                                        @can('edit invoices_rec')

                                        <a class=" btn btn-primary btn-sm dropdown-item" href="{{route('receive.edit',$invoice->id)}}"><i class=" text-primary fa fa-edit"> Edit</i></a>
                                        @endcan
                                            @can('delete invoices_rec')

                                        <a class="dropdown-item modal-effect btn btn-sm btn-danger"
                                           data-toggle="modal" data-target="#delete{{$invoice->id}}">
                                        <i class=" text-danger fa fa-trash"> Delete</i></a>
                                            @endcan
                                            @can('print invoices_rec')

                                        <a class=" btn btn-primary btn-sm dropdown-item" href="{{ url('receive/'.$invoice->id.'/print') }}"><i class="text-success fa fa-print"> print </i></a>
                                            @endcan


                                    </div>
                                </div>

                            </td>
                        </tr>

                                <!--model delete -->
                                <div class="modal" id="delete{{$invoice->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Delete invoice</h6>
                                            </div>
                                            <form action="{{route('receive.destroy',$invoice->id)}}"method="post">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">

                                                    <p>Are you sure to delete this item? </p>
                                                    <input type="text"class="form-control"value="{{$invoice->vend->vendor_name}}" readonly>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"class="btn btn-danger">delete</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>


                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                </div>
                </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('js')
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
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>


@endsection
