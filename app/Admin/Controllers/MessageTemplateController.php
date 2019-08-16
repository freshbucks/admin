<?php

namespace App\Admin\Controllers;

use App\Models\MessageTemplate;
use App\Models\Vendor;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;

class MessageTemplateController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\MessageTemplate';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MessageTemplate);

        $grid->column('id', __('Id'));
        $grid->column('vendor_id', __('Vendor id'));
        $grid->column('template_id', __('Template id'));
        $grid->column('name', __('Name'));
        $grid->column('content', __('Content'));
        $grid->column('description', __('Description'));
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
        $show = new Show(MessageTemplate::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('vendor_id', __('Vendor id'));
        $show->field('template_id', __('Template id'));
        $show->field('name', __('Name'));
        $show->field('content', __('Content'));
        $show->field('description', __('Description'));
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
        $form = new Form(new MessageTemplate);

        if ($vid = request('vendor_id')) {
            $form->hidden('vendor_id')->default($vid);
        } else {
            $vendors = Vendor::all(['id', 'name'])->pluck('name', 'id')->toArray();
            $form->select('vendor_id', __('平台'))->options($vendors)->required();
        }
        $form->text('template_id', __('Template id'));
        $form->text('name', __('Name'));
        $form->text('content', __('Content'));
        $form->textarea('description', __('Description'));

        return $form;
    }
}
