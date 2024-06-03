@extends('layouts.master')
@section('title')
    Edit Invoice-Issue
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
                <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/Edit</span>
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
                    <h3>Edit Invoice</h3>
                    <a href="{{route('issue.index')}}" class="btn btn-primary ml-auto"><i class="fa fa-home "></i></a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('issue.update', $invoice->id) }}" id="invoiceForm">
                        @csrf
                        @method('PUT')
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
                                        <option value="" selected disabled>Select client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}" @if($client->id == $invoice->client_id) selected @endif>{{ $client->client_name }}</option>
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
                                            <option value="{{ $store->id }}" @if($store->id == $invoice->stor_id) selected @endif>{{ $store->store_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="digger_id">DIGGER</label>
                                    <select name="digger_id"  class="form-control search" >
                                        <option value="" selected disabled></option>
                                        @foreach ($diggers as $digger)
                                            <option value="{{$digger->id}}"@if($digger->id==$invoice->digger_id)selected @endif>{{$digger->Rig_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="transport_id">TRANSPORT</label>
                                    <select name="transport_id"  class="form-control search" required>
                                        <option value="" selected disabled> {{old('digger_id',$invoice->transport->trans_name)}}</option>
                                        @foreach ($transports as $transport)
                                            <option value="{{$transport->id}}"@if($transport->id==$invoice->transport_id)selected @endif>{{$transport->trans_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <label>DATE</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD" type="text" value="{{ $invoice->invoice_Date }}" required>
                            </div>
                        </div><hr>
                        <div class="row">
                            <div class="col-4">
                                <select class="form-control" name="item_id" id="item_id" >
                                    <option value="" selected disabled>Select Item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
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
                                <button type="submit" class="btn btn-info">update</button>
                            </div>
                        </div>

                        <!-- Invoice Details -->
                        <div class="form-group" id="invoiceDetails">
                            <hr>
                            <table class="table table-invoice border text-md-nowrap mb-0" id="invoiceTable" style="background-color:#1a73ef">
                                <thead>
                                <tr>
                                    <th style="color: white;"> No</th>
                                    <th style="color: white;">Item Name</th>
                                    <th style="color: white;">Unit</th>
                                    <th style="color: white;">Quantity</th>
                                    <th style="color: white;">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoiceDetails as $detail)
                                    <tr>
                                        <td >{{$loop->iteration}}</td>
                                        <td>{{ $detail->item->item_name }}</td>
                                        <td>{{ $detail->unit }}</td>
                                        <td>
                                            <input type="number" name="items[{{ $detail->id }}][quantity]" value="{{ $detail->quantity }}">
                                            <input type="hidden" name="items[{{ $detail->id }}][item_id]" value="{{ $detail->item_id }}">
                                            <input type="hidden" name="items[{{ $detail->id }}][unit]" value="{{ $detail->unit }}">
                                        </td>
                                        <td><button type="button" class="btn btn-danger btn-sm removeItemBtn" data-id="{{ $detail->id }}"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                @endforeach
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
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            // Initialize items array with existing invoice details
            var items = [];

            // Populate items array with existing data
            $('#invoiceTable tbody tr').each(function() {
                var item_id = $(this).find('input[name^="items"]').val();
                var unit = $(this).find('input[name^="items"]').val();
                var quantity = $(this).find('input.quantity').val();
                items.push({
                    item_id: item_id,
                    unit: unit,
                    quantity: quantity
                });
            });

            // Function to add item to invoice
            function addItem(item_id, productName, unit, quantity) {
                var item = {
                    item_id: item_id,
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
                        '<td><input type="number" class="form-control quantity" name="items[' + index + '][quantity]" value="' + item.quantity + '"></td>' +
                        '<input type="hidden" name="items[' + index + '][item_id]" value="' + item.item_id + '">' +
                        '<input type="hidden" name="items[' + index + '][unit]" value="' + item.unit + '">' +
                        '<td><button type="button" class="btn btn-danger btn-sm removeItemBtn" data-index="' + index + '"><i class="fa fa-trash"></i></button></td>' +
                        '</tr>';
                    tbody.append(row);
                });
            }

            // Event listener for Add Item button
            $('#addItemBtn').click(function() {
                var item_id = $('#item_id').val();
                var productName = $('#item_id option:selected').text();
                var unit = $('#unit').val();
                var quantity = $('#quantity').val();

                if (item_id && unit && quantity > 0) {
                    addItem(item_id, productName, unit, quantity);
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
                    url: '{{ route("issue.update", $invoice->id) }}', // Change this to your server endpoint
                    method: 'POST',
                    data: $(this).serialize(),
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
