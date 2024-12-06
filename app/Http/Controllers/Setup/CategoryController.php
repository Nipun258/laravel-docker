<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth'
        ];
    }


    public function CategoryIndex()
    {
        Gate::authorize('category.list');
        $categories = Category::join('category_types', 'category_types.id', '=', 'categories.category_type_id')
            ->select('categories.*', 'category_types.name')
            ->get();

        return view('admin.setups.category.index', compact('categories'));
    }

    public function CategoryAdd()
    {
        Gate::authorize('category.create');
        $category_type = CategoryType::all();
        return view('admin.setups.category.add', compact('category_type'));
    }

    public function CategoryStore(Request $request)
    {
        Gate::authorize('category.create');

        $validatedData = $request->validate([
            'category_name' => 'required',
        ]);

        $data = new Category();
        $data->category_name = ucwords($request->category_name);
        $data->category_type_id = $request->category_type_name;
        $data->category_code = $request->category_code;
        /******************************************************/
        $maxnumber = Category::where('category_type_id', $request->category_type_name)
                    ->select(DB::raw('MAX(sorting_order) as value'))
                    ->get();

        $maxValue = json_decode($maxnumber, true);
        $sortnumber = $maxValue[0]["value"] + 1;
        /*******************************************************/
        $data->sorting_order = $sortnumber;
        $data->created_at = Carbon::now();
        $data->save();

        $notification = array(
            'message' => 'New Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category.index')->with($notification);
    }

    public function CategoryEdit($id)
    {
        Gate::authorize('category.updation');
        $editData = Category::find($id);
        $categoryTypes = CategoryType::all();
        return view('admin.setups.category.edit', compact('editData', 'categoryTypes'));
    }

    public function CategoryUpdate(Request $request, $id)
    {
        Gate::authorize('category.updation');

        $validatedData = $request->validate([
            'category_name' => ['required', Rule::unique('categories')->ignore($id)],
        ]);

        $data = Category::find($id);
        $data->category_name = ucwords($request->category_name);
        $data->category_code = $request->category_code;
        $data->save();

        $notification = array(
            'message' => 'Category Name Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('category.index')->with($notification);
    }


    public function CategoryDelete($id)
    {
        Gate::authorize('category.delete');

        $catagory = Category::find($id);
        $catagory->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->route('category.index')->with($notification);
    }
}
