<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OfferController extends Controller
{
    /**
     * Display all offers with search, status filter and pagination.
     */
    public function index(Request $request)
    {
        $query = Offer::with(['product', 'category'])->latest();

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $offers = $query->paginate(10)->withQueryString();

        return view('admin.offers.index', compact('offers'));
    }

    /**
     * Show the create offer form.
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.offers.create', compact(
            'products',
            'categories'
        ));
    }

    /**
     * Store a new offer.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'target_type' => [
                'required',
                Rule::in(['product', 'category']),
            ],

            'product_id' => [
                'nullable',
                'required_if:target_type,product',
                'integer',
                Rule::exists('products', 'id'),
            ],

            'category_id' => [
                'nullable',
                'required_if:target_type,category',
                'integer',
                Rule::exists('categories', 'id'),
            ],

            'discount_type' => [
                'required',
                Rule::in(['percentage', 'fixed']),
            ],

            'discount_value' => [
                'required',
                'numeric',
                'gt:0',
                'max:1000000',
            ],

            'starts_at' => [
                'nullable',
                'date',
            ],

            'ends_at' => [
                'nullable',
                'date',
                'after_or_equal:starts_at',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        // A percentage discount cannot exceed 100%.
        if (
            $validated['discount_type'] === 'percentage'
            && (float) $validated['discount_value'] > 100
        ) {
            return back()
                ->withErrors([
                    'discount_value' => 'نسبة الخصم لا يمكن أن تزيد عن 100%.',
                ])
                ->withInput();
        }

        // Keep only the selected target.
        if ($validated['target_type'] === 'product') {
            $validated['category_id'] = null;
        } else {
            $validated['product_id'] = null;
        }

        unset($validated['target_type']);

        $validated['is_active'] = $request->boolean('is_active');

        Offer::create($validated);

        return redirect()
            ->route('admin.offers.index')
            ->with('success', 'تم إنشاء العرض بنجاح.');
    }

    /**
     * Show the edit offer form.
     */
    public function edit(Offer $offer)
    {
        $products = Product::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        $targetType = $offer->product_id
            ? 'product'
            : 'category';

        return view('admin.offers.edit', compact(
            'offer',
            'products',
            'categories',
            'targetType'
        ));
    }

    /**
     * Update an existing offer.
     */
    public function update(Request $request, Offer $offer)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'target_type' => [
                'required',
                Rule::in(['product', 'category']),
            ],

            'product_id' => [
                'nullable',
                'required_if:target_type,product',
                'integer',
                Rule::exists('products', 'id'),
            ],

            'category_id' => [
                'nullable',
                'required_if:target_type,category',
                'integer',
                Rule::exists('categories', 'id'),
            ],

            'discount_type' => [
                'required',
                Rule::in(['percentage', 'fixed']),
            ],

            'discount_value' => [
                'required',
                'numeric',
                'gt:0',
                'max:1000000',
            ],

            'starts_at' => [
                'nullable',
                'date',
            ],

            'ends_at' => [
                'nullable',
                'date',
                'after_or_equal:starts_at',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        // A percentage discount cannot exceed 100%.
        if (
            $validated['discount_type'] === 'percentage'
            && (float) $validated['discount_value'] > 100
        ) {
            return back()
                ->withErrors([
                    'discount_value' => 'نسبة الخصم لا يمكن أن تزيد عن 100%.',
                ])
                ->withInput();
        }

        // Keep only the selected target.
        if ($validated['target_type'] === 'product') {
            $validated['category_id'] = null;
        } else {
            $validated['product_id'] = null;
        }

        unset($validated['target_type']);

        $validated['is_active'] = $request->boolean('is_active');

        $offer->update($validated);

        return redirect()
            ->route('admin.offers.index')
            ->with('success', 'تم تحديث العرض بنجاح.');
    }

    /**
     * Delete an offer.
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return redirect()
            ->route('admin.offers.index')
            ->with('success', 'تم حذف العرض بنجاح.');
    }

    /**
     * Toggle offer active status.
     */
    public function toggleStatus(Offer $offer)
    {
        $offer->update([
            'is_active' => !$offer->is_active,
        ]);

        return redirect()
            ->route('admin.offers.index')
            ->with('success', $offer->is_active
                ? 'تم تفعيل العرض بنجاح.'
                : 'تم إيقاف العرض بنجاح.'
            );
    }
}
