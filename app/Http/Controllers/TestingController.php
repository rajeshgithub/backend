<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class TestingController extends Controller
{

    public function httpTest()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/users');
        if ($response->ok()) //200
        {
            /*$resp = json_decode($response->body(),true);//Array return
        foreach($resp as $r)
        {
            echo $r['name']."<br>";
        }*/

            $resp = json_decode($response->body()); //Object return
            foreach ($resp as $r) {
                echo $r->name . "<br>";
            }
        }
    }
    public function setData()
    {
        // $tickets = Ticket::orderBy('id', 'desc')->get();
        // Cache::put('ticket', $tickets, 30);
        // return $tickets;
        return Cache::remember('ticket', 30, function () {
            return Ticket::orderBy('id', 'desc')->get();
        });
    }
    public function getData()
    {
        if (Cache::has('ticket')) {
            $data = Cache::get('ticket')->whereIn('id', [1, 2, 3]);
            return $data;
        }
        echo "Cache data expired !!!";
    }
    public function redisData()
    {
        Redis::set("user-1", "Rajesh");
        Redis::set("user-2", "Vinod");
        for ($i = 1; $i <= 2; $i++) {
            $data = Redis::get("user-$i");
            echo $data . "<br/>";
        }
    }

    public function saveFile()
    {
        Storage::disk('local')->put('example.json', '{"name":"Rajesh","Code":"1001"}');
        $contents = Storage::json('example.json');
        //return Storage::download('example.txt');
        $url = Storage::url('example.txt');
        return $url;

        return $contents;
    }
}
