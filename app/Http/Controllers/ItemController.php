<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Item::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newItem = new Item();
        $newItem->name = $request->item["name"];
        $newItem->save();

        return $newItem;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $exitingItem = Item::find($id);
        if ($exitingItem) {
            $exitingItem->completed = (bool)$request->item['completed'];
            $exitingItem->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $exitingItem->save();

            return $exitingItem;
        }
        return "Item not found";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $exitingItem = Item::find($id);
        if ($exitingItem) {
            $exitingItem->delete();

            return "Item Successfully Deleted";
        }
        return "Item not found";
    }
}
