@extends('layouts.master')
@section('title')
    Invoices-Issue
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/Issue</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h3>Create Invoice</h3>
                    <a href="{{route('issue.index')}}" class="btn btn-primary ml-auto"><i class="fa fa-home "></i></a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('issue.store') }}" id="invoiceForm">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="user_id">USER</label>

                                    <select name="user_id" class="form-control search" required >
                                        <option value="{{Auth::user()->id}}">{{Auth::user()->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="client_id">CLIENT</label>
                                    <select name="client_id"  class="form-control search" required>
                                        <option value="" selected disabled> select client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{$client->id}}">{{$client->client_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="store_id">STORE</label>
                                    <select name="store_id" id="store_id" class="form-control">
                                        <option value="" selected disabled>Select Store</option>
                                        @foreach ($stores as $store)
                                            <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="digger_id">DIGGER</label>
                                    <select name="digger_id"  class="form-control search" required>
                                        <option value="" selected disabled> select digger</option>
                                        @foreach ($diggers as $digger)
                                            <option value="{{$digger->id}}">{{$digger->Rig_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="transport_id">TRANSPORT</label>
                                    <select name="transport_id"  class="form-control search" required>
                                        <option value="" selected disabled> select transport</option>
                                        @foreach ($transports as $transport)
                                            <option value="{{$transport->id}}">{{$transport->trans_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label>DATE</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                       type="text" value="{{ date('Y-m-d') }}" required>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <select class="form-control" name="item_id" id="item_id" >
                                    <option value="" selected disabled>Select Item</option>
                                    <!-- Dynamically populated options will be added here -->
                                </select>
                            </div>
                            <div class="col-4">
                                <select class="form-control -sm" name="unit" id="unit" >

                                </select>
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control " name="quantity" id="quantity" placeholder="Quantity" step="0.01" >
                            </div>
                            <div class="col-2"style="gap:10px;">
                                <button type="button" class="btn btn-primary" id="addItemBtn" >Add</button>
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>


                        <!-- Invoice Details -->
                        <div class="form-group" id="invoiceDetails">
                            <hr>
                            <table class="table table-invoice border text-md-nowrap mb-0" id="invoiceTable" style="background-color:#1a73ef">
                                <thead>
                                <tr >

                                    <th style="color: white;">Item Name</th>
                                    <th style="color: white;">Unit</th>
                                    <th style="color: white;">Quantity</th>
                                    <th style="color: white;">Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                <!-- Items will be added here -->
                                </tbody>
                            </table>
                            <hr>

                        </div>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            // Array to store invoice items
            var items = [];

            // Function to add item to invoice
            function addItem(productId, productName, unit, quantity) {
                var item = {
                    productId: productId,
                    productName: productName,
                    unit: unit,
                    quantity: quantity
                };
                items.push(item);
                // Update displayed items list
                displayItems();
            }

            // Function to display items in the table
            function displayItems() {
                var tbody = $('#invoiceTable tbody');
                tbody.empty();
                items.forEach(function(item, index) {
                    var row = '<tr>' +

                        '<td>' + item.productName + '</td>' +
                        '<td>' + item.unit + '</td>' +
                        '<td>' + item.quantity + '</td>' +
                        '<td><button type="button" class="btn btn-danger btn-sm removeItemBtn" data-index="' + index + '"><i class="fa fa-trash"></i></button></td>' +
                        '</tr>';
                    tbody.append(row);
                });
            }

            // Event listener for Add Item button
            $('#addItemBtn').click(function() {
                var productId = $('#item_id').val();
                var productName = $('#item_id option:selected').text();
                var unit = $('#unit').val();
                var quantity = $('#quantity').val();

                if (productId && unit && quantity > 0) {
                    addItem(productId, productName, unit, quantity);
                    // Clear input fields after adding item
                    $('#item_id').val('');
                    $('#unit').val('');
                    $('#quantity').val('');
                } else {
                    alert('Please enter valid product and quantity.');
                }
            });

            // Event listener to remove item
            $(document).on('click', '.removeItemBtn', function() {
                var index = $(this).data('index');
                items.splice(index, 1);
                displayItems();
            });

            // Example of submitting items to server
            $('#invoiceForm').submit(function(event) {
                event.preventDefault();
                // Send items array to server using AJAX
                $.ajax({
                    url: '{{ route("issue.store") }}', // Change this to your server endpoint
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        store_id: $('select[name="store_id"]').val(),
                        client_id: $('select[name="client_id"]').val(),
                        user_id: $('select[name="user_id"]').val(),
                        digger_id: $('select[name="digger_id"]').val(),
                        transport_id: $('select[name="transport_id"]').val(),
                        invoice_Date: $('input[name="invoice_Date"]').val(),
                        items: items
                    },
                    success: function(response) {
                        window.location.href = '{{ route("issue.index") }}';
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error submitting items. Please try again.');
                    }
                });
            });

            // Fetch items based on selected store
            $('select[name="store_id"]').on('change', function() {
                var store_id = $(this).val();
                if (store_id) {
                    $.ajax({
                        url: "{{ URL::to('fetch-items') }}/" + store_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var itemSelect = $('select[name="item_id"]');
                            itemSelect.empty();
                            itemSelect.append('<option value="" selected disabled>Select Item</option>');
                            $.each(data, function(key, value) {
                                itemSelect.append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });

            // Initialize datepicker
            $('.fc-datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            }).val();

        });
    </script>
    <script>
        $(document).ready(function() {
            $('select[name="item_id"]').on('change', function () {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: "{{ URL::to('fetch-unit') }}/" + id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var unitset = $('select[name="unit"]');
                            unitset.empty();
                            $.each(data, function (key, value) {
                                unitset.append('<option value="' + value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

@endsection
