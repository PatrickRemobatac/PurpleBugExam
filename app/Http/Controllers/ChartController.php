<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    //
    public function get_data()
    {

        $expenses_data = DB::table('expenses')
            ->leftJoin('expense_categories','expense_categories.id','=','expenses.cat_id')
            ->select([
                DB::raw('sum(expenses.expenses) as total'),
//                'expenses.expenses as expenses',
                'expense_categories.category as category'
            ])
            ->where('expenses.user_id',Auth::user()->id)
            ->groupBy('expenses.cat_id')
            ->get();

        return response()->json(['data' => $expenses_data]);

    }
}
