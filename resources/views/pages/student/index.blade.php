@extends('layouts.admin')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item active">Student</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('global.cards')</h3>
                            <span class="badge badge-light">@lang('global.amount') : {{ nf($students->total()) ?? 0 }}</span>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" name="filter" value="1" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#filter-modal"><i class="fas fa-filter"></i> @lang('global.filter')</button>

                                    <div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="filters" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">@lang('global.filter')</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="get">
                                                    <div class="modal-body">
                                                        {{--firstname--}}
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>Ism</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm" name="firstname_operator">
                                                                    <option value="like" {{ request()->firstname_operator == 'like' ? 'selected':'' }}> LIKE </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <input class="form-control form-control-sm" type="text" name="firstname" value="{{ old('firstname',request()->firstname??'') }}">
                                                            </div>
                                                        </div>
                                                        {{--lastname--}}
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>Ism</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm" name="lastname_operator">
                                                                    <option value="like" {{ request()->lastname_operator == 'like' ? 'selected':'' }}> LIKE </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <input class="form-control form-control-sm" type="text" name="lastname" value="{{ old('lastname',request()->lastname??'') }}">
                                                            </div>
                                                        </div>
                                                        {{--middlename--}}
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>Ism</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm" name="middlenaame_operator">
                                                                    <option value="like" {{ request()->middlenaame_operator == 'like' ? 'selected':'' }}> LIKE </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <input class="form-control form-control-sm" type="text" name="middlenaame" value="{{ old('middlenaame',request()->middlenaame??'') }}">
                                                            </div>
                                                        </div>

                                                        {{--phone--}}
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>@lang('global.phone')</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm" name="phone_operator">
                                                                    <option value="like" {{ request()->phone_operator == 'like' ? 'selected':'' }}> LIKE </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <input class="form-control form-control-sm" type="text" name="phone" value="{{ old('phone',request()->phone??'') }}">
                                                            </div>
                                                        </div>

                                                        {{--Birth date--}}
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>Tug'ilgan sana</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm" name="birth_date_operator">
                                                                    <option value="like" {{ request()->birth_date_operator == 'like' ? 'selected':'' }}> LIKE </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <input class="form-control form-control-sm" type="text" name="birth_date" value="{{ old('birth_date',request()->birth_date??'') }}">
                                                            </div>
                                                        </div>

                                                        {{--Faculties--}}
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>Fakultet</h6>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="hidden" name="faculty_id_operator" value="wherein">
                                                                <select class="select2" multiple="multiple" name="faculty_id[]" data-placeholder="@lang('pleaseSelect')" style="width: 100%;">
                                                                    @foreach($faculties as $faculty)
                                                                        <option value="{{ $faculty->id }}" @if(is_array(request()->faculty_id) && in_array($faculty->id,request()->faculty_id)) selected @endif>{{ $faculty->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        {{--Groups--}}
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>Guruhlar</h6>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="hidden" name="group_id_operator" value="wherein">
                                                                <select class="select2" multiple="multiple" name="group_id[]" data-placeholder="@lang('pleaseSelect')" style="width: 100%;">
                                                                    @foreach($groups as $group)
                                                                        <option value="{{ $group->id }}" @if(is_array(request()->group_id) && in_array($group->id,request()->group_id)) selected @endif>{{ $group->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        {{--Statuses--}}
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>Statuslar</h6>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="hidden" name="status_id_operator" value="wherein">
                                                                <select class="select2" multiple="multiple" name="status_id[]" data-placeholder="@lang('pleaseSelect')" style="width: 100%;">
                                                                    @foreach($statuses as $status)
                                                                        <option value="{{ $status->id }}" @if(is_array(request()->status_id) && in_array($status->id,request()->status_id)) selected @endif>{{ $status->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" name="filter" class="btn btn-primary">Qidirish</button>
{{--                                                        <button type="button" class="btn btn-outline-warning float-left pull-left" id="reset_form">@lang('global.clear')</button>--}}
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Yopish</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{ route('studentIndex') }}" class="btn btn-secondary btn-sm"><i class="fa fa-redo-alt"></i> @lang('global.clear')</a>
                                    @can('student.add')
                                        <a href="{{ route('studentCreate') }}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> @lang('global.add')</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr class="text-center">
                                    <th>#ID</th>
                                    <th>FIO</th>
                                    <th>Telefon</th>
                                    <th>Tug'ilgan sana</th>
                                    <th>Guruhi</th>
                                    <th>Fakultet</th>
                                    <th colspan="2">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->fio() }}</td>
                                        <td>{{ $student->phone }}</td>
                                        <td>{{ $student->birth_date }}</td>
                                        <td>{{ $student->group->name ?? '-' }}</td>
                                        <td>{{ $student->faculty->name ?? '-' }}</td>
                                        <td>{{ $student->status->name ?? '-' }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $students->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
