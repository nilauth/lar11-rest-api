<?php

namespace App\Filters\v1;

use App\Filters\ApiFilter;

class InvoicesFilter extends ApiFilter {
    protected array $safeParams
        = [
            'customerId' => [ 'eq' ],
            'amount'     => [ 'eq', 'gt', 'gte', 'lt', 'lte', 'ne' ],
            'status'     => [ 'eq', 'ne' ],
            'billedDate' => [ 'eq', 'gt', 'gte', 'lt', 'lte', 'ne' ],
            'paidDate'   => [ 'eq', 'gt', 'gte', 'lt', 'lte', 'ne' ],
        ];

    protected array $columnMap
        = [
            'customerId' => 'customer_id',
            'billedDate' => 'billed_date',
            'paidDate'   => 'paid_date',

        ];

    protected array $operatorMap
        = [
            'eq'  => '=',
            'lt'  => '<',
            'lte' => '<=',
            'gt'  => '>',
            'gte' => '>=',
            'ne'  => '!=',
        ];


}
