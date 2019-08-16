<?php

namespace App\Admin\Controllers;

use App\Models\VendorConfig;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VendorConfigController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\VendorConfig';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VendorConfig);

        $grid->column('id', __('Id'));
        $grid->column('vendor_id', __('Vendor id'));
        $grid->column('k', __('K'));
        $grid->column('v', __('V'));
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
        $show = new Show(VendorConfig::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('vendor_id', __('Vendor id'));
        $show->field('k', __('K'));
        $show->field('v', __('V'));
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
        $form = new Form(new VendorConfig);

        $form->hidden('vendor_id')->default(request()->route('vendor_id'));
        $form->text('k', __('键'));
        $form->text('v', __('值'));

        return $form;
    }
}
