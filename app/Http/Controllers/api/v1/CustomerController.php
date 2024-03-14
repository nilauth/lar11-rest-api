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
        $filtertems = $filter->transform( $request );

        $includeInvoices = $request->query( "includeInvoices" );

        $customers = Customer::where( $filtertems );

        if ( $includeInvoices ) {
            $customers = $customers->with( "invoices" );
        }


        // add the query strings to the links provided for pagination
        return new CustomerCollection( $customers->paginate()
                                                 ->appends( $request->query() ) );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store( StoreCustomerRequest $request ) {
        return new CustomerResource( Customer::create( $request->all() ) );
    }

    /**
     * Display the specified resource.
     */
    public function show( Customer $customer ): CustomerResource {
        $includeInvoices = request()->query( "includeInvoices" );

//        if ( $includeInvoices ) {
//            return new CustomerResource( $customer->loadMissing( 'invoices' ) );
//        }
//
//        return new CustomerResource( $customer );
        if ( $includeInvoices === 'true' || $includeInvoices === '1' ) {
            return new CustomerResource( $customer->loadMissing( 'invoices' ) );
        }

        return new CustomerResource( $customer );
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
