<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Name;

class NameController extends Controller
{
    public function index(){
    	return view('welcome');
    }

    public function names(Request $request, $cat){
         
        if(!Category::whereSlug($cat)->exists()){
            return redirect('/') ;
        } 

        $names = Name::whereHas('categories', function($query) use ($cat) {
		    $query->where('slug',$cat);
		})->get();
        
        $boys = @$names->where('gender',Name::MALE)->count(); 
        $girls = @$names->where('gender',Name::FEMALE)->count(); 

    	return view('names',compact('cat','boys','girls'));
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

        $names = $qNames->with('meanings')->paginate((new Name)->perPage);
        
        $boys = @$allNames->where('gender',Name::MALE)->count(); 
        $girls = @$allNames->where('gender',Name::FEMALE)->count(); 
        
    	return view('names-list',compact('cat','gender','boys','letter','girls',
            'names'));
    } 

    public function getName(Request $request,$gender,$slug){
         
        if(!in_array(strtolower($gender), [ Name::BOY,Name::GIRL ])){
            return redirect('/') ;
        } 

        $qGender = strtolower($gender) == Name::BOY ? Name::MALE : Name::FEMALE;

        $name = Name::whereGender($qGender)->where('slug', $slug)
                 ->with(['meanings','origins','tags','categories'])->first();

        return view('name',compact('name','gender'));
    }
}
