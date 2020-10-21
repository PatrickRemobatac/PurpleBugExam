
<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('PB') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('Purple Bug Exam') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#user_management" aria-expanded="true">
                    <i class="tim-icons icon-bullet-list-67" ></i>
                    <span class="nav-link-text" >{{ __('User Management') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="user_management">
                    <ul class="nav pl-4">

                        <li @if ($pageSlug == 'role') class="active " @endif>
                            <a href="{{ route('user_manage.role')  }}">
                                {{--<i class="tim-icons icon-single-02"></i>--}}
                                <p>{{ __('Roles') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('user_manage.users')  }}">
                                {{--<i class="tim-icons icon-bullet-list-67"></i>--}}
                                <p>{{ __('Users') }}</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#expense_management" aria-expanded="true">
                    <i class="tim-icons icon-bullet-list-67" ></i>
                    <span class="nav-link-text" >{{ __('Expense Management') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="expense_management">
                    <ul class="nav pl-4">

                        <li @if ($pageSlug == 'expense_cat') class="active " @endif>
                            <a href="{{ route('expense_manage.expense_cat')  }}">
                                {{--<i class="tim-icons icon-single-02"></i>--}}
                                <p>{{ __('Expense Categories') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'expenses') class="active " @endif>
                            <a href="{{ route('expense_manage.expenses')  }}">
                                {{--<i class="tim-icons icon-bullet-list-67"></i>--}}
                                <p>{{ __('Expenses') }}</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>


            {{--<li @if ($pageSlug ?? '' ?? '' == 'icons') class="active " @endif>--}}
                {{--<a href="{{ route('pages.icons') }}">--}}
                    {{--<i class="tim-icons icon-atom"></i>--}}
                    {{--<p>{{ __('Icons') }}</p>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li @if ($pageSlug ?? '' ?? '' == 'maps') class="active " @endif>--}}
                {{--<a href="{{ route('pages.maps') }}">--}}
                    {{--<i class="tim-icons icon-pin"></i>--}}
                    {{--<p>{{ __('Maps') }}</p>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li @if ($pageSlug ?? '' ?? '' == 'notifications') class="active " @endif>--}}
                {{--<a href="{{ route('pages.notifications') }}">--}}
                    {{--<i class="tim-icons icon-bell-55"></i>--}}
                    {{--<p>{{ __('Notifications') }}</p>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li @if ($pageSlug ?? '' ?? '' == 'tables') class="active " @endif>--}}
                {{--<a href="{{ route('pages.tables') }}">--}}
                    {{--<i class="tim-icons icon-puzzle-10"></i>--}}
                    {{--<p>{{ __('Table List') }}</p>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li @if ($pageSlug ?? '' ?? '' ?? '' == 'typography') class="active " @endif>--}}
                {{--<a href="{{ route('pages.typography') }}">--}}
                    {{--<i class="tim-icons icon-align-center"></i>--}}
                    {{--<p>{{ __('Typography') }}</p>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li @if ($pageSlug ?? '' ?? '' ?? '' == 'rtl') class="active " @endif>--}}
                {{--<a href="{{ route('pages.rtl') }}">--}}
                    {{--<i class="tim-icons icon-world"></i>--}}
                    {{--<p>{{ __('RTL Support') }}</p>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class=" {{ $pageSlug ?? '' ?? '' ?? '' == 'upgrade' ? 'active' : '' }} bg-info">--}}
                {{--<a href="{{ route('pages.upgrade') }}">--}}
                    {{--<i class="tim-icons icon-spaceship"></i>--}}
                    {{--<p>{{ __('Upgrade to PRO') }}</p>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
    </div>
</div>