<?php
namespace App\Helpers;

use App\Name;
use App\Category;
use Carbon\Carbon;
use Str;

class BabynamesWizards {
  
  const TITLE_LENGTH = 100;

  const DESCRIPTION_LENGTH = 100;

  const NAMES_SLUG = 'names';

  public static function getSEOTags()
  {
        $uri = request()->segments();
        $last = empty($uri) ? 'home' : last($uri);
  
        $seoTags = (object) [];
        $seoTags->title = config('title'); 
        $seoTags->meta_description = config('description');
        $seoTags->meta_keywords = config('keywords');


        if(@$uri[0] == self::NAMES_SLUG){

            $qNames = Name::whereHas('categories', function($query) use ($uri) {
                $query->where('slug',@$uri[1]);
            });
        
            if(@$uri[2] && @$uri[3]){
               $qGender = strtolower(@$uri[2]) == Name::BOY ? Name::MALE : Name::FEMALE; 
               $qNames->whereGender($qGender)->where('name', 'like', @$uri[3].'%');
            }

            $allNames =  $qNames->get();
            
            $count = @$allNames->count(); 
            $boys = @$allNames->where('gender',Name::MALE)->count(); 
            $girls = @$allNames->where('gender',Name::FEMALE)->count(); 

            $seoTags->title = ucfirst(@$uri[1]).' Baby Names » Boys &amp; Girls » Beginning with A-Z';

             $seoTags->meta_description = 'A to Z Baby Girl Names, A to Z Baby Boys Names. Currently we have '.$boys.' Boys Names and '.$girls.' Girls Names with Meanings in our '.ucfirst(@$uri[1]).' collection. Total collection of '.$count.' baby names';

             if(@$uri[2] && @$uri[3]){

               $seoTags->title = ucfirst(@$uri[1]).' Baby Names » '.ucfirst(@$uri[2]).' Names » Beginning with '.ucfirst(@$uri[3]);

               $seoTags->meta_description = ''.\Str::plural(ucfirst(@$uri[2])).' Names A to Z - Baby '.ucfirst(@$uri[2]).' Name - Meanings; Currently we have '.$count.' '.\Str::plural(ucfirst(@$uri[2])).' Names Beginning with letter '.ucfirst(@$uri[3]).'  in our '.ucfirst(@$uri[1]).'  collection.';
            }

        }

        @$seoTags->meta_keywords = @$seoTags->title.', '.@$seoTags->meta_keywords; 
        @$seoTags->meta_description = @$seoTags->title.' '.@$seoTags->meta_description; 
        @$seoTags->title = ucwords(\Str::lower(@$seoTags->title)).' | '.env("APP_NAME", "BabyNamesWizards"); 

        $html = '';
        $html .= '<meta name="title" 
        content="'.Str::substr(trim($seoTags->title), 0, self::TITLE_LENGTH).'">'."\n";
        $html .= '<meta name="description" content="'.Str::substr(trim(str_replace(array("\r","\n"),"",$seoTags->meta_description)), 0, self::DESCRIPTION_LENGTH).'">'."\n";
        $html .= '<meta name="keywords" content="'.trim($seoTags->meta_keywords).'">'."\n";
        $html .= '<title>'.trim($seoTags->title).'</title>'."\n";
        $html .= '<link rel="canonical" href="'.request()->url().'" />'."\n";

        return $html;
   }

   public static function count()
  {
        $uri = request()->segments();
        $uri = empty($uri) ? 'home' : last($uri);
        $lyrichord = Lyrichord::where('slug', $uri)->first();

        if(!$lyrichord){
            return;
        }
        $lc_id = $lyrichord->id;
        $ip = request()->ip();
        $data = ['lc_id' => $lc_id, 'ip' => $ip];
        $ifCount = LyrichordsCount::whereDate('created_at', Carbon::today())
                 ->where($data)->first();
        if($ifCount){
            $ifCount->increment('count');
        }else{
          $location_data = Location::get($ip);
          $data['location_data'] = ($location_data) ? json_encode($location_data) : ''; 
          LyrichordsCount::create($data);
        }      
         
        return; 
   }

}