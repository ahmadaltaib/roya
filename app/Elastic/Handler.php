<?php
/**
 * Created by PhpStorm.
 * User: altayeb
 * Date: 9/30/18
 * Time: 11:36 AM
 */

namespace App\Elastic;


class Handler{

    public static function searchByKeyword($sKeyword){
        $elastic = app(Elastic::class);

        $query = [
            'multi_match' => [
                'query' => $sKeyword,
                'fields' => ['title'],
            ],
        ];

        $parameters = [
            'index' => 'roya',
            'type' => 'show',
            'body' => [
                'query' => $query
            ]
        ];

        $aSearch = $elastic->search($parameters);

        if($aSearch['hits']['total'] > 0){
            return json_encode(array(
                'aResult' => $aSearch['hits']['hits'],
                'dTotal'  => $aSearch['hits']['total']
            ));
        } else {
            return json_encode(array('dTotal'  => 0));
        }

    }

}