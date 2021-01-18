<?php

namespace App\Admin\Controllers;

use App\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Categories';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('parent', __('Parent'))->display(function ($parent) {
            return ($parent) ? Category::find($parent)->name : '';
        });
        // $grid->column('slug', __('Slug'));
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
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        
        $show->field('parent', __('Parent'))->as(function ($parent) {
            return ($parent) ? Category::find($parent)->name : '';
        });

        // $show->field('slug', __('Slug'));
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
        $form = new Form(new Category());

        $form->text('name', __('Name'))->rules(function ($form) {
            $validate = 'required|min:3';
            if (!$id = $form->model()->id) {
                $validate .= '|unique:categories,name';
            }
            return $validate;
        });
        
         $categories = Category::whereNull('parent')
         ->pluck('name','id');

        $form->select('parent', __('Parent'))->options($categories);

        $form->hidden('slug');

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
}
