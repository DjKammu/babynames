<?php

namespace App\Admin\Controllers;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use App\Imports\NamesImport;

use App\Tag;
use App\Name;
use App\Country;
use App\Meaning;
use App\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NameController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Name';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Name());

        $grid->header(function ($query) {
            return '<a href="'.route('admin.names.import').'" class="btn btn-sm btn-success" title="Import Excel">
                <i class="fa fa-upload"></i><span class="hidden-xs">&nbsp;&nbsp;Import Excel</span>
            </a>';
        });


        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        // $grid->column('slug', __('Slug'));
        $grid->column('gender', __('Gender'));

        $grid->column('published', __('Published'))->using(['1' => Name::YES, '0' => Name::NO]);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Name::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('gender', __('Gender'));

        $show->meanings()->as(function ($meanings) {
            return $meanings->pluck('name')->join(', ');
        });

        $show->origins()->as(function ($origins) {
            return $origins->pluck('title')->join(', ');
        }); 
        $show->categories()->as(function ($categories) {
            return $categories->pluck('name')->join(', ');
        }); 

        $show->tags()->as(function ($tags) {
            return $tags->pluck('name')->join(', ');
        });

        $show->field('published', __('Published'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Name());

        $form->text('name', __('Name'))->rules(function ($form) {
            $validate = 'required|min:3';
            if (!$id = $form->model()->id) {
                $validate .= '|unique:tags,name';
            }
            return $validate;
        });


        $form->hidden('slug');


         $states = [
            'on'  => ['value' => 1, 'text' => Name::YES],
            'off' => ['value' => 0, 'text' => Name::NO]
        ]; 

         $gender = [
            'on'  => ['value' => Name::MALE, 'text' => Name::MALE],
            'off' => ['value' => Name::FEMALE, 'text' => Name::FEMALE]
        ];        

        $form->switch('gender', __('Gender'))->states($gender)->default(Name::MALE);

        $form->hasMany('meanings',__("Meanings"), function (Form\NestedForm $form) 
             use ($states){
            $form->text('name',__('Name'));
        })->useTable();
        
        $origins = Country::pluck('title','id');

        $form->multipleSelect('origins', __('Origins/Country'))->options($origins); 

        $categories = Category::pluck('name','id');

        $form->multipleSelect('categories', __('Categories'))->options($categories);

        $tags = Tag::pluck('name','id');

        $form->multipleSelect('tags', __('Tags'))->options($tags);

        $form->switch('published', __('Published'))->states($states)->default(1);

        $form->saving(function (Form $form){

            if(\request()->isMethod('POST')) {
                if ($form->slug == null) {
                    $slug = preg_replace('/(\d){1,}\.?(\d?){1,}\.?(\d?){1,}\.?(\d?){1,}/', '', 
                        $form->name);
                    $form->slug = \Str::slug($slug);
                }
            }

        });

        return $form;
    }


    public function getImport(Content $content)
    {
        $content->header('Import Branches Excel Here');

         // add breadcrumb since v1.5.7
        $content->breadcrumb(
            ['text' => 'Dashboard', 'url' => '/'],
            ['text' => 'Names', 'url' => '/names'],
            ['text' => 'Import']
        );

        return $content->view('admin.import', []);
    }

    public function postImport(Request $request)
    {
       set_time_limit(0);
       $array = \Excel::toArray(new NamesImport, $request->file('import'));

      $names = collect($array[0])->map(function($name){
        $name['slug'] = \Str::slug(trim($name['nvar']), '-');
        return $name;
      })->chunk(1000)->toArray();

      foreach ($names as $key => $chunk) {
        self::insertName($chunk,$request->all());
      }
      
      admin_toastr('The names have been imported successfully.', 'success');
      return redirect(route('admin.names.index'));
      
    }

    public static function insertName($data,$input){


         foreach ($data as $key => $dt) {

          $name         = trim($dt['nvar']);
          $slug         = trim($dt['slug']);
          $gender       = trim($input['gender']);
          $published    =  $input['publish'];

          $meanings = @explode(';',$dt['ndfn']);

          @array_filter($meanings);
          

          $bname = Name::firstOrCreate(
              ['name' => $name],
              ['slug' =>  \Str::slug(trim($name), '-'),
                'gender' =>  $gender,
                'published' =>  $published
              ]
          );

          $meaningArr = [];

          @$eMeanings = @$bname->meanings()->pluck('name')->all();
          
          //$meanings = @array_diff($eMeanings, $meanings);

         foreach (@$meanings as $key => $meaning) {
             if(!in_array(trim($meaning), $eMeanings))
                $meaningArr[] =  new Meaning(['name' => trim($meaning)]);
          }

          @$bname->meanings()->saveMany($meaningArr);

          $bname->categories()->syncWithoutDetaching( $input['categories'] );
          $bname->origins()->syncWithoutDetaching( $input['origins']);
          $bname->tags()->syncWithoutDetaching( $input['tags'] );

         }
    }
}
