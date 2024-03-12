<?php

namespace App\Services\v1;

use Illuminate\Http\Request;

class CustomerQuery {
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

    public function transform( Request $request ): array {
        $eloQuery = [];

        foreach ( $this->safeParams as $param => $operators ) {
            $query = $request->query( $param );

            if ( $query !== null ) {
                $column = $this->columnMap[ $param ] ?? $param;

                foreach ( $operators as $operator ) {
                    if ( isset( $query[ $operator ] ) ) {
                        $eloQuery[] = [
                            $column,
                            $this->operatorMap[ $operator ],
                            $query[ $operator ],
                        ];
                    }
                }
            }
        }

        return $eloQuery;
    }


}
