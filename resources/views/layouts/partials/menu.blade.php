<?php $link_url=Request::path();
$current_route=\Request::route()->getName();
$actions = \App\Models\ActionRole::where('user_id', auth()->user()->id)->pluck('name')->toArray();
if(empty($actions)){
    $actions = \App\Models\ActionRole::where('role_id', auth()->user()->role_id)->wherenull('user_id')->pluck('name')->toArray();

}
$new_message=\App\Models\Countact::where('type','message')->where('is_read',0)->count();
$new_news=\App\Models\Countact::where('type','news')->where('is_read',0)->count();

?>
<li class="nav-item start ">
    <a href="{{ url('/dashboard') }}" class="nav-link nav-toggle">

        <i class="icon-home"></i>
        <span class="title">الرئيسية</span>

    </a>
</li>


@if(in_array('add_post',$actions) || in_array('edit_post',$actions) || in_array('delete_post',$actions) || in_array('view_post',$actions))
    <li class="nav-item  open">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-newspaper-o"></i>
            <span class="title">المنشور</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu"  style="display: block">
            @if(in_array('add_post',$actions))
                <li class="nav-item  @if($current_route=='posts.create')active open @endif">
                    <a href="{{ route('posts.create') }}" class="nav-link ">
                        <span class="title">إضافة منشور </span>
                    </a>
                </li>
            @endif
            <li class="nav-item  @if (in_array($current_route, ['posts.index','posts.edit','posts.tags','posts.cases']))active open @endif">
                <a href="{{ route('posts.index') }}" class="nav-link ">
                    <span class="title">المنشورات</span>
                </a>
            </li>

        </ul>
    </li>
@endif
@if(in_array('add_post',$actions) || in_array('edit_post',$actions) || in_array('delete_post',$actions) || in_array('view_post',$actions))
    <li class="nav-item  open">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-newspaper-o"></i>
            <span class="title">البانير العلوي</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu"  style="display: block">
            @if(in_array('add_post',$actions))
                <li class="nav-item  @if($current_route=='banner.create')active open @endif">
                    <a href="{{ route('banner.create') }}" class="nav-link ">
                        <span class="title">اضافة بانير</span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif
@if(in_array('add_album',$actions) || in_array('edit_album',$actions) || in_array('delete_album',$actions) || in_array('view_album',$actions))
    <li class="nav-item @if(strpos($link_url, 'cases') !== false) open @endif">

        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-suitcase"></i>
            <span class="title">الاصدارات</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu" @if(strpos($link_url, 'cases') !== false) style="display: block" @endif>
            @if(in_array('add_album',$actions))
                <li class="nav-item   @if($current_route=='cases.create')active open @endif">
                    <a href="{{ route('releas.create') }}" class="nav-link ">
                        <span class="title">إضافة اصدار</span>
                    </a>
                </li>
            @endif
            <li class="nav-item  @if (in_array($current_route, ['cases.index','cases.edit']))active open @endif">
                <a href="{{ route('releas.index') }}" class="nav-link ">
                    <span class="title">كافة الاصدارات </span>
                </a>
            </li>


        </ul>
    </li>
@endif

@if(in_array('add_album',$actions) || in_array('edit_album',$actions) || in_array('delete_album',$actions) || in_array('view_album',$actions))
    <li class="nav-item @if(strpos($link_url, 'cases') !== false) open @endif">

        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-suitcase"></i>
            <span class="title">الروابط لمواقع اخري</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu" @if(strpos($link_url, 'cases') !== false) style="display: block" @endif>
            @if(in_array('add_album',$actions))
                <li class="nav-item   @if($current_route=='cases.create')active open @endif">
                    <a href="{{ route('link.create') }}" class="nav-link ">
                        <span class="title">إضافة رابط</span>
                    </a>
                </li>
            @endif
            <li class="nav-item  @if (in_array($current_route, ['cases.index','cases.edit']))active open @endif">
                <a href="{{ route('link.index') }}" class="nav-link ">
                    <span class="title">كافة الروابط </span>
                </a>
            </li>


        </ul>
    </li>
@endif
@if(in_array('add_album',$actions) || in_array('edit_album',$actions) || in_array('delete_album',$actions) || in_array('view_album',$actions))
    <li class="nav-item open ">

        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-picture"></i>
            <span class="title">الألبومات</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu"  style="display: block">
            @if(in_array('add_album',$actions))
                <li class="nav-item  @if($current_route=='albums.create')active open @endif">
                    <a href="{{ route('albums.create') }}" class="nav-link ">
                        <span class="title">إضافة ألبوم</span>
                    </a>
                </li>
            @endif
            <li class="nav-item  @if (in_array($current_route, ['albums.index','albums.edit','albums.show']))active open @endif">
                <a href="{{ route('albums.index') }}" class="nav-link ">
                    <span class="title">كل الألبومات </span>
                </a>
            </li>


        </ul>
    </li>
@endif

@if(in_array('add_video',$actions) || in_array('edit_video',$actions) || in_array('delete_video',$actions) || in_array('view_video',$actions))
    <li class="nav-item open">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-film"></i>
            <span class="title">الفيديو</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu" style="display: block">
            @if(in_array('add_video',$actions))
                <li class="nav-item  @if($current_route=='videos.create')active open @endif">
                    <a href="{{ route('videos.create') }}" class="nav-link ">
                        <span class="title">إضافة فيديو</span>
                    </a>
                </li>
            @endif
            <li class="nav-item  @if (in_array($current_route, ['videos.index','videos.edit']))active open @endif">
                <a href="{{ route('videos.index') }}" class="nav-link ">
                    <span class="title">كل الفيديوهات </span>
                </a>
            </li>


        </ul>
    </li>
