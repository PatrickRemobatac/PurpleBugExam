@extends('layouts.app', ['page' => __('User Manage'), 'pageSlug' => 'users'])

<style>
    table#users_table {
        border-collapse: collapse;
    }
    #users_table tbody tr:hover {
        background-color: #ac31cc;
    }
    #users_table td:hover {
        cursor: pointer;
    }
</style>

@section('content')

            {{--<div {{ auth()->user()->role['role_name'] == 'Administrator' ? "" : 'hidden'}} class="card">--}}
                {{--<div class="card-header">--}}
                    {{--<h5 class="title">{{ __('Edit Profile') }}</h5>--}}
                {{--</div>--}}
                {{--<form method="post" action="{{ route('profile.update') }}" autocomplete="off">--}}
                    {{--<div class="card-body">--}}
                        {{--@csrf--}}
                        {{--@method('put')--}}
                        {{--<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">--}}
                            {{--<label>{{ __('Name') }}</label>--}}
                            {{--<input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}">--}}
                            {{--@include('alerts.feedback', ['field' => 'name'])--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">--}}
                            {{--<label>{{ __('Email address') }}</label>--}}
                            {{--<input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email', auth()->user()->email) }}">--}}
                            {{--@include('alerts.feedback', ['field' => 'email'])--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="card-footer">--}}
                        {{--<button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}


    @if(auth()->user()->role['role_name'] == 'Administrator')
    <div class="row">
        <div class="col-md-8">
            @include('alerts.success')
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Users') }}</h5>
                </div>

                <div class="card-body">
                    <table class="table tablesorter" id="users_table">
                        <thead class=" text-primary">
                        <tr>
                            <th hidden scope="col">ID</th>
                            <th scope="co2">Display Name</th>
                            <th scope="co3">Email Address</th>
                            <th scope="co4">Role</th>
                            <th scope="co5">Creation Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\Models\User::all() as $users)
                            <tr id="tr_id_{{$users->id}}">
                                <td hidden > <a id="a_table_users" name="{{$users->id}}||{{$users->name}}||{{$users->email}}||{{$users->role['id']}}">{{$users->id}}</a></td>
                                <td id="td_users_name_{{$users->id}}">{{$users->name}}</td>
                                <td id="td_users_email_{{$users->id}}">{{$users->email}}</td>
                                <td id="td_users_role_{{$users->id}}">{{$users->role['role_name']}}</td>
                                {{--<td><a href="mailto:{{$single_user->email}}">{{$single_user->email}}</a></td>--}}
                                <td>{{$users->created_at}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    <div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input hidden id="hidden_id" name="">
                                    <div class="row">
                                        <div class="col-md-6">Display Name</div>
                                        <div class="col-md-6"><input type="text" style="color: black" id="modal_update_user_disp_name" class="form-control"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Email:</div>
                                        <div class="col-md-6"><input type="text" style="color: black" id="modal_update_user_email" class="form-control"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Role:</div>
                                        <div class="col-md-6">
                                            <select style="color: black" id="modal_update_user_role" class="form-control">
                                                @foreach(\App\Models\Role::all() as $role)
                                                <option value="{{$role->id}}">{{$role->role_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="btn_delete_user" class="btn btn-danger">Delete</button>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" id="btn_update_user" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" style="margin-top: -100px" id="add_user_modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div style="margin: -10px; margin-bottom: -20px" class="modal-body">
                                    <div style="padding: 10px" class="card">
                                    <form method="post" action="{{ route('user_manage.register') }}" autocomplete="off">
                                            @csrf
                                            @method('put')

                                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="tim-icons icon-single-02"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}">
                                                    @include('alerts.feedback', ['field' => 'name'])
                                                </div>
                                                <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="tim-icons icon-email-85"></i>
                                                        </div>
                                                    </div>
                                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                                                    @include('alerts.feedback', ['field' => 'email'])
                                                </div>
                                                <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="tim-icons icon-lock-circle"></i>
                                                        </div>
                                                    </div>
                                                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}">
                                                    @include('alerts.feedback', ['field' => 'password'])
                                                </div>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="tim-icons icon-lock-circle"></i>
                                                        </div>
                                                    </div>
                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}">
                                                </div>
                                                <div class="input-group{{ $errors->has('role_id') ? ' has-danger' : '' }}">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="tim-icons icon-key-25"></i>
                                                        </div>
                                                    </div>
                                                    <select type="role_id" name="role_id" class="form-control">
                                                        @foreach(\App\Models\Role::all() as $role)
                                                            <option style="color: black" value="{{$role->id}}">{{$role->role_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @include('alerts.feedback', ['field' => 'role_id'])
                                                </div>
                                        <div class="card-footer col-md-12">
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-solid btn-primary">{{ __('Save') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    {{--</div>--}}
                                    </div>
                                </div>
                                {{--<div class="modal-footer">--}}
                                    {{--<button type="button" id="btn_delete_role" class="btn btn-danger">Delete</button>--}}
                                    {{--<div class="d-flex justify-content-end">--}}
                                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>--}}
                                        {{--<button type="button" id="btn_update_role" class="btn btn-primary">Update</button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end text-right">
                        <a href="#" data-toggle="modal" data-target="#add_user_modal" class="btn btn-sm btn-primary">Add User</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                <img class="avatar" src="{{ asset('black') }}/img/anime3.png" alt="">
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                            </a>
                            <p class="description">
                                {{auth()->user()->role['role_name']}}
                            </p>
                        </div>
                    </p>
                </div>
            <div class="card-footer">
                <div class="button-container">
                    <button class="btn btn-icon btn-round btn-facebook">
                        <i class="fab fa-facebook"></i>
                    </button>
                    <button class="btn btn-icon btn-round btn-twitter">
                        <i class="fab fa-twitter"></i>
                    </button>
                    <button class="btn btn-icon btn-round btn-google">
                        <i class="fab fa-google-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Password') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('alerts.success', ['key' => 'password_status'])

                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label>{{ __('Current Password') }}</label>
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label>{{ __('New Password') }}</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Confirm New Password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Change password') }}</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    @else
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('Password') }}</h5>
                    </div>
                    <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                        <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success', ['key' => 'password_status'])

                            <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                <label>{{ __('Current Password') }}</label>
                                <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                                @include('alerts.feedback', ['field' => 'old_password'])
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label>{{ __('New Password') }}</label>
                                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                                @include('alerts.feedback', ['field' => 'password'])
                            </div>
                            <div class="form-group">
                                <label>{{ __('Confirm New Password') }}</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-fill btn-primary">{{ __('Change password') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="card-body">
                        <p class="card-text">
                            <div class="author">
                                <div class="block block-one"></div>
                                <div class="block block-two"></div>
                                <div class="block block-three"></div>
                                <div class="block block-four"></div>
                                <a href="#">
                                    <img class="avatar" src="{{ asset('black') }}/img/anime3.png" alt="">
                                    <h5 class="title">{{ auth()->user()->name }}</h5>
                                </a>
                        <p class="description">
                            {{auth()->user()->role['role_name']}}
                        </p>
                    </div>
                    </p>
                </div>
                <div class="card-footer">
                    <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endif



    <script src="{{asset('jquery/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/users.js')}}"></script>

@endsection
