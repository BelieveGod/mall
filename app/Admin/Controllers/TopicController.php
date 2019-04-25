<?php

namespace App\Admin\Controllers;

use App\Model\Topic;
use App\Http\Controllers\Controller;
use App\User;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class TopicController extends Controller
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
            ->header('求购话题')
            ->description('列表')
            ->breadcrumb(['text' => '求购话题'])
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
        $grid = new Grid(new Topic);

        $grid->model()->orderBy('topic_id','desc');

        $grid->topic_id('id');
        $grid->topic_type('类型')->using(Topic::topicType());
        $grid->topic_dec('内容');
        $grid->user_id('发布用户')->using(User::findNameByUserId());
        $grid->status('是否解决')->using(Topic::topicStatic());
        $grid->created_at('创建时间');

        //删除多余的按钮
        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $actions->disableView();
        });
        $grid->disableExport();
        $grid->disableCreateButton();

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
        $show = new Show(Topic::findOrFail($id));

        $show->topic_id('Topic id');
        $show->topic_name('Topic name');
        $show->topic_dec('Topic dec');
        $show->used_id('Used id');
        $show->topic_follow('Topic follow');
        $show->topic_pic('Topic pic');
        $show->status('Status');
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
        $form = new Form(new Topic);
        //todo 区分管理员创建的和客户创建的话题
        $admin_id = Admin::user()->id;
        $form->hidden('used_id')->default($admin_id);

        $form->text('topic_name', '话题');
        $form->image('topic_pic', '话题图标');
        $form->textarea('topic_dec', '话题描述');
        $form->hidden('status', '话题状态')->default(Topic::ORDINARY_TOPIC);
        $form->hidden('topic_follow')->default(1);
        return $form;
    }
}
