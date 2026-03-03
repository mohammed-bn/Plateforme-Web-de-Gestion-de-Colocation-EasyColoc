<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $colocation = Colocation::findOrFail($request->colocation_id);
        
       
        $isOwner = $colocation->users()
            ->where('user_id', auth()->id())
            ->wherePivot('role', 'owner')
            ->exists();

        if (!$isOwner) {
            return redirect()->back()->with('error', 'Seul le propriétaire peut gérer les catégories.');
        }

        Category::create([
            'title' => $request->title,
            'colocation_id' => $request->colocation_id,
        ]);
        return redirect()->back()
            ->with('success', 'Category created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $colocation = $category->colocation;
        
        $isOwner = $colocation->users()
            ->where('user_id', auth()->id())
            ->wherePivot('role', 'owner')
            ->exists();

        if (!$isOwner) {
            return redirect()->back()->with('error', 'Seul le propriétaire peut gérer les catégories.');
        }

        $category->delete();
            return redirect()->back()
            ->with('success', 'Category deleted successfully.');
    }
}
