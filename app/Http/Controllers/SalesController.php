<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use App\Models\SaleLocation;


class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with(['customer', 'agent', 'items'])->orderByDesc('created_at')->get();
        return Inertia::render('Sales/Index', [
            'sales' => $sales
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Sales/Create', [
            'customers' => Customer::all(),
            'products' => Product::all(),
            'agents' => User::all(),
            'locations' => SalesLocation::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id'=>'required|exists:customers,id',
            'sales_agent_id'=>'nullable|exists:users,id',
            'sales_location_id'=>'nullable|exists:sales_locations,id',
            'invoice_date'=>'required|date',
            'items'=>'required|array|min:1',
            'items.*.product_id'=>'required|exists:products,id',
            'items.*.quantity'=>'required|numeric|min:0.001',
            'items.*.unit_price'=>'required|numeric|min:0',
            'discount'=>'nullable|numeric|min:0'
        ]);

        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'invoice_no' => $this->generateInvoiceNumber(),
                'customer_id' => $data['customer_id'],
                'sales_agent_id' => $data['sales_agent_id'] ?? null,
                'sales_location_id' => $data['sales_location_id'] ?? null,
                'status' => 'draft',
                'invoice_date' => $data['invoice_date'],
                'discount' => $data['discount'] ?? 0
            ]);

            $sub = 0;
            
            foreach($data['items'] as $it){
                $line_total = $it['unit_price'] * $it['quantity'];
                $sub += $line_total;
                $sale->items()->create([
                    'product_id'=>$it['product_id'],
                    'unit_price'=>$it['unit_price'],
                    'quantity'=>$it['quantity'],
                    'line_total'=>$line_total
                ]);
            }

            $sale->sub_total = $sub;
            $sale->total = $sub - ($sale->discount ?? 0) + ($sale->tax ?? 0);
            $sale->balance_due = $sale->total;
            $sale->save();

            DB::commit();

            return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
        } catch (Throwable $e) {

            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sales $sales)
    {
        return Inertia::render('Sales/Show', [
            'sale' => $sales->load(['customer', 'agent', 'items'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sales $sales)
    {
        return Inertia::render('Sales/Edit', [
            'sale' => $sales->load(['items', 'customer', 'agent']),
            'customers' => Customer::all(),
            'products' => Product::all(),
            'agents' => User::all(),
            'locations' => SalesLocation::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sales $sales)
    {
        $data = $request->validate([
            'customer_id'=>'required|exists:customers,id',
            'sales_agent_id'=>'nullable|exists:users,id',
            'sales_location_id'=>'nullable|exists:sales_locations,id',
            'invoice_date'=>'required|date',
            'items'=>'required|array|min:1',
            'items.*.product_id'=>'required|exists:products,id',
            'items.*.quantity'=>'required|numeric|min:0.001',
            'items.*.unit_price'=>'required|numeric|min:0',
            'discount'=>'nullable|numeric|min:0'
        ]);

        DB::beginTransaction();
        try {
            $sales->update([
                'customer_id' => $data['customer_id'],
                'sales_agent_id' => $data['sales_agent_id'] ?? null,
                'sales_location_id' => $data['sales_location_id'] ?? null,
                'invoice_date' => $data['invoice_date'],
                'discount' => $data['discount'] ?? 0
            ]);

            // Remove old items and add new ones
            $sales->items()->delete();
            $sub = 0;
            foreach($data['items'] as $it){
                $line_total = $it['unit_price'] * $it['quantity'];
                $sub += $line_total;
                $sales->items()->create([
                    'product_id'=>$it['product_id'],
                    'unit_price'=>$it['unit_price'],
                    'quantity'=>$it['quantity'],
                    'line_total'=>$line_total
                ]);
            }
            $sales->sub_total = $sub;
            $sales->total = $sub - ($sales->discount ?? 0) + ($sales->tax ?? 0);
            $sales->balance_due = $sales->total;
            $sales->save();

            DB::commit();
            return redirect()->route('sales.show', $sales)->with('success', 'Sale updated successfully.');
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $sales)
    {
        $sales->items()->delete();
        $sales->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}
