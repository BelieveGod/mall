<?php

namespace App\Admin\Controllers;

use App\Model\Regions;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class RegionsController extends Controller
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
            ->header('Index')
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
            ->header('Edit')
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
            ->header('Create')
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
        $grid = new Grid(new Regions);

        $grid->region_id('Region id');
        $grid->parent_id('Parent id');
        $grid->region_path('Region path');
        $grid->region_grade('Region grade');
        $grid->region_name('Region name');
        $grid->is_show('Is show');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        $grid->deleted_at('Deleted at');

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
        $show = new Show(Regions::findOrFail($id));

        $show->region_id('Region id');
        $show->parent_id('Parent id');
        $show->region_path('Region path');
        $show->region_grade('Region grade');
        $show->region_name('Region name');
        $show->is_show('Is show');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->deleted_at('Deleted at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Regions);

        $form->number('region_id', 'Region id');
        $form->number('parent_id', 'Parent id');
        $form->text('region_path', 'Region path');
        $form->number('region_grade', 'Region grade');
        $form->text('region_name', 'Region name');
        $form->switch('is_show', 'Is show')->default(1);

        return $form;
    }

    public function getRegion(Request $request)
    {
        $provinceId = $request->get('q');
        $cityIds = Regions::where('parent_id', $provinceId)->select('region_id', 'region_name')->get();
        $optionArr = [];
        foreach ($cityIds as $v) {
            $data = [];
            $data['id'] = $v['region_id'];
            $data['text'] = $v['region_name'];
            $optionArr[] = $data;
        }
        return $optionArr;
    }
}
