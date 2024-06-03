
@extends('layouts.master')
@section('title')
    Setting-Company
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
                <h4 class="content-title mb-0 my-auto">Setting</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/company</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if($errors->any())
        <div class="alert alert-danger"id="alerMessage">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>

    @endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert"id="alerMessage">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert"id="alerMessage">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert"id="alerMessage">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- row -->
    <div class="row">

        <!-- هنا يكون المحتوى الذي يظهر في منتصف الشاشة  -->
        <!--هنا بداية modal  -->
        <!-- Basic modal -->
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Add Company </h6>
                    </div>
                    <form action="{{route('com.store')}}"method="post">
                        {{@csrf_field()}}
                        <div class="modal-body">

                            <div class="row">

                                    <label for="input">Company Name</label>
                                    <input type="text"class="form-control form-control-sm"id="com_name"name="com_name"required value="{{old('com_name')}}" >


                                    <label for="input">Company address</label>
                                    <input type="text"class="form-control form-control-sm"id="com_address"name="com_address"required  value="{{old('com_address')}}">


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit"class="btn btn-success"><i class="far fa-file-alt"></i> Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->
        <!--هنا نهاية modal  -->
        <!--هنا بداية الجدول  -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    @can('add company')
                    <div class="d-flex justify-content-between">
                        <a class="modal-effect btn btn-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">ADD COMPANY</a>
                    </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">No</th>
                                <th class="wd-15p border-bottom-0">Company Name</th>
                                <th class="wd-20p border-bottom-0">Company Address</th>
                                <th class="wd-15p border-bottom-0">Operation</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0?>
                            @foreach($companys as $x)
                                    <?php $i++?>

                                <tr >
                                    <td>{{$i}}</td>
                                    <td>{{$x->com_name}}</td>
                                    <td>{{$x->address}}</td>
                                    <td>
                                        @can('edit company')
                                        <div class="btn-group">
                                            <a href="#"class="modal-effect btn btn-sm btn-primary" data-toggle="modal"
                                               data-target="#edit{{$x->id}}">   <i class="las la-pen"></i> edit

                                            </a>
                                        </div>
                                        @endcan
                                            @can('delete company')
                                        <div class="btn-group">
                                            <a href="#"class="modal-effect btn btn-sm btn-danger" data-toggle="modal"
                                               data-target="#delete{{$x->id}}">  <i class="las la-trash"></i> delete

                                            </a>
                                        </div>
                                            @endcan
                                    </td>

                                </tr>


                                <!--model edit -->
                                <div class="modal" id="edit{{$x->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Edit Company</h6>
                                            </div>
                                            <form action="{{route('com.update',$x->id)}}"method="post" autocomplete="off">
                                                @method('put')
                                                @csrf
                                                <div class="modal-body">


                                                    <label for="input">Company Name</label>
                                                    <input type="text"class="form-control form-control-sm"value="{{$x->com_name}}"name="com_name"required>

                                                    <label for="input">Company Address</label>
                                                    <input type="text"class="form-control form-control-sm" value="{{$x->address}}"name="com_address"required>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"class="btn btn-primary"><i class="typcn typcn-edit"></i> Edit</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--model delete -->
                                <div class="modal" id="delete{{$x->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Delete Company</h6>
                                            </div>
                                            <form action="{{route('com.destroy',$x->id)}}"method="post">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">

                                                    <p>Are you sure to delete this item? </p>
                                                    <input type="text"class="form-control form-control-sm"value="{{$x->com_name}}" readonly>

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
        <!--/div-->
        <!--هنا نهاية الجدول  -->
    </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
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
    <script>
        document.addEventListener('DOMContentLoaded',function (){
            var alerMessage=document.getElementById('alerMessage');
            setTimeout(function (){
                alerMessage.style.display='none';},3000)
        });
    </script>

@endsection




