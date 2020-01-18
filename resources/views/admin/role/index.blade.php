@extends('layout.admin.master')

@section('header')
    Roles <span><a href="{{ route('role.create') }}">Add new</a></span>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List Roles
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
                                        <span>Display Name</span>
                                    </th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$roles->isEmpty())
                                    @foreach($roles as $role)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox">
                                            </td>
                                            <td>{{ $role->name }}</td>
                                            {{--<td>Thanh Linh</td>--}}
                                            <td>{{ $role->display_name }}</td>
                                            <td>
                                                <a href="{{ route('role.edit', ['id'=>$role->id]) }}" title="Edit">
                                                    <i class="fa fa-pencil" aria-hidden="true">

                                                    </i>
                                                </a> |
                                                <a href="{{ route('user.show', ['id'=>$role->id]) }}" title="Delete">
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
                            {{ $roles->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

