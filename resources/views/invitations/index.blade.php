@extends('layouts.app')

@section('content')

<section class="content-header">
    <h1 class="pull-left">Invitations</h1>
    <h1 class="pull-right">
        <a data-href="export_csv" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export to CSV</a>    
    </h1>
</section>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/invitations-show">Invitations</a></li>
    </ol>
</nav>
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
                    <th >Country</th>
                    <th >Programs</th>
                </tr>
            </thead>
            <tbody>
            @forelse($invitations as $invite)
                <tr>
                    <td>{{ $invite->name }} </td>
                    <td>{{ $invite->email }}</td>
                    <td>{{ $invite->phone }}</td>
                    <td>{{ $invite->country }}</td>
                    <td>{{ $invite->programs }}</td>
                </tr>
            @empty
                <tr>
                    No invitations yet !
                </tr>
            @endforelse
            </tbody>
        </table>
</div>

        </div>
    </div>
    <div class="text-center">

    </div>
</div>
@endsection

