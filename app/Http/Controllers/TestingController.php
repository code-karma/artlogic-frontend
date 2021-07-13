<?php

namespace App\Http\Controllers;

//use App\Models\BookingItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;

//use Contentful\Delivery\Client as DeliveryClient;
use App\Services\Commercetools;

class TestingController extends Controller
{
    public function __construct()
    {
        $this->ct_client = new Commercetools();

    }

    /*public function __construct(DeliveryClient $client)
    {
        $this->delivery = new ContentfulDelivery($client);
    }*/

    public function getProducts()
    {
        return $this->ct_client->getProducts();
    }

    public function getAsset()
    {
        //return $this->delivery->getAsset($id);
    }

}