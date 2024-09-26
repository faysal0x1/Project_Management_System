@php
    $role = auth()->user()->roles()->first()->name ?? 'guest';
@endphp

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('site/logo.png') }}" class="logo-ic w-75" alt="logo icon">
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route($role . '.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i></div>
                    <div class="menu-title">Employee Management</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route($role . '.employee.index') }}"><i class="bx bx-right-arrow-alt"></i>List of Employees</a>
                    </li>
                    <li>
                        <a href="{{ route($role . '.employee.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Employee</a>
                    </li>
                </ul>
            </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i></div>
                <div class="menu-title">Posts</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route($role . '.post.index') }}"><i class="bx bx-right-arrow-alt"></i>List of Posts</a>
                </li>
                <li>
                    <a href="{{ route($role . '.post.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Post</a>
                </li>
            </ul>
        </li>

            <li class="menu-label">Settings</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i></div>
                    <div class="menu-title">Settings</div>
                </a>
                <ul>
                        <li>
                            <a href="{{ url('/laratrust') }}"><i class="bx bx-right-arrow-alt"></i>Role Assignment</a>
                        </li>
                </ul>
            </li>

        @permission('can_see_user')
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i></div>
                    <div class="menu-title">Users</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route($role . '.user.index') }}"><i class="bx bx-right-arrow-alt"></i>List of Users</a>
                    </li>
                    @permission('can_add_user')
                        <li>
                            <a href="{{ route($role . '.user.create') }}"><i class="bx bx-right-arrow-alt"></i>Add User</a>
                        </li>
                    @endpermission
                </ul>
            </li>
        @endpermission
    </ul>
</div>
