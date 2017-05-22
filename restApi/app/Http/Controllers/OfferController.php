<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offer = Offer::all();

        return $offer;
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
        $offer = New Offer();
        $offer->offer_id = $request->offer_id;
        $offer->store_number = $request->store_number;
        $offer->offer_photo = $request->offer_photo;
        $offer->offer_title = $request->offer_title;
        $offer->offer_description = $request->offer_description;
        $offer->offer_normalprice = $request->offer_normalprice;
        $offer->offer_price = $request->offer_price;

        $offer->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $offer = Offer::find($id);
        $offer->offer_id = $request->offer_id;
        $offer->store_number = $request->store_number;
        $offer->offer_photo = $request->offer_photo;
        $offer->offer_title = $request->offer_title;
        $offer->offer_description = $request->offer_description;
        $offer->offer_normalprice = $request->offer_normalprice;
        $offer->offer_price = $request->offer_price;

        $offer->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = Offer::find($id);

        $offer->delete();
    }
}
