
@extends('layouts.master')
@section('title')
    Setting-Units
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
                <h4 class="content-title mb-0 my-auto">Setting</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/Unit</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
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

                        <h6 class="modal-title">Add Unit</h6>

                    </div>

                    <form action="{{route('unit.store')}}"method="post">
                        {{@csrf_field()}}
                        <div class="modal-body">


                            <label for="input">Unit_code</label>
                            <input type="text"class="form-control"id="Unit_code"name="Unit_code"required value="{{old('Unit_code')}}" >

                            <label for="input">Unit_des</label>
                            <input type="text"class="form-control"id="Unit_des"name="Unit_des"  value="{{old('Unit_des')}}">

                            <label class="form-label">packing</label>
                            <select name="packing_id" id="packing_id" class="form-control search" required>
                                <option value="" selected disabled> select packing</option>
                                @foreach ($packings as $packing)
                                    <option value="{{$packing->id}}">{{$packing->pk_code}}</option>
                                @endforeach
                            </select>

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
                    @can('add unit')
                    <div class="d-flex justify-content-between">
                        <a class="modal-effect btn btn-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">ADD UNIT</a>
                    </div>
                    @endcan

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">No</th>
                                <th class="wd-15p border-bottom-0">Unit_code</th>
                                <th class="wd-20p border-bottom-0">Unit_des</th>
                                <th class="wd-20p border-bottom-0">packing name</th>
                                <th class="wd-15p border-bottom-0">Operation</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0?>
                            @foreach($units as $x)
                                    <?php $i++?>

                                <tr >
                                    <td>{{$i}}</td>
                                    <td>{{$x->Unit_code}}</td>
                                    <td>{{$x->Unit_des}}</td>
                                    <td>{{$x->pk->pk_code}}</td>
                                    <td>
                                        @can('edit unit')
                                        <div class="btn-group">
                                            <a href="#"class="modal-effect btn btn-sm btn-primary" data-toggle="modal"
                                               data-target="#edit{{$x->id}}">   <i class="las la-pen"></i> edit

                                            </a>
                                        </div>
                                        @endcan
                                        @can('delete unit')
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
                                                <h6 class="modal-title">Edit Unit</h6>
                                            </div>
                                            <form action="{{route('unit.update',$x->id)}}"method="post" autocomplete="off">
                                                @method('put')
                                                @csrf
                                                <div class="modal-body">


                                                    <label for="input">Unit_code</label>
                                                    <input type="text"class="form-control"value="{{$x->Unit_code}}"name="Unit_code"required>

                                                    <label for="input">Unit_des</label>
                                                    <input type="text"class="form-control" value="{{$x->Unit_des}}"name="Unit_des">


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
                                                <h6 class="modal-title">Delete Unit</h6>
                                            </div>
                                            <form action="{{route('unit.destroy',$x->id)}}"method="post">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">

                                                    <p>Are you sure to delete this item? </p>
                                                    <input type="text"class="form-control"value="{{$x->Unit_code}}" readonly>

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


