@extends('layout.admin.master')

@section('header')
    Users <span><a href="{{ route('user.create') }}">Add new</a></span>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List Users
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th width="25px" class="text-center">
                                        <input id="cb-select-all-1" type="checkbox">
                                    </th>
                                    <th width="300px">
                                        <span>Name</span>
                                    </th>
                                    {{--<th width="150px">--}}
                                        {{--<span>Author</span>--}}
                                    {{--</th>--}}
                                    <th width="150px">
                                        <span>Email</span>
                                    </th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$users->isEmpty())
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox">
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            {{--<td>Thanh Linh</td>--}}
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{ route('user.edit', ['id'=>$user->id]) }}" title="Edit">
                                                    <i class="fa fa-pencil" aria-hidden="true">

                                                    </i>
                                                </a> |
                                                <a href="{{ route('user.show', ['id'=>$user->id]) }}" title="Delete">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            Data not found
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="pagination text-center" style="margin: 0 auto; display: block;">
                            {{ $users->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

