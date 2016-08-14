<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Invoice;
use App\Item;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

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
        $categories = Category::all();

        foreach ($items as $item)
        {
            $item->invoice->invoice_date =Carbon::createFromTimestamp(strtotime($item->invoice->invoice_date));
        }
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

    // uredi podrobnosti izdelka / storitve
    public function editItem($itemId)
    {
        $item = Item::find($itemId);
        $categories = Category::all();
        $units = Unit::all();
        return view('pages.edit_item', ['item' => $item, 'categories' => $categories, 'units' => $units]);
    }

    // shrani spremembe urejanja
    public function updateItem($itemId)
    {
        $item = Item::find($itemId);
        $itemName = Request::get('item_name');
        $units = Request::get('units');
        $itemUnit = $units[0];
        $itemQuantity = Request::get('quantity');
        $itemPrice = Request::get('unit_price');

        $item->name = $itemName;
        $item->unit_id = $itemUnit;
        $item->quantity = $itemQuantity;
        $item->unit_price = $itemPrice;
        $item->save();

        return redirect(route('items'));

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
            // skupna vrednost vseh izdelkov v kategoriji
            $categoryTotal = $categoryTotal + ($item->quantity * $item->unit_price);

        }
        return view('pages.category_items', ['category' => $category, 'categories' => $categories, 'categoryTotal' => $categoryTotal]);
    }

    public function searchItems()
    {


        $keywords = Input::get('search_input');

        $items = Item::all();

        $searchItems = new Collection();
        foreach ($items as $item) {

            $d = strtotime($item->invoice->invoice_date);
            $item->invoice->invoice_date = date('d.m.Y', $d);
            if (Str::contains(Str::lower($item->name), Str::lower($keywords))) {
                $searchItems->add($item);

            }
        }

        return View::make('pages.searchedItems') ->with('searchItems', $searchItems);

    }
}
