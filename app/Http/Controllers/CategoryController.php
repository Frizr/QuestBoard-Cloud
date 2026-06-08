<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private const EMBLEMS = [
        'shield',
        'sword',
        'book',
        'compass',
        'hammer',
        'star',
        'crown',
        'flame',
    ];

    public function index(Request $request): View
    {
        return view('categories.index', [
            'categories' => $request->user()
                ->categories()
                ->withCount('quests')
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'emblem' => ['nullable', Rule::in(self::EMBLEMS)],
        ]);

        $validated['color'] ??= '#6D28D9';
        $validated['emblem'] ??= 'shield';

        $request->user()->categories()->create($validated);

        return redirect()->route('categories.index')->with('status', 'Category created.');
    }

    public function edit(Request $request, Category $category): View
    {
        $this->authorizeOwner($request, $category);

        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $this->authorizeOwner($request, $category);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'emblem' => ['nullable', Rule::in(self::EMBLEMS)],
        ]);

        $validated['color'] ??= '#6D28D9';
        $validated['emblem'] ??= 'shield';

        $category->update($validated);

        return redirect()->route('categories.index')->with('status', 'Category updated.');
    }

    public function destroy(Request $request, Category $category): RedirectResponse
    {
        $this->authorizeOwner($request, $category);

        $category->delete();

        return redirect()->route('categories.index')->with('status', 'Category deleted.');
    }

    private function authorizeOwner(Request $request, Category $category): void
    {
        abort_unless($category->user_id === $request->user()->id, 403);
    }
}
