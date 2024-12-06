<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeTypeStoreRequest;
use App\Models\IncomeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class IncomeTypeController extends Controller
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function IncomeTypeIndex()
    {
        Gate::authorize('income.type.list');
        $data = IncomeType::all();

        return view('admin.setups.income_type.index', compact('data'));
    }

    public function IncomeTypeAdd()
    {
        Gate::authorize('income.type.create');
        return view('admin.setups.income_type.add');
    }

    public function IncomeTypeStore(IncomeTypeStoreRequest $request)
    {
        Gate::authorize('income.type.create');
        IncomeType::create($request->prepareData());

        $notification = array(
            'message' => 'Income Type Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('income.type.index')->with($notification);
    }

    public function IncomeTypeEdit($id)
    {
        Gate::authorize('income.type.updation');
        $incomeTypeId = decrypt($id);
        $editData = IncomeType::find($incomeTypeId);
        return view('admin.setups.income_type.edit', compact('editData'));
    }

    public function IncomeTypeUpdate(IncomeTypeStoreRequest $request, $id)
    {
        Gate::authorize('income.type.updation');
        $request->persist($id);

        $notification = array(
            'message' => 'Income Type data Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('income.type.index')->with($notification);
    }

    public function IncomeTypeDelete($id)
    {
        Gate::authorize('income.type.delete');
        $incomeTypeId = decrypt($id);
        $data = IncomeType::find($incomeTypeId);
        $data->delete();

        $notification = array(
            'message' => 'Income Type Permenetly Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->route('income.type.index')->with($notification);
    }
}
