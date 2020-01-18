@extends('layout.admin.master')

@section('header')
    Create Role
@endsection

@section('content')
    @section('header')
        Add New Role
    @endsection
    <div class="row">
        {!! Form::open(['route'=> 'role.store', 'method' => 'post', 'files'=> 'true' ]) !!}
        <div class="col-lg-9">

            <div class="">
                <p><a href="{{ route('role.index') }}">Back List Role</a></p>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New Role
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input value="{{ old('name') }}" class="form-control" name="name" placeholder="Name">
                            </div>

                            <div class="form-group">
                                <label>Display Name</label>
                                <input value="{{ old('display_name') }}" class="form-control" name="display_name" placeholder="Display Name">
                            </div>

                            @forelse($permissions as $per)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="permission[]" value="{{ $per->id }}">
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