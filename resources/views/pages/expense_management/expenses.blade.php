@extends('layouts.app', ['page' => __('Expenses'), 'pageSlug' => 'expenses'])


<style>
    table#expenses_table {
        border-collapse: collapse;
    }
    #expenses_table tbody tr:hover {
        background-color: #ac31cc;
    }
    #expenses_table td:hover {
        cursor: pointer;
    }
</style>


@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="card-title">Add Expenses</h4>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                            @include('alerts.success')

                            <div class="modal fade" id="add_expenses_modal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Expenses</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">Display Name</div>
                                                <div class="col-md-6">
                                                    <select type="text" style="color: black" id="modal_add_expenses_disp_name" class="form-control">
                                                        @foreach(\App\Models\ExpenseCategory::all() as $cat)
                                                            <option style="color: black" value="{{$cat->id}}">{{$cat->category}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Amount</div>
                                                <div class="col-md-6"><input type="number" style="color: black" id="modal_add_expenses_amount" class="form-control"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Entry Date</div>
                                                <div class="col-md-6"><input type="date" style="color: black" id="modal_add_expenses_entry_date" class="form-control"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-end">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" id="btn_add_expenses" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="update_expenses_modal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Expenses</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">Display Name</div>
                                                <div class="col-md-6">
                                                    <select type="text" style="color: black" id="modal_delete_expenses_disp_name" class="form-control">
                                                        @foreach(\App\Models\ExpenseCategory::all() as $cat)
                                                            <option style="color: black" value="{{$cat->id}}">{{$cat->category}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <input hidden id="hidden_id" name="">
                                                <div class="col-md-6">Amount</div>
                                                <div class="col-md-6"><input type="number" style="color: black" id="modal_delete_expenses_amount" class="form-control"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Entry Date</div>
                                                <div class="col-md-6"><input type="date" style="color: black" id="modal_delete_expenses_entry_date" class="form-control"></div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" id="btn_delete_expenses" class="btn btn-danger">Delete</button>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" id="btn_update_expenses" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <table class="table tablesorter" id="expenses_table">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th hidden scope="col">ID</th>
                                        <th scope="co2">Expenses Category</th>
                                        <th scope="co3">Amount</th>
                                        <th scope="co4">Entry Date</th>
                                        <th scope="co5">Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($expenses_data as $exp)
                                        <tr id="tr_id_{{$exp->id}}">
                                            <td hidden > <a id="a_table_expenses" name="{{$exp->id}}||{{$exp->cat_id}}||{{$exp->expenses}}||{{$exp->entry_date}}">{{$exp->id}}</a></td>
                                            <td id="td_expenses_name_{{$exp->id}}">{{$exp->category}}</td>
                                            <td id="td_expenses_amount_{{$exp->id}}">${{$exp->expenses}}</td>
                                            <td id="td_expenses_entry_{{$exp->id}}">{{$exp->entry_date}}</td>
                                            <td>{{$exp->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right">
                                <a href="#" data-toggle="modal" data-target="#add_expenses_modal" class="btn btn-sm btn-primary">Add Expenses</a>
                            </div>
                        </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('jquery/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/expenses.js')}}"></script>

@endsection
