<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index() {
        $budgets = Budget::all();
        return view('finance.budget.index', compact('budgets'));
    }

    public function create() {
        return view('finance.budget.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_budget' => 'required|unique:budgets,id_budget',
            'detail' => 'required|string|max:255',
            'volume' => 'required|integer',
            'unit' => 'required|string|max:100',
            'amount' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['total'] = $request->volume * $request->amount;

        Budget::create($data);

        return redirect()->route('budgets.index')
                        ->with('success', 'Data anggaran berhasil disimpan!');
    }

    public function edit($id)
    {
        $budget = Budget::findOrFail($id);
        return view('finance.budget.edit', compact('budget'));
    }
    public function update(Request $request, $id)
    {
        $budget = Budget::findOrFail($id);

        $request->validate([
            'id_budget' => 'required|unique:budgets,id_budget,'.$budget->id,
            'detail' => 'required|string|max:255',
            'volume' => 'required|integer',
            'unit' => 'required|string|max:100',
            'amount' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $budget->update($request->all());

        return redirect()->route('budgets.index')
                        ->with('success', 'Data anggaran berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $budget = Budget::findOrFail($id);
        $budget->delete();

        return redirect()->route('budgets.index')
                        ->with('success', 'Data anggaran berhasil dihapus!');
    }
}
