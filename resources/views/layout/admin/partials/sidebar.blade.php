<ul class="nav" id="side-menu">
    <li class="sidebar-search">
        <div class="input-group custom-search-form">
            <input type="text" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
        <!-- /input-group -->
    </li>
    <li>
        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Users<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="{{ route('user.index') }}">All users</a>
            </li>
            <li>
                <a href="{{ route('user.create') }}">Add new</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>

    <li>
        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Roles<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="{{ route('role.index') }}">All roles</a>
            </li>
            <li>
                <a href="{{ route('role.create') }}">Add new</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>

</ul>