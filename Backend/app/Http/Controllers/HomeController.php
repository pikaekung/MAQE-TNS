<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use DateTime;


class HomeController extends Controller
{

    function mappingAuthors($post, $authors) {
        return null;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $json_posts_url = env('JSON_POSTS_URL');
        $json_authors_url = env('JSON_AUTHORS_URL');
        
        $posts_array = json_decode(file_get_contents($json_posts_url), true);     
        $authors_array = json_decode(file_get_contents($json_authors_url), true); 
        
        // Mapping post with key author
        // Convert created_at to check different from humans time.
        $posts_collect = collect($posts_array);
        $posts_map = $posts_collect->map(function ($value) use ($authors_array) {
            
            $key = array_search($value['author_id'], array_column($authors_array, 'id'));
            $value['author_detail'] = $authors_array[$key];

            //convert date
            $from_date = Carbon::parse($value['created_at']);
            // $now = Carbon::now();
            // $Interval = $from_date->diff($now);
            // $week = floor($Interval->d/7);
            $value['created_at'] = $from_date->diffForHumans();

            return $value;
        });    

        // dd($posts_map);

        return view('welcome', [
            'posts' => $posts_map,
            'page_count' => 8
        ]);
    }
}
