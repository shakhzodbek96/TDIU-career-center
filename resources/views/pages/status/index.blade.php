@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Status</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item active">Statuses</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Statuses</h3>
                        @can('status.add')
                            <a href="{{ route('statusCreate') }}" class="btn btn-success btn-sm float-right">
                                <span class="fas fa-plus-circle"></span>
                                @lang('global.add')
                            </a>
                        @endcan
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Data table -->
                        <table id="dataTable" class="table dataTable dtr-inline table-responsive-lg" role="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Name</th>
                                <th class="w-25">@lang('global.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($statuses as $status)
                                <tr>
                                    <td>{{ $status->id }}</td>
                                    <td>{{ $status->name }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('statusDelete',$status->id) }}" method="post">
                                            @csrf
                                            <div class="btn-group">
                                                @can('status.edit')
                                                    <a href="{{ route('statusEdit',$status->id) }}" type="button" class="btn btn-info btn-sm"> @lang('global.edit')</a>
                                                @endcan
                                                @can('status.delete')
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="button" class="btn btn-danger btn-sm submitButton"> @lang('global.delete')</button>
                                                @endcan
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
