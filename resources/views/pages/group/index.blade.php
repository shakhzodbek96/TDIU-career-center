@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Guruh</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item active">Guruhlar</li>
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
                        <h3 class="card-title">Guruhlar</h3>
                        @can('group.add')
                            <a href="{{ route('groupCreate') }}" class="btn btn-success btn-sm float-right">
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
                                <th>Guruh nomi</th>
                                <th>O'quv yili</th>
                                <th>Studentlar soni</th>
                                <th>Fakultet</th>
                                <th style="width: 50px" class="text-center">@lang('global.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->name }}</td>
                                    <td>{{ $group->studyYears() }}</td>
                                    <td>{{ $group->students_count }}</td>
                                    <td>{{ $group->faculty->name ?? '-' }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('groupDelete',$group->id) }}" method="post">
                                            @csrf
                                            <div class="btn-group">
                                                @can('group.edit')
                                                    <a href="{{ route('groupEdit',$group->id) }}" type="button" class="btn btn-info btn-sm"> @lang('global.edit')</a>
                                                @endcan
                                                @can('group.delete')
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
