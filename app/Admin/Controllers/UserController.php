<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Illuminate\Contracts\Support\Renderable;

class UserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->name->setHeaderAttributes(['style' => 'color:#5b69bc']);;
            $grid->mobile->filter();
            $grid->email;
            $grid->email_verified_at;
            $grid->password;
            $grid->remember_token;
            $grid->created_at;
            $grid->updated_at->sortable();

//            $grid->quickSearch('mobile', 'name')->placeholder('搜索...');
            $grid->quickSearch();
            $grid->export()->csv();

            $grid->toolsWithOutline(false);
//            $grid->disableCreateButton();
//            $grid->disableViewButton();
//            $grid->disableEditButton();
//            $grid->disableBatchActions();
//            $grid->disableToolbar();

//            $grid->enableDialogCreate();
//            $grid->showRowSelector();
//            $grid->disableRowSelector();

            $grid->filter(function (Grid\Filter $filter) {
//                $filter->panel();
                $filter->equal('id');
                $filter->scope('new', '最近修改')
                    ->whereDate('created_at', date('Y-m-d'))
                    ->orWhere('updated_at', date('Y-m-d'));


            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new User(), function (Show $show) {
            $show->id;
            $show->name;
            $show->mobile;
            $show->email;
            $show->email_verified_at;
            $show->password;
            $show->remember_token;
            $show->created_at;
            $show->updated_at;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new User(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('mobile');
            $form->text('email');
            $form->datetime('email_verified_at');
            $form->text('password');
            $form->text('remember_token');

            $form->keyValue('name');
            $form->list('name');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
