
@extends('layouts.master')
@section('title')
    Setting-Items
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
                <h4 class="content-title mb-0 my-auto">Setting</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/Items</span>
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
                        <h6 class="modal-title">Add Item</h6>
                    </div>
                    <form action="{{route('item.store')}}"method="post">
                        {{@csrf_field()}}
                        <div class="modal-body">


                            <label for="input">Item Name</label>
                            <input type="text"class="form-control"id="item_name"name="item_name"required value="{{old('item_name')}}" >
                            <label for="input">Item Quntity</label>
                            <input type="text"class="form-control"id="item_quntity"name="quantity"required value="{{old('quantity')}}" >
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="input">Company Name</label>
                                    <select name="company_id" id="company_id" class="form-control search">
                                        <option value="" selected disabled></option>
                                        @foreach ($companys as $company)
                                            <option value="{{$company->id}}">{{$company->com_name}}</option>
                                        @endforeach
                                    </select>
                                </div><br>
                                <div class="col mb-0">
                                    <label for="input">Store Name</label>
                                    <select   name="store_id" id="store_id" class="form-control search " required>
                                        <option value="" selected disabled></option>
                                        @foreach ($stores as $store)
                                            <option value="{{$store->id}}">{{$store->store_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                            </div>
                                <div class="row g-2">
                                <div class="col mb-0">
                                    <label class="form-label">Item Packing</label>
                                    <select name="packing_id" id="packing_id" class="form-control search" required>
                                        <option value="" selected disabled></option>
                                        @foreach ($packings as $packing)
                                            <option value="{{$packing->id}}">{{$packing->pk_code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                 <div class="col mb-0">
                                        <label class="form-label">Item Unit</label>
                                        <select name="unit_code" id="unit_code" class="form-control search" >
                                        </select>
                                  </div>
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
                    @can('add items')
                    <div class="d-flex justify-content-between">
                        <a class="modal-effect btn btn-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">ADD ITEM</a>
                    </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">No</th>
                                <th class="wd-15p border-bottom-0">Item Name</th>
                                <th class="wd-15p border-bottom-0">Item Quntity</th>
                                <th class="wd-20p border-bottom-0">Company</th>
                                <th class="wd-20p border-bottom-0">Uint</th>
                                <th class="wd-20p border-bottom-0">Paking</th>
                                <th class="wd-20p border-bottom-0">Store</th>
                                <th class="wd-15p border-bottom-0">Operation</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0?>
                            @foreach($items as $x)
                                    <?php $i++?>

                                <tr >
                                    <td>{{$i}}</td>
                                    <td>{{$x->item_name}}</td>
                                    <td>{{$x->quantity}}</td>
                                    <td>{{$x->company->com_name}}</td>
                                    <td>{{$x->unit}}</td>
                                    <td>{{$x->packing->pk_code}}</td>
                                    <td>{{$x->store->store_name}}</td>
                                    <td>
                                        @can('edit items')
                                        <div class="btn-group">
                                            <a href="#"class="modal-effect btn btn-sm btn-primary" data-toggle="modal"
                                               data-target="#edit{{$x->id}}">   <i class="las la-pen"></i>

                                            </a>
                                        </div>
                                        @endcan
                                            @can('delete items')
                                        <div class="btn-group">
                                            <a href="#"class="modal-effect btn btn-sm btn-danger" data-toggle="modal"
                                               data-target="#delete{{$x->id}}">  <i class="las la-trash"></i>

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
                                                <h6 class="modal-title">Edit Item</h6>
                                            </div>
                                            <form action="{{route('item.update',$x->id)}}"method="post" autocomplete="off">
                                                @method('put')
                                                @csrf
                                                <div class="modal-body">


                                                    <label for="input">Item Name</label>
                                                    <input type="text"class="form-control"id="item_name"name="item_name" value="{{$x->item_name}}" >
                                                    <label for="input">Item Quntity</label>
                                                    <input type="text"class="form-control"id="item_quntity"name="quantity" value="{{$x->quantity}}" >
                                                    <div class="row g-2">
                                                        <div class="col mb-0">
                                                            <label for="input">Company Name</label>
                                                            <select name="company_id" id="company_id" class="form-control search"value="{{$x->com_name}}">
                                                                <option value="" selected disabled></option>
                                                                @foreach ($companys as $company)
                                                                    <option value="{{$company->id}}">{{$company->com_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div><br>
                                                        <div class="col mb-0">
                                                            <label for="input">Store Name</label>
                                                            <select name="store_id" id="store_id" class="form-control search"value="{{$x->store->store_name}}">
                                                                <option value="" selected disabled></option>
                                                                @foreach ($stores as $store)
                                                                    <option value="{{$store->id}}">{{$store->store_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div><br>
                                                    </div>
                                                    <div class="row g-2">
                                                        <div class="col mb-0">
                                                            <label class="form-label">Item Packing</label>
                                                            <select name="packing_id" id="packing_id" class="form-control search" data-value="{{$x->packing->pk_code}}">
                                                                <option value="" selected disabled></option>
                                                                @foreach ($packings as $packing)
                                                                    <option value="{{$packing->id}}">{{$packing->pk_code}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col mb-0">
                                                            <label class="form-label">Item Unit</label>
                                                            <select name="unit_code" id="unit_code" class="form-control search"data-value="{{$x->unit}}" >
                                                            </select>
                                                        </div>
                                                    </div>
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
                                                <h6 class="modal-title">Delete Item</h6>
                                            </div>
                                            <form action="{{route('item.destroy',$x->id)}}"method="post">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">

                                                    <p>Are you sure to delete this item? </p>
                                                    <input type="text"class="form-control"value="{{$x->item_name}}" readonly>

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
        $(document).ready(function() {
            $('select[name="packing_id"]').on('change', function() {
                var PackingId = $(this).val();
                if (PackingId) {
                    $.ajax({
                        url: "{{ URL::to('packing') }}/" + PackingId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="Unit_code"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="unit_code"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded',function (){
            var alerMessage=document.getElementById('alerMessage');
            setTimeout(function (){
                alerMessage.style.display='none';},3000)
        });
    </script>

@endsection


