@extends('layouts.app')
@section('content')
<div class="container">
  
<div class="row mt-5">
    <h2>Dashboard Overview</h2>
    <div class="col">
       
        <div class="table-responsive">
            <div class="box box-primary">
                <div class="box-body">
            <table class="table table-striped" id="appliedartists-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Views</th>
                        <th>Orders</th>
                        <th>Succeed</th>
                        <th>failed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $value )
                    <tr>
                        <td>{{$value->day}}</td>
                        <td></td>
                        <td>{{$value->count}}</td>
                        <td>{{isset($completed[$index]) ? $completed[$index]->status : 0 }}</td>
                        <td>{{isset($failed[$index]) ? $failed[$index]->status : 0 }}</td>
                     </tr>
                    @endforeach
                  
                  
                </tbody>

            </table>

        </div>

    </div>
</div>
</div>
</div>
</div>
@endsection