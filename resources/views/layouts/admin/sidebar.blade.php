<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Principale</li>
                @can('owner',\App\Admin::class)
                    <li class="{{ (request()->is('company') || request()->is('company/*')) ? 'active' : '' }}">
                        <a href="{{ route('company.index') }}"><i class="fa fa-building-o"></i> Companies</a>
                    </li>
                @endcan
                <li class="{{ (request()->is('admin') || request()->is('admin/*')) ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}"><i class="fa fa-users"></i> {{ __('admin/admin.admins') }}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
