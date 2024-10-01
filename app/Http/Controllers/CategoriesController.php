<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function categories()
    {
        return view("admin.categories.categories");
    }

    public function reorder(Request $request)
    {
        $order = $request->query('ids');
        $ids = explode(',', $order);
        foreach ($ids as $index => $id) {
            $category = categories::find($id);
            if ($category) {
                $category->order_column = $index + 1;
                $category->save();
            }
        }
        return response()->json(['success' => true]);
    }

}
