@extends('layouts.app', ['page' => __('Expense Categories'), 'pageSlug' => 'expense_cat'])

<style>
    table#cat_table {
        border-collapse: collapse;
    }
    #cat_table tbody tr:hover {
        background-color: #ac31cc;
    }
    #cat_table td:hover {
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
                                <h4 class="card-title">Expense Categories</h4>
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->role['role_name'] == 'Administrator')
                    <div class="card-body">
                        <div class="">
                            <table class="table tablesorter" id="cat_table">
                                <thead class=" text-primary">
                                <tr>
                                    <th hidden scope="col">ID</th>
                                    <th scope="co2">Display Name</th>
                                    <th scope="co3">Description</th>
                                    <th scope="co4">Creation Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\Models\ExpenseCategory::all() as $cat)
                                    <tr id="tr_id_{{$cat->id}}">
                                        <td hidden > <a id="a_table_role" name="{{$cat->id}}||{{$cat->category}}||{{$cat->description}}">{{$cat->id}}</a></td>
                                        <td id="td_cat_name_{{$cat->id}}">{{$cat->category}}</td>
                                        <td id="td_cat_desc_{{$cat->id}}">{{$cat->description}}</td>
                                        <td>{{$cat->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="expense_cat_add_modal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">Display Name</div>
                                                <div class="col-md-6"><input type="text" style="color: black" id="modal_cat_disp_name" class="form-control"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Description</div>
                                                <div class="col-md-6"><input type="text" style="color: black" id="modal_cat_desc" class="form-control"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-end">
                                            {{--<button type="button" id="btn_delete_role" class="btn btn-danger">Delete</button>--}}
                                            <div class="">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" id="btn_add_cat" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="expense_cat_update_modal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input hidden id="hidden_id" name="">
                                            <div class="row">
                                                <div class="col-md-6">Display Name</div>
                                                <div class="col-md-6"><input type="text" style="color: black" id="modal_cat_update_disp_name" class="form-control"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Description</div>
                                                <div class="col-md-6"><input type="text" style="color: black" id="modal_cat_update_desc" class="form-control"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="btn_delete_cat" class="btn btn-danger">Delete</button>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" id="btn_update_cat" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @else
                        <div class="card-body">
                            <h4 class="card-title">You dont have enough permission.</h4>
                        </div>
                    @endif
                    <div class="card-footer py-4">
                        <div class="text-right">
                            <a href="#" data-toggle="modal" data-target="#expense_cat_add_modal" class="btn btn-sm btn-primary">Add Category</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('jquery/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/exp_cat.js')}}"></script>

@endsection
