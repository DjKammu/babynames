<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Country;
use App\Tag;


class SitemapController extends Controller
{
    CONST SITEMAP_LIMIT = 30000;

    public function index()
    {
       return response()->view('sitemap.index')->header('Content-Type', 'text/xml');
    }

    public function categories()
    {
        $categories =  Category::orderBy('name')
                  ->get();      
        return response()->view('sitemap.categories', ['categories' => $categories])
              ->header('Content-Type', 'text/xml');

    } 

    public function tags()
    {
        $tags =  Tag::orderBy('name')
                  ->get();      
        return response()->view('sitemap.tags', ['tags' => $tags])
              ->header('Content-Type', 'text/xml');

    }

    public function origins()
    {
        $origins =  Country::orderBy('title')
                  ->get();      
        return response()->view('sitemap.origins', ['origins' => $origins])
              ->header('Content-Type', 'text/xml');

    } 

    public function origin($origin)
    {    
        return response()->view('sitemap.origin', ['origin' => $origin])
              ->header('Content-Type', 'text/xml');

    }  

    public function tag($tag)
    {    
        return response()->view('sitemap.tag', ['tag' => $tag])
              ->header('Content-Type', 'text/xml');

    } 

    public function category($category)
    {    
        return response()->view('sitemap.category', ['category' => $category])
              ->header('Content-Type', 'text/xml');

    } 


    public function pages(){
        return response()->view('sitemap.pages')->header('Content-Type', 'text/xml');
    }

}
