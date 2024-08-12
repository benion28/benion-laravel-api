<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class CustomerQuery {
    protected $safeParams = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt', 'ne']
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>=',
        'ne' => '!='
    ];

    // public function transform(Request $request) {
    //     $transformed = [];        
    //     foreach ($this->safeParams as $key => $operators) {
    //         if (isset($request[$key])) {
    //             $column = $this->columnMap[$key] ?? $key;
    //             foreach ($operators as $operator) {
    //                 $transformed[] = [$column, $this->operatorMap[$operator], $request->query($key)];
    //             }
    //         }
    //     }
    //     return $transformed;
    // }

    public function transform(Request $request) {
        $eloQuery = [];        
        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param; 

            foreach ($operators as $operator) {
                if (!isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloQuery;
    }
}