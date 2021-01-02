<?php

namespace App\Http\Controllers\api\Cart;

use App\Http\Controllers\Controller;
use App\Repositories\CartRule\CartRuleRepository;
use Illuminate\Http\Request;

class CartRuleController extends Controller
{
    /**
     * To hold Catalog repository instance
     */
    protected $cartRuleRepository;

    /**
     * Create a new controller instance.
     */
    public function __construct(
        CartRuleRepository $cartRuleRepository
    ) {

        $this->cartRuleRepository = $cartRuleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'action_type'     => 'required',
            'discount_amount' => 'required|numeric',
            'coupon_code'     => ['required', 'unique:cart_rules,coupon_code']
        ]);

        $data = request()->all();
        $cartRule = $this->cartRuleRepository->create($data);

        return response()->json([
            $cartRule
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
