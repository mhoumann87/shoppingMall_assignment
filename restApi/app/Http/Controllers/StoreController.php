<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Store::all();

        return $store;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = New Store();
        $store->store_number = $request->store_number;
        $store->store_name = $request->store_name;
        $store->store_logo = $request->store_logo;
        $store->store_phoneno = $request->store_phoneno;
        $store->store_event = $request->store_event;

        $store->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response


    public function show(Store $store)
    {
        //
    }*/
    public function show($id)
    {
        $store = Store::find($id);

        return $store;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $store = Store::find($id);
        $store->store_number = $request->store_number;
        $store->store_name = $request->store_name;
        $store->store_logo = $request->store_logo;
        $store->store_phoneno = $request->store_phoneno;
        $store->store_event = $request->store_event;

        $store->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::find($id);

        $store->delete();
    }
}
