<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\BlacklistMember;
use App\Model\Member;
use App\Http\Controllers\Controller;
use App\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class MemberController extends Controller
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
        $member_id = Member::where('users_id' , $id)->value('member_id');
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($member_id));


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
        $grid = new Grid(new User);

        //SELECT * FROM mall_users as a LEFT JOIN mall_member as b on a.id = b.users_id
        $grid->model()->leftJoin('member','member.users_id','=','users.id')
            ->select(['name','member_pic','member_name','id','vip','member_sex','email','blacklist']);

        $grid->id('用户ID');
        $grid->name('用户昵称');
        $grid->email('注册邮箱');
        $grid->member_pic('头像')->display(function ($pic) {
            if($pic){
                return '<img src="/../storage/'.$pic.'" width="30px" height="30px"  />';
            }
        });
        $grid->member_sex('性别')->using(Member::getMemberSexList());
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'default'],
        ];
        $grid->vip('会员')->switch($states);
//        $grid->created_at('注册时间');
//        $grid->updated_at('更新时间');

        //去掉多余的按钮
        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            $member = Member::where('users_id' , $actions->getKey())->value('member_id');
            if($member){
                $actions->prepend('<a href="/admin/member/'.$actions->getKey().'"><span class="label label-info">查看详情</span></a>');
            }
        });

        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->add('关进小黑屋', new BlacklistMember(1));
            });
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
        $show = new Show(Member::findOrFail($id));

//        $show->member_id('用户ID');
//        $show->member_nickname('用户昵称');
        $show->member_name('真实姓名');
        $show->member_tel('联系电话');
//        $show->member_email('邮箱');
//        $show->member_password('Member password');
        $show->member_pic('头像')->unescape()->as(function ($pic) {
            if($pic){
                return '<img src="/../storage/'.$pic.'" />';
            }else{
                return '还没有上传头像！';
            }

        });
        $show->member_sex('性别')->using(Member::getMemberSexList());
        $show->member_birth('生日')->as(function ($birth){
            return date('Y-m-d' , $birth);
        });
        $show->created_at('注册时间');
        $show->updated_at('更新时间');

//        $show->deleted_at('Deleted at');

        $show->panel()->tools(function ($tools) {
            $tools->disableEdit();
            $tools->disableDelete();
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
        $form = new Form(new Member);

        $form->text('member_nickname', '用户昵称');
        $form->password('member_password', '密码');

        $form->text('member_name', '真实姓名');
        $form->radio('member_sex', '性别')->options(['0' => '男', '1'=> '女'])->default('0');
//        $form->number('member_sex', '性别');
        $form->date('member_birth', '生日')->format('YYYY-MM-DD');
//        $form->number('member_birth', '生日');
        $form->mobile('member_tel', '手机号')->options(['mask' => '999 9999 9999']);
        $form->email('member_email', '邮箱');
        $form->image('member_pic', '上传头像');
        $form->hidden('blacklist' , '是否是黑名单')->default(0);
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $form->switch('vip' , '会员')->states($states);

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        return $form;
    }

    public function putblacklist(Request $request)
    {
        $arr = $request->post('ids');
        foreach (Member::find($arr) as $blacklist) {
            $blacklist->blacklist = 1;
            $blacklist->save();
        }
    }

    //小黑屋
    public function blacklistmemberlist(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
        return 123;
    }
}
