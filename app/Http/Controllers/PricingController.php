<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Models\PricingCategory;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $pricing_categories = PricingCategory::with('pricings')->get();
            
        return view('admin.pricing', compact('pricing_categories'));
    }

    public function store(Request $request)
    {
        try {    
            $request->validate([
                'item_name' => 'required|string|unique:pricings',
                'price' => 'required|string|max:15',
                'pricing_category_id' => 'required|integer|exists:pricing_categories,id'
            ]);
    
            $pricing = Pricing::create([
                'item_name' => $request->item_name,
                'price' => $request->price,
                'pricing_category_id' => $request->pricing_category_id,
            ]);
    
            if ($pricing){
                return back()->with('success', 'Pricing item created successfully.');
            }

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $pricingId)
    {
        try {    
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
        $pricing = Pricing::findOrFail($pricingId);
        $pricing->delete();

        return redirect()->route('pricing')->with('success', 'Pricing item deleted successfully');
    }
}
