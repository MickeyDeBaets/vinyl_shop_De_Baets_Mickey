<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Http\Controllers\Admin\RecordController;
use App\Record;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;

class ShopControllerAlt extends Controller
{
    // Master Page: http://vinyl_shop.test/shop or http://localhost:3000/shop
    public function index()
    {
        $genres = Genre::orderBy('name')
        ->has('records')
            ->with('records')
            ->get();

        $result = compact('genres');
        Json::dump($result);

        return view('shop.indexalt',$result);                        // 'dump' the collection and 'die' (stop execution)
    }

    // Detail Page: http://vinyl_shop.test/shop/{id} or http://localhost:3000/shop/{id}
    public function show($id)
    {
        return view('shop.showalt', ['id' => $id]);  // Send $id to the view
    }
}
