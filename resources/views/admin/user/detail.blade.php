@extends('layout.admin.master')

@section('header')
    Edit User <span><a href="{{ route('user.create') }}">Add new</a></span>
@endsection

@section('content')
@section('header')
    Edit User
@endsection
<div class="row">
    {!! Form::model($user, ['method'=>'PATCH', 'action'=> ['Admin\UserController@update', $user->id], 'files'=>true]) !!}
    <div class="col-lg-9">

        <div class="">
            <p><a href="{{ route('user.index') }}">Back List user</a></p>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Edit User
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input value="{{ $user->name }}" class="form-control" name="name" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" value="{{ $user->email }}" class="form-control" name="email" placeholder="email">
                        </div>

                        <div class="form-group">
                            <label for="sel1">Select list:</label>
                            <select name="role[]" class="form-control" id="role" multiple>
                                {{--foreach ($user_role->roles as $r)--}}
                                {{--{--}}
                                {{--echo $r->pivot->role_id;--}}
                                {{--}--}}
                                @forelse($roles as $role)
                                    <option value="{{ $role->id }}"
                                          @foreach ($user_role as $rol)
                                              @if ($role->id == $rol->pivot->role_id)
                                                  {{ 'selected' }}
                                              @endif
                                          @endforeach
                                            {{--{{ $user_role->contains($role->id) }}--}}
                                    >{{ $role->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
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
