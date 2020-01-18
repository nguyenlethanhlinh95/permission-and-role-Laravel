@extends('layout.admin.master')

@section('header')
    Create User
@endsection

@section('content')
    @section('header')
        Add New User
    @endsection
    <div class="row">
        {!! Form::open(['route'=> 'user.store', 'method' => 'post', 'files'=> 'true' ]) !!}
        <div class="col-lg-9">

            <div class="">
                <p><a href="{{ route('user.index') }}">Back List User</a></p>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New User
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input value="{{ old('name') }}" class="form-control" name="name" placeholder="Name">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" value="{{ old('email') }}" class="form-control" name="email" placeholder="email">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" value="{{ old('password') }}" class="form-control" name="password" placeholder="password">
                            </div>

                            <div class="form-group">
                                <label>Repassword</label>
                                <input type="password" value="{{ old('password_confirmation') }}" class="form-control" name="password_confirmation" placeholder="Repassword">
                            </div>

                            <div class="form-group">
                                <label for="sel1">Select list:</label>
                                <select name="role[]" class="form-control" id="role" multiple>
                                    @forelse($roles as $role)
                                        <option value="{{ $role->id }}"
                                                {{in_array($role->id, old("role") ?: []) ? "selected": ""}}
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

            {{--<div class="">--}}
                {{--<div class="panel panel-default panel_custom">--}}
                    {{--<div class="panel-heading">--}}
                        {{--<span>Featured Image</span>--}}
                        {{--<span class="icon_right">--}}
                            {{--<i class="fa fa-caret-down fa-2x" aria-hidden="true"></i>--}}
                        {{--</span>--}}

                    {{--</div>--}}
                    {{--<div class="panel-body">--}}
                        {{--<div class="form-group">--}}
                            {{--{{ Form::file('image',array('class' => 'form-control', 'name'=>'image')) }}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>

        {{ Form::close() }}
    </div>
@endsection


@section('js')
    <script>
        var editor = CKEDITOR.replace( 'editor' );
    </script>
@stop