@endif

@if(in_array('add_cat',$actions) || in_array('edit_cat',$actions) || in_array('delete_cat',$actions) || in_array('view_cat',$actions))
    <li class="nav-item @if(strpos($link_url, 'categories') !== false) open @endif">
        <a href="javascript:;" class="nav-link nav-toggle " >
            <i class="fa fa-navicon"></i>
            <span class="title">التصنيفات</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu" @if(strpos($link_url, 'categories') !== false) style="display: block" @endif>
            @if(in_array('add_cat',$actions))

                <li class="nav-item  @if($current_route=='categories.create')active open @endif">
                    <a href="{{ route('categories.create') }}" class="nav-link ">
                        <span class="title">إضافة تصنيف</span>
                    </a>
                </li>
            @endif
            <li class="nav-item  @if (in_array($current_route, ['categories.index','categories.edit']))active open @endif">
                <a href="{{ route('categories.index') }}" class="nav-link ">
                    <span class="title">كل التصنيفات </span>
                </a>
            </li>


        </ul>
    </li>
@endif



@if(in_array('add_page',$actions) || in_array('edit_page',$actions) || in_array('delete_page',$actions) || in_array('view_page',$actions))
    <li class="nav-item @if(strpos($link_url, 'pages') !== false) open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-sticky-note-o"></i>
            <span class="title">الصفحات</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu" @if(strpos($link_url, 'pages') !== false) style="display: block" @endif>
            @if(in_array('add_video',$actions))
                <li class="nav-item  @if($current_route=='pages.create')active open @endif">
                    <a href="{{ route('pages.create') }}" class="nav-link ">
                        <span class="title">إضافة صفحة</span>
                    </a>
                </li>
            @endif
            <li class="nav-item  @if (in_array($current_route, ['pages.index','pages.edit']))active open @endif">
                <a href="{{ route('pages.index') }}" class="nav-link ">
                    <span class="title">كل الصفحات</span>
                </a>
            </li>


        </ul>
    </li>
@endif

@if(in_array('delete_tag',$actions) || in_array('view_tag',$actions))
<li class="nav-item  @if(strpos($link_url, 'tags') !== false) open @endif">
    <a href="{{ route('tags.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-tags"></i>
        <span class="title">الوسوم</span>
    </a>
</li>
@endif

<li class="nav-item @if(strpos($link_url, 'mail_list') !== false) open @endif">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-reply-all"></i>
        <span class="title">القائمة البريدية</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu" @if(strpos($link_url, 'mail_list') !== false) style="display: block" @endif>
        <li class="nav-item  @if($current_route=='mail_list.index')active open @endif">
            <a href="{{ route('mail_list.index') }}" class="nav-link ">
                <span class="title">القائمة البريدية</span>
            </a>
        </li>
        <li class="nav-item  @if($current_route=='mail_list.mail_sent')active open @endif">
            <a href="{{ route('mail_list.mail_sent') }}" class="nav-link ">
                <span class="title">الرسائل المرسلة</span>
            </a>
        </li>
        <li class="nav-item  @if($current_route=='mail_list.send')active open @endif">
            <a href="{{ route('mail_list.send') }}" class="nav-link ">
                <span class="title">ارسال رسالة</span>
            </a>
        </li>

    </ul>
</li>
<li class="nav-item  @if(strpos($link_url, 'contactus') !== false) open @endif">
    <a href="{{ route('contactus.index') }}" class="nav-link nav-toggle">
        @if($new_message)  <span class="badge badge-warning">{{$new_message}}</span>@endif
        <i class="fa fa-envelope-o"></i>
        <span class="title">البريد الوارد</span>
    </a>
</li>
@if(in_array('setting',$actions))
    <li class="nav-item  @if(strpos($link_url, 'setting') !== false) open @endif">
        <a href="{{ route('setting.index') }}" class="nav-link nav-toggle">
            <i class="fa fa-gear"></i>
            <span class="title">الاعدادات</span>
        </a>
    </li>
@endif

@if(in_array('add_user',$actions) || in_array('edit_user',$actions) || in_array('delete_user',$actions) || in_array('view_user',$actions))
<li class="nav-item @if(strpos($link_url, 'users') !== false) open @endif">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-group"></i>
        <span class="title">المستخدمين</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu" @if(strpos($link_url, 'users') !== false) style="display: block" @endif>
        @if(in_array('add_user',$actions))
        <li class="nav-item  @if($current_route=='users.create')active open @endif">
            <a href="{{ route('users.create') }}" class="nav-link ">
                <span class="title">أضافة مستخدم</span>
            </a>
        </li>
        @endif

        <li class="nav-item  @if (in_array($current_route, ['users.index','users.edit','user.privilege']))active open @endif">
            <a href="{{ route('users.index') }}" class="nav-link ">
                <span class="title">كل المستخدمين </span>
            </a>
        </li>

        <li class="nav-item   @if (in_array($current_route, ['users.roles','roles.privilege_roles']))active open @endif">
            <a href="{{ route('users.roles') }}" class="nav-link ">
                <span class="title">مجموعات الصلاحيات</span>
            </a>
        </li>


    </ul>
</li>
@endif
