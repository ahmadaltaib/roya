<?php
/**
 * Created by PhpStorm.
 * User: altayeb
 * Date: 9/29/18
 * Time: 9:39 PM
 */


namespace App\Elastic;
use Elasticsearch\Client;

class Elastic{
    protected $client;

    public function __construct(Client $client){
        $this->client = $client;
    }

    public function index(array $parameters){
        return $this->client->index($parameters);
    }

    public function delete(array $parameters){
        return $this->client->delete($parameters);
    }

    public function indexMany(array $collection){
        $parameters = [];
        foreach ($collection as $item) {
            $parameters['body'][] = [
                "index" => [
                    '_id' => $item['id'],
                    '_index' => $item['index'],
                    '_type' => $item['type'],
                ]
            ];
            $parameters['body'][] = $item['body'];
        }
        return $this->client->bulk($parameters);
    }

    public function deleteIndex($name){
        if (! $this->indexExists($name)) {
            return true;
        }
        return $this->client->indices()->delete([
            'index' => $name
        ]);
    }

    public function indexExists($name){
        return $this->client->indices()->exists(['index' => $name]);
    }

    public function search(array $parameters){
        return $this->client->search($parameters);
    }

    public function getClient(){
        return $this->client;
    }
}