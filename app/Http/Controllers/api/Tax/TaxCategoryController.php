<?php

namespace App\Http\Controllers\api\Tax;

use App\Http\Controllers\Controller;
use App\Models\Tax\TaxCategory;
use Illuminate\Http\Request;

class TaxCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = TaxCategory::all();
        return $categories;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tax\TaxCategory  $taxCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TaxCategory $taxCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tax\TaxCategory  $taxCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TaxCategory $taxCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tax\TaxCategory  $taxCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaxCategory $taxCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax\TaxCategory  $taxCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxCategory $taxCategory)
    {
        //
    }
}
