@extends('layouts.app')

@section('content')
    <users-form :user='{!! isset($user) ? $user->toJson() : 'null' !!}' :roles='{!! $roles->toJson() !!}' inline-template>
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
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.name }">
                                <label>إسم المستخدم</label>
                                <input type="text" class="form-control" v-model="name">
                                <span v-if="form.error && form.validations.name" class="help-block">@{{ form.validations.name[0] }}</span>
                            </div>
                            @if(in_array('add_user',$actions) )

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.role_id }">
                                <label>مجموعة الصلاحيات</label>
                                <v-select v-model="role_id" track-by="id" label="name" placeholder="اختر المجموعة" :options="roles" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                <span v-if="form.error && form.validations.role_id" class="help-block">@{{ form.validations.role_id[0] }}</span>
                            </div>
                            @endif

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.mobile }">
                                <label>رقم الموبايل</label>
                                <input type="text" class="form-control" v-model="mobile">
                                <span v-if="form.error && form.validations.mobile" class="help-block">@{{ form.validations.mobile[0] }}</span>
                            </div>

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.email }">
                                <label>البريد الالكتروني</label>
                                <input type="email" class="form-control" v-model="email">
                                <span v-if="form.error && form.validations.email" class="help-block">@{{ form.validations.email[0] }}</span>
                            </div>

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.password }">
                                <label>الباسوورد</label>
                                <input type="password" class="form-control" v-model="password">
                                <span v-if="form.error && form.validations.password" class="help-block">@{{ form.validations.password[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.image }">
                                <label>الصورة</label>
                                <input type="file" name="image" accept="image/*"
                                       style="font-size: 1.2em; padding: 10px 0;"
                                       @change="setImage"
                                />
                                <span v-if="form.error && form.validations.image" class="help-block">@{{ form.validations.image[0] }}</span>
                                <vue-cropper v-show="imgSrc"
                                             ref='cropper'
                                             :guides="true"
                                             :view-mode="2"
                                             drag-mode="crop"
                                             :auto-crop-area="1"
                                             :min-container-width="250"
                                             :min-container-height="180"
                                             :background="true"
                                             :src="imgSrc"
                                             :cropmove="cropImage"
                                             :img-style="{ width: '400px', 'height': '300px' }"
                                >
                                </vue-cropper>
                            </div>
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
    </users-form>
@endsection

@push('styles')
    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
<script>
    let _AVATAR_IMAGE = '{{ isset($user) && strlen($user->photo) ? convertImageToBase64(public_path().'/'.$user->photo) : null }}';
</script>