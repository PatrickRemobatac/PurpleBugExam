<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Models\Expenses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpensesController extends Controller
{
    public function index_exp_cat(User $model)
    {
        return view('pages.expense_management.expense_cat');
    }

    public function index_expenses(User $model)
    {
        $expenses_data = DB::table('expenses')
            ->leftJoin('expense_categories','expense_categories.id','=','expenses.cat_id')
            ->select([
                'expenses.id as id',
                'expenses.expenses as expenses',
                'expenses.cat_id as cat_id',
                'expenses.entry_date as entry_date',
                'expenses.created_at as created_at',
                'expense_categories.category'
            ])
            ->where('user_id',Auth::user()->id)
            ->get();

        return view('pages.expense_management.expenses')->with(compact(['expenses_data']));
    }

    public function add_cat(Request $request)
    {

        $cat = new ExpenseCategory();
        $cat->category = $request->cat_name;
        $cat->description = $request->cat_desc;
        $cat->save();

        return response()->json([
            'response'      =>  'Category Successfully added!',
            'cat_name' =>  $cat->category,
            'cat_desc' =>  $cat->description,
            'cat_created' =>  $cat->created_at,
            'cat_id' =>  $cat->id,
        ]);

    }

    public function update_cat(Request $request)
    {

        $cat = ExpenseCategory::find($request->id);
        $cat->category = $request->cat_name;
        $cat->description = $request->cat_desc;
        $cat->update();


        return response()->json([
            'response'      =>  'Category Successfully updated!',
            'cat_name' =>  $cat->category,
            'cat_desc' =>  $cat->description]);

    }

    public function delete_cat(Request $request)
    {

        $cat = ExpenseCategory::find($request->id);

        $cat->delete();

        return response()->json([
            'response'      =>  'Category Successfully deleted!']);


    }

    public function add_expenses(Request $request)
    {

        $exp = new Expenses();
        $exp->user_id = Auth::user()->id;
        $exp->cat_id = $request->category;
        $exp->expenses = $request->amount;
        $exp->entry_date = $request->entry_date;
        $exp->save();

        return response()->json([
            'response'      =>  'Expenses Successfully added!',
            'exp_name' =>  $exp->category['category'],
            'exp_amount' =>  $exp->expenses,
            'exp_entry_date' =>  $exp->entry_date,
            'exp_created' =>  $exp->created_at,
            'exp_id' =>  $exp->id,
        ]);

    }

    public function update_expenses(Request $request)
    {

        $exp = Expenses::find($request->id);
        $exp->cat_id = $request->category;
        $exp->expenses = $request->amount;
        $exp->entry_date = $request->entry_date;
        $exp->update();


        return response()->json([
            'response'      =>  'Expenses Successfully updated!',
            'exp_category' =>  $exp->category['category'],
            'exp_amount' =>  $exp->expenses,
            'exp_entry' =>  $exp->entry_date
        ]);

    }

    public function delete_expenses(Request $request)
    {

        $exp = Expenses::find($request->id);

        $exp->delete();

        return response()->json([
            'response'      =>  'Expenses Successfully deleted!']);


    }

}
