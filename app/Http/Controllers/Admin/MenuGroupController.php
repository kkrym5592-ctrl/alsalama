<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuGroupController extends Controller
{
    /**
     * Display all menu groups.
     */
    public function index(Request $request)
    {
        $query = MenuGroup::withCount('categories')
            ->latest();

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where('name', 'like', '%' . $search . '%');
        }

        $groups = $query->paginate(10)->withQueryString();

        return view('admin.menu-groups.index', compact('groups'));
    }

    /**
     * Show the create form.
     */
    public function create()
    {
        return view('admin.menu-groups.create');
    }

    /**
     * Store a new menu group.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('menu-groups', 'public');
        }

        MenuGroup::create($validated);

        return redirect()
            ->route('admin.menu-groups.index')
            ->with('success', 'Menu group created successfully.');
    }

    /**
     * Show one menu group.
     */
    public function show(MenuGroup $menuGroup)
    {
        $menuGroup->loadCount('categories');

        return view('admin.menu-groups.show', compact('menuGroup'));
    }

    /**
     * Show the edit form.
     */
    public function edit(MenuGroup $menuGroup)
    {
        return view('admin.menu-groups.edit', compact('menuGroup'));
    }

    /**
     * Update a menu group.
     */
    public function update(Request $request, MenuGroup $menuGroup)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],
        ]);

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('menu-groups', 'public');

            if ($menuGroup->image) {
                Storage::disk('public')->delete($menuGroup->image);
            }

            $validated['image'] = $newImage;
        }

        $menuGroup->update($validated);

        return redirect()
            ->route('admin.menu-groups.index')
            ->with('success', 'Menu group updated successfully.');
    }

    /**
     * Delete a menu group safely.
     */
    public function destroy(MenuGroup $menuGroup)
    {
        if ($menuGroup->categories()->exists()) {
            return redirect()
                ->route('admin.menu-groups.index')
                ->with(
                    'error',
                    'Cannot delete this menu group because it contains categories. Move or delete its categories first.'
                );
        }

        if ($menuGroup->image) {
            Storage::disk('public')->delete($menuGroup->image);
        }

        $menuGroup->delete();

        return redirect()
            ->route('admin.menu-groups.index')
            ->with('success', 'Menu group deleted successfully.');
    }
}
