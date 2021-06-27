@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Guruhlarni boshqarish</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('groupIndex') }}">Guruh</a></li>
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

                        <form action="{{ route('groupUpdate',$group->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Guruh nomi</label>
                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? "is-invalid":"" }}" value="{{ old('name',$group->name) }}" required>
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>O'quv yili boshlanishi</label>
                                <input type="number" name="begin"  min="1900" max="2099" class="form-control {{ $errors->has('begin') ? "is-invalid":"" }}" value="{{ old('begin',$group->begin) }}" required>
                                @if($errors->has('begin'))
                                    <span class="text-danger">{{ $errors->first('begin') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>O'quv yili tugashi</label>
                                <input type="number"  min="1900" max="2099" name="end" class="form-control {{ $errors->has('end') ? "is-invalid":"" }}" value="{{ old('end',$group->end) }}" required>
                                @if($errors->has('end'))
                                    <span class="text-danger">{{ $errors->first('end') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Fakultet</label>
                                <select name="faculty_id" class="form-control {{ $errors->has('faculty_id') ? "is-invalid":"" }}">
                                    <option value="">Fakultetni tanlang</option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->id }}" @if(old('faculty_id',$group->faculty_id) == $faculty->id) selected @endif>{{ $faculty->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                                <a href="{{ route('groupIndex') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
