<?php

namespace App\Admin\Controllers;

use App\Models\Supplier;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('供应商管理')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('新增')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Supplier);

        $grid->id('ID')->sortable();
        $grid->company('名称');
        $grid->name('联系人姓名');
        $grid->mobile('联系人电话');

        $grid->actions(function ($actions) {
            $actions->disableView();
//            $actions->disableEdit();
//            $actions->disableDelete();
        });
        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
//                $batch->disableDelete();
            });
        });

        $grid->filter(function($filter){
            $filter->like('company', '名称');
            $filter->like('name', '联系人电话');
            $filter->between('created_at', '发布日期')->date();
        });

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
        $show = new Show(Supplier::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Supplier);

        // 创建一个输入框，第一个参数 title 是模型的字段名，第二个参数是该字段描述
        $form->text('company', '名称')->rules('required');
        $form->text('name', '联系人名称')->rules('required');
        $form->text('mobile', '联系电话')->rules('required');
        $form->text('email', '联系邮箱')->rules('required|email');

        // 创建一个选择图片的框
      //  $form->image('image', '封面图片')->rules('required|image');

        $form->multipleFile('gallery', '证照资质')->removable();

       // $form->slider('age','年龄')->options(['max' => 100, 'min' => 1, 'step' => 1, 'postfix' => ' years old'])->default(50);

        $form->distpicker([
            'province_id' => '省份',
            'city_id' => '市',
            'district_id' => '区'
        ], '发货地址')->default([
            'province' => 110000,
            'city'     => 110100,
            'district' => 110101,
        ]);
        $form->text('address', '发货地址详情')->rules('required');
        $form->distpicker([
            'back_province_id' => '省份',
            'back_city_id' => '市',
            'back_district_id' => '区'
        ], '退货地址')->default([
            'back_province' => 110000,
            'back_city'     => 110100,
            'back_district' => 110101,
        ]);
        $form->text('back_address', '退货地址详情')->rules('required');
        // 创建一个富文本编辑器
        // $form->editor('description', '商品描述')->rules('required');
        //百度编辑器
        $form->ueditor('description', '商品描述')->rules('required');


        $form->tools(function (Form\Tools $tools) {
           // $tools->disableDelete();
            $tools->disableView();
           // $tools->disableList();
        });

        $form->footer(function ($footer){
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        // 定义事件回调，当模型即将保存时会触发这个回调
        $form->saving(function (Form $form) {
            $province=DB::table('china_area')->where('code',$form->input('province_id'))->value('name');
            $form->model()->province =$province;
            $city=DB::table('china_area')->where('code',$form->input('city_id'))->value('name');
            $form->model()->city =$city;
            $district=DB::table('china_area')->where('code',$form->input('district_id'))->value('name');
            $form->model()->district =$district;

            $back_province=DB::table('china_area')->where('code',$form->input('province_id'))->value('name');
            $form->model()->back_province =$back_province;
            $back_city=DB::table('china_area')->where('code',$form->input('city_id'))->value('name');
            $form->model()->back_city =$back_city;
            $back_district=DB::table('china_area')->where('code',$form->input('district_id'))->value('name');
            $form->model()->back_district =$back_district;
        });

        return $form;
    }
}
