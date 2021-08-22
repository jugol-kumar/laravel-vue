<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return response()->json(Customer::all());
    }
    public function store(Request $request)
    {
        Customer::create($request->all());
        return response()->json(['message' =>'Customer save without image'], 200);
    }
    public function show(Customer $customer)
    {
        return response()->json($customer);
    }
    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return response()->json(['message' =>'Customer update without image'], 200);
    }
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(['message' =>'Customer delete without image'], 200);
    }
}
