@extends('layouts.app')

@section('content')
    <mail_list-send  inline-template>
        <div class="row">
            <div class="col-md-8">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">{{ meta('title') }}</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.title }">
                                <label>عنوان الرسالة</label>
                                <input  class="form-control" v-model="title">
                                <span v-if="form.error && form.validations.title" class="help-block">@{{ form.validations.title[0] }}</span>
                            </div>
                             </div>
                        <div class="table-scrollable">
                            <table-component ref="table" :data="fetchData" :table-class="'table table-striped table-bordered table-hover'"
                                             :filter-input-class="'form-control'"
                                             :show-caption="false"
                                             sort-by="created_at"
                                             sort-order="desc"
                                             filter-no-results="عذرا, لقد تعذر وجود بيانات!"
                            >

                                <table-column label="عنوان المنشور" show="title"></table-column>
                                <table-column label="التصنيف" show="category_id">
                                    <template scope="post">
                                        <span>@{{ post.category ? post.category.name : '' }}</span>
                                    </template>
                                </table-column>


                                <table-column label="تاريخ النشر" show="published_at_days"></table-column>

                                <table-column label="عدد القراءات" show="read_number"></table-column>
                                <table-column label="" :sortable="false" :filterable="false">

                                    <template scope="post">


                                        <button @click="chose_post(post)" class="btn blue">
                                اختيار
                                        </button>

                                    </template>
                                </table-column>
                            </table-component>
                        </div>

                        </div>
                        <div class="form-actions">
                            <button @click="save" class="btn blue" :disabled="form.disabled">
                                <span v-if="form.disabled">
                                    <i class="fa fa-btn fa-spinner fa-spin"></i>
                                </span> ارسال
                            </button>
                            <a href="{{ route('writers.index') }}" class="btn default">إلغاء الأمر</a>
                        </div>
                    </div>
                </div>
            <div class="col-md-4">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">المنشورات المختارة</span>
                        </div>
                    </div>
                    <span v-if="form.error && form.validations.posts_chose" class="help-block">@{{ form.validations.posts_chose[0] }}</span>

                    <div class="portlet-body form">

                        <div class="table-scrollable" v-if="posts_chose.length">
                            <table class="table table-striped table-bordered table-hover">
                                <tr>
                                    <td>
                                      #
                                    </td>
                                    <td>
                                        العنوان
                                    </td>
                                    <td>
                                        حذف
                                    </td>
                                </tr>
                                <tr v-for="(post,index) in posts_chose">
                                    <td>@{{ index+1 }}</td>
                                    <td>
                                        @{{ post.title }}
                                    </td>
                                    <td >
                                        <a @click="deletePost(post,index)" href="javascript:;" class="btn btn-xs red filter-cancel">
                                            <i aria-hidden="true" class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>


                            </table>
                        </div>

                    </div>

                </div>
            </div>
            </div>
        </div>
    </reports-form>

@endsection
@push('styles')
    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/dist/theme-chalk.css') }}">

        <style>
            .el-picker-panel__content.el-date-range-picker__content.is-left{
                float: right;
            }
            .el-date-editor.el-input, .el-date-editor.el-input__inner{
                width: 472px !important;
            }
        </style>
    @endpush
