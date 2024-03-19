<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
       
        $selectedCategory = $request->input('category');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $expenses = Expense::query();
    
        if ($selectedCategory) {
            $expenses->where('category_id', $selectedCategory);
        }
    
        if ($startDate && $endDate) {
            $expenses->whereBetween('date', [$startDate, $endDate]);
        }
    
        $expenses = $expenses->get();
    
        return view('expenses.index', compact('expenses', 'categories', 'selectedCategory', 'startDate', 'endDate'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $request->merge(['user_id' => $user_id]);
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        Expense::create($request->all());

        return redirect()->route('expenses.index')
                         ->with('success', 'Expense created successfully.');
    }

    public function edit(Expense $expense)
    {
        $categories = Category::all();
        return view('expenses.edit', compact('expense','categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $expense->update($request->all());

        return redirect()->route('expenses.index')
                         ->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')
                         ->with('success', 'Expense deleted successfully.');
    }

    public function expensesByCategory()
    {
        $expenses = Expense::select('category_id', DB::raw('SUM(amount) as total'))
                            ->groupBy('category_id')
                            ->get();
        $labels = [];
        $data = [];

        foreach ($expenses as $expense) {
          
            $expense_name = Category::where('id',$expense->category_id)->select('name')->first();
           
            $labels[] = $expense_name->name;
            $data[] = $expense->total;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

}
