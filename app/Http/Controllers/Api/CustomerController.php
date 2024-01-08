<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use Core\Repositories\CustomerRepo;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsersType\CustomerResource;


class CustomerController extends Controller
{
    public $customerRepo;

    public function __construct(CustomerRepo $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = $this->customerRepo->getUsers(10);
        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $customer->load("user");
        return CustomerResource::make($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , Customer $customer)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
