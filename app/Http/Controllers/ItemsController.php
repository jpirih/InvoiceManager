<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Invoice;
use App\Item;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

class ItemsController extends Controller
{
    // login required
    public function __construct()
    {
        return $this->middleware('auth');
    }
    
    // seznam vseh izdelkov 
    public function items()
    {
        $items = Item::all();
        $items = $items->sortBy('name');
        $categories = Category::all();
        return view('pages.items', ['items' => $items, 'categories' => $categories]);
    }
    
    // dodaj izdelek na račun 
    public function addItemToInvoice($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        $units = Unit::all();
        $categories = Category::all();
        return view('pages.invoice_items', ['invoice' => $invoice, 'units' => $units, 'categories' => $categories]);
    }

    // shrani izdelek
    public function saveItem($invoiceId)
    {
        $unitId = Request::get('units');
        $unitId = $unitId[0];
        
        $categoryId = Request::get('categories');
        $categoryId = $categoryId[0];
        
        $category = Category::find($categoryId);
        
        $item = new Item;
        $item->invoice_id = $invoiceId;
        $item->name = Request::get('item_name');
        $item->unit_id = $unitId;
        $item->quantity = Request::get('quantity');
        $item->unit_price = Request::get('unit_price');
        
        $item->save();
        $category->items()->attach($item->id);
        
        return redirect(route('invoice_details', ['id' => $invoiceId]));
    }
    
    // izdelki in storitve po kategorijah 
    public function showCategoryItems($categoryId)
    {
        $category = Category::find($categoryId);
        $categories = Category::all();
        $categories->sortBy('name');

        $categoryTotal = 0;

        // odbelava podatkov
        foreach ($category->items as $item)
        {
            $item->invoice->invoice_date = Carbon::createFromTimestamp(strtotime($item->invoice->invoice_date))->format('d.m.Y');
            $categoryTotal = $categoryTotal + $item->unit_price;

        }

        return view('pages.category_items', ['category' => $category, 'categories' => $categories, 'categoryTotal' => $categoryTotal]);
    }
    
    
}
