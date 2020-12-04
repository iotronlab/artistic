<?php

namespace App\Http\Controllers\api\CatalogRule;

use App\Helpers\CatalogRule\CatalogRuleIndex;
use App\Http\Controllers\Controller;
use App\Models\CatalogRule\CatalogRule;
use App\Repositories\CatalogRule\CatalogRuleRepository;
use Illuminate\Http\Request;

class CatalogRuleController extends Controller
{
    /**
     * To hold Catalog repository instance
     */
    protected $catalogRuleRepository;

    /**
     * CatalogRuleIndex
     */
    protected $catalogRuleIndexHelper;

    /**
     * Create a new controller instance.
     */
    public function __construct(
        CatalogRuleRepository $catalogRuleRepository,
        CatalogRuleIndex $catalogRuleIndexHelper
    ) {

        $this->catalogRuleRepository = $catalogRuleRepository;

        $this->catalogRuleIndexHelper = $catalogRuleIndexHelper;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CatalogRule::all();
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
        $this->validate(request(), [
            'name'            => 'required',
            'customer_groups' => 'required|array|min:1',
            'starts_from'     => 'nullable|date',
            'ends_till'       => 'nullable|date|after_or_equal:starts_from',
            'action_type'     => 'required',
            'discount_amount' => 'required|numeric',
        ]);

        $data = request()->all();

        $catalogRule = $this->catalogRuleRepository->create($data);
        $this->catalogRuleIndexHelper->reindexComplete();

        return response()->json([
            $catalogRule
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
