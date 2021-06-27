@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Studentlarni boshqarish</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('studentIndex') }}">Student</a></li>
                        <li class="breadcrumb-item active">@lang('global.add')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('global.add')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('studentStore') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Ism</label>
                                <input type="text" name="firstname" class="form-control {{ $errors->has('firstname') ? "is-invalid":"" }}" value="{{ old('firstname') }}" required>
                                @if($errors->has('firstname'))
                                    <span class="text-danger">{{ $errors->first('firstname') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Familiya</label>
                                <input type="text" name="lastname" class="form-control {{ $errors->has('lastname') ? "is-invalid":"" }}" value="{{ old('lastname') }}" required>
                                @if($errors->has('lastname'))
                                    <span class="text-danger">{{ $errors->first('lastname') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Otasining ismi</label>
                                <input type="text" name="middlename" class="form-control {{ $errors->has('middlename') ? "is-invalid":"" }}" value="{{ old('middlename') }}" required>
                                @if($errors->has('middlename'))
                                    <span class="text-danger">{{ $errors->first('middlename') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Tug'ilgan sana</label>
                                <input type="date" name="birth_date"  class="form-control {{ $errors->has('birth_date') ? "is-invalid":"" }}" value="{{ old('birth_date') }}">
                                @if($errors->has('birth_date'))
                                    <span class="text-danger">{{ $errors->first('birth_date') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Telefon raqam</label>
                                <input type="text" name="phone"  class="form-control {{ $errors->has('phone') ? "is-invalid":"" }}" value="{{ old('phone') }}">
                                @if($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Fakultet</label>
                                <select name="faculty_id" class="form-control {{ $errors->has('faculty_id') ? "is-invalid":"" }}">
                                    <option value="">Fakultetni tanlang</option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->id }}" @if(old('faculty_id') == $faculty->id) selected @endif>{{ $faculty->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Guruh</label>
                                <select name="group_id" class="form-control {{ $errors->has('group_id') ? "is-invalid":"" }}">
                                    <option value="">Guruhni tanlang</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}" @if(old('group_id') == $group->id) selected @endif>{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status_id" class="form-control {{ $errors->has('status_id') ? "is-invalid":"" }}">
                                    <option value="">Fakultetni tanlang</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" @if(old('status_id') == $status->id) selected @endif>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                                <a href="{{ route('studentIndex') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
