<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Models\PricingCategory;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $pricing_categories = PricingCategory::with('pricings')->get();
            
        return view('admin.pricing', compact('pricing_categories'));
    }

    public function store(Request $request)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator') {
                return back()->with('error', 'Unauthorized access');
            }

            $request->validate([
                'item_name' => 'required|string',
                'price' => 'required|string|max:15',
                'pricing_category_id' => 'required|integer|exists:pricing_categories,id'
            ]);

            $pricing = Pricing::where('item_name', $request->item_name)->first();

            if ($pricing) {
                $pricing->price = $request->price;
                $pricing->pricing_category_id = $request->pricing_category_id;
                $pricing->save();

                return back()->with('success', 'Pricing item updated successfully.');
            } else {
                $pricing = Pricing::create([
                    'item_name' => $request->item_name,
                    'price' => $request->price,
                    'pricing_category_id' => $request->pricing_category_id,
                ]);

                if ($pricing) {
                    return back()->with('success', 'Pricing item created successfully.');
                }
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $pricingId)
    {
        try { 
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $data = $request->validate([
                'item_name' => 'sometimes|string|unique:pricing',
                'price' => 'sometimes|string|max:15',
                'pricing_category_id' => 'sometimes|integer|exists:pricing_categories,id'
            ]);

            $pricing = Pricing::findOrFail($pricingId);
    
            $pricing->update($data);

            return back()->with('success', 'Pricing item updated successfully');

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($pricingId)
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }
        
        $pricing = Pricing::findOrFail($pricingId);
        $pricing->delete();

        return redirect()->route('pricing')->with('success', 'Pricing item deleted successfully');
    }
}
