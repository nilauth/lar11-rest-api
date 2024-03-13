<?php

namespace App\Filters\v1;

use App\Filters\ApiFilter;

class CustomersFilter extends ApiFilter {
    protected array $safeParams
        = [
            'id'         => [ 'eq' ],
            'name'       => [ 'eq' ],
            'type'       => [ 'eq' ],
            'email'      => [ 'eq' ],
            'address'    => [ 'eq' ],
            'city'       => [ 'eq' ],
            'postalCode' => [ 'eq', 'gt', 'lt' ],
        ];

    protected array $columnMap
        = [
            'postalCode' => 'postal_code',
        ];

    protected array $operatorMap
        = [
            'eq'  => '=',
            'lt'  => '<',
            'lte' => '<=',
            'gt'  => '>',
            'gte' => '>=',
        ];


}
