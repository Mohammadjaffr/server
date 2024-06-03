<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
        <tr>
            <th>no</th>
            <th>cleint_name</th>
            <th>invoice_Date</th>
            <th>Create_by</th>
            <th>opretions</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=0?>
        @foreach($invoice as $invoice)

                <?php $i++?>
            <tr>
                <td>{{$i}}</td>
                <td>{{$invoice->client->client_name}}</a></td>
                <td>{{$invoice->invoice_Date}}</td>
                <td>{{Auth::user()->name}}</td>
                <td>
                    <div class="dropdown">
                        <button aria-expanded="false" aria-haspopup="true"
                                class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                type="button"> action <i class=" fas fa-caret-down ml-1"></i></button>
                        <div class="dropdown-menu tx-13">

                            <a class=" btn btn-primary btn-sm dropdown-item" href="{{route('restore_iss',$invoice->id)}}"><i class=" text-primary fa fa-edit"> restore</i></a>

                            <a class="dropdown-item modal-effect btn btn-sm btn-danger"
                               data-toggle="modal" data-target="#delete{{$invoice->id}}">
                                <i class=" text-danger fa fa-trash"> Delete</i></a>

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
                        <form action="{{route('delete_iss',$invoice->id)}}"method="get">
                            @csrf
                            <div class="modal-body">

                                <p>Are you sure to delete this invoice? </p>
                                <input type="text"class="form-control"value="{{$invoice->client->client_name}}" readonly>

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
