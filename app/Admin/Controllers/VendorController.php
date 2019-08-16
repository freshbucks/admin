<?php

namespace App\Admin\Controllers;

use App\Models\Vendor;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class VendorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '平台管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Vendor);

        $grid->column('id', __('Id'));
//            ->expand(function ($model) {
//                return new Table($model->configs->toArray());
//            });
        $grid->column('type', __('Type'));
        $grid->column('name', __('Name'))->link(function ($model) {
            return url("/admin/vendors/{$model->id}/configs");
        }, '_self');
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
        $show = new Show(Vendor::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('type', __('Type'));
        $show->field('name', __('Name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->templates('短信模板', function ($template) use ($id) {
            $template->resource("/admin/vendors/{$id}/templates");
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Vendor);

        $form->text('type', __('Type'))->default('message');
        $form->text('name', __('Name'));

        return $form;
    }
}
