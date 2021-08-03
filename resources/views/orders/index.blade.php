@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left">Orders Requests</h1>
    <h1 class="pull-right">
        <a data-href="export_csv_orders" id="export" class="btn btn-success btn-sm" onclick="exportOrders(event.target);">Export to CSV</a>
    </h1>
</section>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Orders</li>
        <li class="breadcrumb-item" aria-current="page"><a href="/orders/{{$type}}">{{$type}}</a></li>
     
    </ol>
</nav>
<div class="row order-row">
    <a href="/orders/pending">
    <div class="col">
        <div class="card">
            <h5 class="card-header">{{$pending}}</h5>
            <div class="card-body">
            <h5 class="card-title">pending</h5>
            </div>
        </div>
    </div>
</a>
<a href="/orders/processing">
    <div class="col">
        <div class="card">
            <h5 class="card-header">{{$proccessing}}</h5>
            <div class="card-body">
            <h5 class="card-title">Proccessing</h5>
            </div>
        </div>
    </div>
    </a>
   <a href="/orders/delivering">
      <div class="col">
        <div class="card">
            <h5 class="card-header">{{$delivering}}</h5>
            <div class="card-body">
            <h5 class="card-title">Delivering</h5>
            </div>
        </div>
      </div>
    </a>
      <a href="/orders/completed">
      <div class="col">
        <div class="card">
            <h5 class="card-header">{{$completed}}</h5>
            <div class="card-body">
            <h5 class="card-title">Completed</h5>
            </div>
        </div>
      </div>
    </a>
      <a href="/orders/refunded">
      <div class="col">
        <div class="card">
            <h5 class="card-header">{{$refunded}}</h5>
            <div class="card-body">
            <h5 class="card-title">Refunded</h5>
            </div>
        </div>
      </div>
    </a>
      <a href="/orders/failed">
        <div class="col">
            <div class="card">
                <h5 class="card-header">{{$failed}}</h5>
                <div class="card-body">
                <h5 class="card-title">Failed</h5>
                </div>
        </div>
    </div>
    </a>
</div>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">

            <div class="table-responsive">
                <table class="table table-striped" id="appliedartists-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>

                            <th>Address</th>
                            <th>Apartment</th>
                            <th>City</th>
                            <th>PostCode</th>
                            <th>Goverment</th>

                            <th>Country</th>

                            {{-- <th>Payment-code</th> --}}
                            <th>payment-status</th>
                            <th>PromoCode</th>
                            <th>Payment method</th>
                            <th>Discount</th>
                            <th>TotalPrice</th>
                            {{-- <th>Payment Transaction REturn</th> --}}
                            <th>Date and time</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appliedartists as $appliedartist)
                        <tr>
                            <td>{{ $appliedartist->fname }} - {{ $appliedartist->lname }}</td>
                            <td>{{ $appliedartist->email }}</td>
                            <td>{{ $appliedartist->phonecode }}{{ $appliedartist->phone }}</td>

                            <td>{{ $appliedartist->address }}</td>
                            <td>{{ $appliedartist->apartment }}</td>
                            <td>{{ $appliedartist->city }}</td>
                            <td>{{ $appliedartist->postcode }}</td>
                            <td>{{ $appliedartist->goverment }}</td>
                            <td>{{ $appliedartist->country }}</td>
                            {{-- <td>{{ $appliedartist->paymentid }}</td> --}}
                            <td>{{ $appliedartist->paymentstatus }}</td>
                            <td>{{ $appliedartist->promocode }}</td>
                            <td>{{ $appliedartist->payment_method }}</td>
                            <td>{{ $appliedartist->discount }} %</td>

                            <td>{{ $appliedartist->totalprice }}</td>
                            {{-- <td>{{ $appliedartist->payment_transaction }}</td> --}}
                            <td>{{ $appliedartist->created_at }}</td>
                            <td>
                                
                                {!! Form::open(['route' => ['orders.refund', $appliedartist->id], 'method' =>
                                'put']) !!}
                                <div class='btn-group'>
                                    <a style="" href="{{ route('appliedorder.show', [$appliedartist->id]) }}"
                                        class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                        @if ($appliedartist->paymentstatus == 'Processing')
                                    {!! Form::button('<i class="glyphicon glyphicon-share-alt"></i>', ['type' =>
                                    'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you
                                    sure to refund ?')"]) !!}
                                      @endif
                                </div>
                                {!! Form::close() !!}
                              
                                {{-- <a style=" margin-left: 15px;" href="{{ route('appliedorder.show', [$appliedartist->id]) }}"
                                class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                                {!! Form::open(['route' => ['orders.complete', $appliedartist->id], 'method' =>
                                'put']) !!}
                                @if ($appliedartist->paymentstatus == 'Processing')
                                {{-- <div class='btn-group'>
                                    {!! Form::button('<i class="glyphicon glyphicon-saved"></i>', ['type' =>
                                    'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you
                                    sure to complete the order ?')"]) !!}
                                </div> --}}
                                <div class='btn-group'>
                                    <button class="btn btn-danger btn-xs" onclick="return clicked({!!$appliedartist->id!!})"><i class="glyphicon glyphicon-saved"></i></button>
                                </div>
                                @endif
                                {!! Form::close() !!}

                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                {{ $appliedartists->links() }}

            </div>

        </div>
    </div>
    <div class="text-center">

    </div>
</div>
<script>
    function clicked(id){
        var res = prompt('Please enter aramex tracking code');
        $.ajax({
        url: "/aramexcode/"+id+"/"+res,
        type: 'GET',
        success: function(res) {
            console.log(res);
            alert('successfully sent email and complete order!');
            return true;
        }
    });
        return true;
    }
</script>
@endsection
@section('css')
    <style>
        .order-row{
            width: 100%;
            margin-left: 0px;
            display: flex;
            padding: 20px;
        }
        .order-row .col{
            display: flex;
            width: 100%;
            flex-basis: 20%;
            background: white;
        }
        .order-row a{
            width: 20%;
            margin-left: 20px;
            color: black;
        }
        .order-row .card{
            width: 100%;

        }
       .order-row .card-header{
        background: #222d32;
        color: white;
        text-align: center;
        font-size: 40px;
       }
       .order-row h5{
        margin-top: 0px;
       }
       .card-body{
           text-align: center
       }
       .card-body h5 {
        text-align: center;
        font-size: 20px;

       }
  
       }
        </style>
@endsection
