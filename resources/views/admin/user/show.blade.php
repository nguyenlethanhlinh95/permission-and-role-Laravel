@extends('layout.admin.master')

@section('header')
    Show User
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="fomr">
            {!! Form::model($user, ['method'=>'Delete', 'action'=> ['Admin\UserController@destroy', $user->id]]) !!}
                <div>
                    <p>Are you deleting?</p>


                    <input type="submit" value="OK" class="btn btn-warning">


                    <a href="{{ route('user.index') }}" class="btn btn-primary">Cancel</a>
                </div>
            <br>
            {!! Form::close() !!}
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Detail page
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>User name</label>
                            <input value="{{ $user->name  }}" class="form-control" required minlength="5" name="name" placeholder="Name" />
                        </div>

                        <div class="form-group">
                            <label>User email</label>
                            <input value="{{ $user->email }}" id="email" class="form-control" name="email" placeholder="Email" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
