<?php

namespace App\Rules;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\Rule;

class CategoryPrefix implements Rule
{

    public function passes($attribute, $value)
    {
        // Get all category names from the Category table
        $categories = Category::where('category_type_id',5)->pluck('category_name')->toArray();

        // Check if $value starts with any category name followed by a space
        foreach ($categories as $categoryName) {
            if (str_starts_with($value, $categoryName . ' ')) {
                return true;
            }
        }
        return false;
    }

    public function message()
    {
        return 'The :attribute must start with a valid category name followed by a space.';
    }
}
