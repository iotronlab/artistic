<?php

namespace App\Http\Controllers\api\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Resources\Attribute\AttributeFamilyIndex;
use App\Http\Resources\Attribute\AttributeFamilyResource;
use App\Http\Resources\Attribute\AttributeResource;
use App\Models\Attribute\AttributeFamily;
use App\Repositories\Attribute\AttributeFamilyRepository;
use App\Repositories\Attribute\AttributeRepository;

class AttributeController extends Controller
{
    /**
     * Repository object
     *
     * @var \App\Repositories\Product\ProductRepository
     */
    protected $repository;
    protected $attributeFamilyRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AttributeRepository $attributeRepository, AttributeFamilyRepository $attributeFamilyRepository)
    {
        $this->repository = $attributeRepository;
        $this->attributeFamilyRepository = $attributeFamilyRepository;
    }
    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->repository->get();
        return AttributeResource::collection($query);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new AttributeResource(
            $this->repository->findOrFail($id)
        );
    }

    //return all the families
    public function families()
    {
        return AttributeFamilyIndex::collection(AttributeFamily::all());
    }
    //Get group mapping based on family
    public function group_mapping($id)
    {
        return new AttributeFamilyResource($this->attributeFamilyRepository->find($id));
    }
}
