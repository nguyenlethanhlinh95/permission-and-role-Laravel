@extends('layout.admin.master')

@section('header')
    Edit Role <span><a href="{{ route('user.create') }}">Add new</a></span>
@endsection

@section('content')
@section('header')
    Edit Role
@endsection
<div class="row">
    {!! Form::model($role, ['method'=>'PATCH', 'action'=> ['Admin\RoleController@update', $role->id], 'files'=>true]) !!}
    <div class="col-lg-9">

        <div class="">
            <p><a href="{{ route('role.index') }}">Back List role</a></p>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Role
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input value="{{ $role->name }}" class="form-control" name="name" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label>Display name</label>
                            <input type="text" value="{{ $role->display_name }}" class="form-control" name="display_name" placeholder="Display Name">
                        </div>

                        @forelse($permissions as $per)
                            <div class="form-check">
                                <input
                                        type="checkbox"
                                       class="form-check-input"
                                        name="permission[]"
                                        @if (!$permissions_of_role->isEmpty())
                                            {{ $permissions_of_role->contains($per->id)? 'checked': '' }}
                                        @endif
                                        value="{{ $per->id }}">
                                <label class="form-check-label">{{ $per->display_name }}</label>
                            </div>
                        @empty

                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-3">
        <div class="">
            <div class="panel panel-default panel_custom">
                <div class="panel-heading">
                    <span>Đăng</span>
                    <span class="icon_right">
                            <i class="fa fa-caret-down fa-2x" aria-hidden="true"></i>
                        </span>

                </div>
                <div class="panel-body">
                    <input type="submit" value="Submit" class="btn btn-primary">

                </div>
            </div>
        </div>

    </div>

    {{ Form::close() }}
</div>
@endsection
