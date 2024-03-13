<?php

namespace App\Http\Controllers\api\v1;

use App\Filters\v1\CustomersFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\v1\CustomerCollection;
use App\Http\Resources\v1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;


class CustomerController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request ) {
        $filter     = new CustomersFilter();
        $queryItems = $filter->transform( $request );

        if ( count( $queryItems ) == 0 ) {
            return new CustomerCollection( Customer::paginate() );
        } else {
            $customers = Customer::where( $queryItems )
                                 ->paginate();

            // add the query strings to the links provided for pagination
            return new CustomerCollection( $customers->appends( $request->query() ) );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( StoreCustomerRequest $request ) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( Customer $customer ) {
        return new CustomerResource( $customer );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Customer $customer ) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateCustomerRequest $request,
        Customer $customer
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Customer $customer ) {
        //
    }
}
