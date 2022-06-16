<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Name;

class NameController extends Controller
{
    public function index(){

        $categories = Category::has('names')
                      ->inRandomOrder()
                      ->limit(Category::HOME_PAGE_CATEGORY)
                      ->with('names')
                      ->get();

        return view('welcome',compact('categories'));
    }

    public function names(Request $request, $cat){
         
        if(!Category::whereSlug($cat)->exists() && Category::MORE != $cat ){
            return redirect('/') ;
        } 

        $childCats = Category::whereSlug($cat)
                    ->with('childern')->get();

        $catId = ($childCats->count()) ? $childCats->pluck('id') : 0;

        $names = Name::whereHas('categories', function($query) use ($cat,$catId) {
		    $query->where('slug',$cat);
            $query->orwhere('parent', $catId);
		})->get();
        
        $childern = (@$childCats[0]->childern);

        if(!$catId){
             $names = Name::whereHas('categories', function($query) use ($catId) {
                $query->orwhere('parent', $catId);
            })->get();  

            $childCats = Category::whereParent(NULL)
                       ->get();
            
            $childern = $childCats;
        }

         

        $boys = @$names->where('gender',Name::MALE)->count(); 
        $girls = @$names->where('gender',Name::FEMALE)->count(); 

    	return view('names',compact('cat','boys','girls','childern'));
    }

    public function getNames(Request $request, $cat,$gender,$letter){
         
        if(!Category::whereSlug($cat)->exists() || 
           !in_array(strtolower($gender), [ Name::BOY,Name::GIRL ]) || 
           !in_array(strtolower($letter), range('a', 'z'))){
            return redirect('/') ;
        } 
        $qGender = strtolower($gender) == Name::BOY ? Name::MALE : Name::FEMALE;

        $qNames = Name::whereHas('categories', function($query) use ($cat) {
		    $query->where('slug',$cat);
		})->whereGender($qGender)->where('name', 'like', $letter.'%');

        $allNames =  $qNames->get();

        $names = $qNames->with(['meanings' => function ($query) {
                $query->where('name','<>','...')->distinct('name');
         }])->paginate((new Name)->perPage);

        $boys = @$allNames->where('gender',Name::MALE)->count(); 
        $girls = @$allNames->where('gender',Name::FEMALE)->count(); 


    	return view('names-list',compact('cat','gender','boys','letter','girls',
            'names'));
    }  

      public function searchNames(Request $request, $cat,$gender,$term,$word){
         
        if(!Category::whereSlug($cat)->exists() || 
           !in_array(strtolower($gender), [ Name::BOY,Name::GIRL ]) || 
           !in_array(strtolower($term), [Name::SEARCH_ENDS, Name::SEARCH_BEGINS, Name::SEARCH_CONTAINS, Name::SEARCH_MEANING])){
            return redirect('/') ;
        } 
        $qGender = strtolower($gender) == Name::BOY ? Name::MALE : Name::FEMALE;
         
        $qNames = Name::whereHas('categories', function($query) use ($cat) {
            $query->where('slug',$cat);
        })->whereGender($qGender);
         
        if($term == Name::SEARCH_BEGINS){
           $qNames->where('name', 'like', $word.'%');
        }else if($term == Name::SEARCH_ENDS){
           $qNames->where('name', 'like', '%'.$word);
        }else if($term == Name::SEARCH_CONTAINS){
           $qNames->where('name', 'like', '%'.$word.'%');
        }else{
             $qNames->whereHas('meanings', function($query) use ($word) {
                $query->where('name',$word);
            });
        }

        $allNames =  $qNames->get();

        $names = $qNames->with(['meanings' => function ($query) {
                $query->where('name','<>','...')->distinct('name');
        }])->paginate((new Name)->perPage);
        
        $boys = @$allNames->where('gender',Name::MALE)->count(); 
        $girls = @$allNames->where('gender',Name::FEMALE)->count(); 
        
        return view('names-search-list',compact('cat','gender','boys', 'word', 'term','girls',
            'names'));
    } 

    public function getName(Request $request,$gender,$slug){
         
        if(!in_array(strtolower($gender), [ Name::BOY,Name::GIRL ])){
            return redirect('/') ;
        } 

        $qGender = strtolower($gender) == Name::BOY ? Name::MALE : Name::FEMALE;

        $name = Name::whereGender($qGender)->where('slug', $slug)
                 ->with(['meanings' => function ($query) {
                        $query->where('name','<>','...')->distinct('name');
                 },'origins','tags','categories'])->first();



        return view('name',compact('name','gender'));
    }

    public function tagOrigin(Request $request,$tagOrigin,$slug){
 
        if(!in_array(strtolower($tagOrigin), [ Name::ORIGINS,Name::TAGS ])){
            return redirect('/') ;
        } 

        $qNames = Name::whereHas($tagOrigin, function($query) use ($slug) {
            $query->where('slug',$slug);
        });
        
        $allNames =  $qNames->get();

         $names = $qNames->with(['meanings' => function ($query) {
                $query->where('name','<>','...')->distinct('name');
         }])->paginate((new Name)->perPage);
        
        $boys = @$allNames->where('gender',Name::MALE)->count(); 
        $girls = @$allNames->where('gender',Name::FEMALE)->count(); 

        $cat  = $slug;

       return view('names',compact('cat','boys','girls'));

    }
}
