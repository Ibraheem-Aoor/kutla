@extends('layouts.app')

@section('content')
    <action-role :role='{!! isset($role) ? $role->toJson() : 'null' !!}' :user='{!! isset($user) ? $user->toJson() : 'null' !!}' :actions='{!! json_encode($actions) !!}' inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">{{ meta('title') }}</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th > # </th>
                                    <th >القسم</th>
                                    <th > إضافة</th>
                                    <th >تعديل </th>
                                    <th >حذف</th>
                                    <th> عرض</th>
                                    <th> <el-checkbox v-model="checkall"> تحديد الكل </el-checkbox></th>


                                </tr>
                                </thead>
                                <tbody class="appendTr">

                                <?php $x=0;?>
                                <tr >
                                    <td class="uk-text-center count"> {{$x=$x+1}} </td>
                                    <td >المنشورات </td>
                                    <td><el-checkbox v-model="privilege[0]['add_post']"> </el-checkbox>  </td>
                                    <td> <el-checkbox v-model="privilege[1]['edit_post']"> </el-checkbox>   </td>
                                    <td> <el-checkbox v-model="privilege[2]['delete_post']"> </el-checkbox> </td>
                                    <td><el-checkbox v-model="privilege[3]['view_post']"></el-checkbox> </td>
                                </tr>
                                <tr >
                                    <td class="uk-text-center count"> {{$x=$x+1}} </td>
                                    <td>التصنيفات </td>
                                    <td><el-checkbox v-model="privilege[4]['add_cat']"> </el-checkbox>   </td>
                                    <td><el-checkbox v-model="privilege[5]['edit_cat']"> </el-checkbox>  </td>
                                    <td> <el-checkbox v-model="privilege[6]['delete_cat']"> </el-checkbox>  </td>
                                    <td><el-checkbox v-model="privilege[7]['view_cat']"> </el-checkbox></td>
                                </tr>
                                <tr >
                                    <td class="uk-text-center count"> {{$x=$x+1}} </td>
                                    <td>الألبومات </td>
                                    <td><el-checkbox v-model="privilege[8]['add_album']"> </el-checkbox> </td>
                                    <td><el-checkbox v-model="privilege[9]['edit_album']"> </el-checkbox> </td>
                                    <td><el-checkbox v-model="privilege[10]['delete_album']"> </el-checkbox> </td>
                                    <td><el-checkbox v-model="privilege[11]['view_album']"> </el-checkbox></td>
                                </tr>
                                <tr >
                                    <td class="uk-text-center count"> {{$x=$x+1}} </td>
                                    <td>الفيديو </td>
                                    <td><el-checkbox v-model="privilege[12]['add_video']" > </el-checkbox>  </td>
                                    <td><el-checkbox v-model="privilege[13]['edit_video']"> </el-checkbox>  </td>
                                    <td><el-checkbox v-model="privilege[14]['delete_video']"> </el-checkbox> </td>
                                    <td><el-checkbox v-model="privilege[15]['view_video']"> </el-checkbox></td>
                                </tr>
                                <tr >
                                    <td class="uk-text-center count"> {{$x=$x+1}} </td>
                                    <td>المستخدمين </td>
                                    <td><el-checkbox v-model="privilege[16]['add_user']"> </el-checkbox>   </td>
                                    <td><el-checkbox v-model="privilege[17]['edit_user']"> </el-checkbox></td>
                                    <td><el-checkbox v-model="privilege[18]['delete_user']"> </el-checkbox> </td>
                                    <td><el-checkbox v-model="privilege[19]['view_user']"> </el-checkbox></td>
                                </tr>
                                <tr >
                                    <td class="uk-text-center count"> {{$x=$x+1}} </td>
                                    <td>الوسوم </td>
                                    <td>   </td>
                                    <td>   </td>
                                    <td> <el-checkbox v-model="privilege[20]['delete_tag']" > </el-checkbox></td>
                                    <td><el-checkbox v-model="privilege[21]['view_tag']"> </el-checkbox></td>
                                </tr>
                                <tr >
                                    <td class="uk-text-center count"> {{$x=$x+1}} </td>
                                    <td>الصفحات </td>
                                    <td> <el-checkbox v-model="privilege[34]['add_page']"> </el-checkbox>  </td>
                                    <td> <el-checkbox v-model="privilege[35]['edit_page']"> </el-checkbox> </td>
                                    <td><el-checkbox  v-model="privilege[36]['delete_page']" > </el-checkbox>     </td>
                                    <td><el-checkbox  v-model="privilege[37]['view_page']"> </el-checkbox></td>
                                </tr>
                                <tr >
                                    <td class="uk-text-center count"> {{$x=$x+1}} </td>
                                    <td>اعدادات النظام </td>
                                    <td> <el-checkbox v-model="privilege[46]['setting']"> </el-checkbox>  </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>


                        </div>
                        <div class="form-actions">
                            <button @click="save" class="btn blue" :disabled="form.disabled">
                                <span v-if="form.disabled">
                                    <i class="fa fa-btn fa-spinner fa-spin"></i>
                                </span> حفظ
                            </button>
                            <a href="{{ route('users.index') }}" class="btn default">إلغاء الأمر</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </action-role>
@endsection
<style>
    .el-checkbox__inner{
        width: 20px !important;
        height: 20px !important;
    }
    .el-checkbox__inner::after{
        height: 11px !important;
        left: 7px !important;
    }
</style>
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">

@endpush
