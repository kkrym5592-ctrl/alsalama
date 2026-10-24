<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display categories with search and pagination.
     */
    public function index(Request $request)
    {
        $query = Category::with('menuGroup')
            ->withCount('products')
            ->latest();

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($request->filled('status')) {
            if ($request->input('status') === 'active') {
                $query->where('is_active', true);
            } elseif ($request->input('status') === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $categories = $query->paginate(10)->withQueryString();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the create form.
     */
    public function create()
    {
        $groups = MenuGroup::orderBy('name')->get();

        return view('admin.category.create', compact('groups'));
    }

    /**
     * Store a new category.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_id' => [
                'required',
                'integer',
                Rule::exists((new MenuGroup())->getTable(), 'id'),
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('categories', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        Category::create($validated);

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Show a single category.
     */
    public function show(Category $category)
    {
        $category->load('menuGroup')
            ->loadCount('products');

        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the edit form.
     */
    public function edit(Category $category)
    {
        $groups = MenuGroup::orderBy('name')->get();

        return view(
            'admin.category.edit',
            compact('category', 'groups')
        );
    }

    /**
     * Update an existing category.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'group_id' => [
                'required',
                'integer',
                Rule::exists((new MenuGroup())->getTable(), 'id'),
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('categories', 'public');

            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $validated['image'] = $newImage;
        }

        $validated['is_active'] = $request->boolean('is_active');

        $category->update($validated);

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Delete a category safely.
     */
    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return redirect()
                ->route('admin.category.index')
                ->with(
                    'error',
                    'Cannot delete this category because it contains products. Move or delete its products first.'
                );
        }

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category deleted successfully.');
    }
}

