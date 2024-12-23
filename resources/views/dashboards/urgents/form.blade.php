@extends('layouts.app')

@section('content')
    <urgents-form  :categories='{{ $categories->toJson() }}' :urgent='{!! isset($urgent) ? $urgent : 'null' !!}'  inline-template>
        <div class="row">
            <div class="col-md-6">
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
                                <label>نص الخبر</label>
                                <input type="text" class="form-control" v-model="title">
                                <span v-if="form.error && form.validations.title" class="help-block">@{{ form.validations.title[0] }}</span>
                            </div>
                            {{--<div class="form-group"--}}
                                 {{--:class="{ 'has-error': form.error && form.validations.category_id }">--}}
                                {{--<label>التصنيف</label>--}}
                                {{--<v-select v-model="category_id" track-by="id" label="name"--}}
                                          {{--placeholder="اختر التصنيف" :options="categories" :searchable="true"--}}
                                          {{--:allow-empty="true" select-label="اضغط انتر للتحديد"--}}
                                          {{--deselect-label="إضغط انتر لإلغاء التحديد"></v-select>--}}
                                {{--<span v-if="form.error && form.validations.category_id" class="help-block">@{{ form.validations.category_id[0] }}</span>--}}
                            {{--</div>--}}
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.url }">
                                <label>رابط الخبر</label>
                                <input type="text" class="form-control" v-model="url">
                                <span v-if="form.error && form.validations.url" class="help-block">@{{ form.validations.url[0] }}</span>
                            </div>

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.duration }">
                                <label>مدة الظهور بالدقائق</label>
                                <input type="number" min="1" class="form-control" v-model="duration">
                                <span v-if="form.error && form.validations.duration" class="help-block">@{{ form.validations.duration[0] }}</span>
                            </div>



                        </div>
                        <div class="form-actions">
                            <button @click="save" class="btn blue" :disabled="form.disabled">
                                <span v-if="form.disabled">
                                    <i class="fa fa-btn fa-spinner fa-spin"></i>
                                </span> حفظ
                            </button>
                            <a href="{{ route('categories.index') }}" class="btn default">إلغاء الأمر</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </urgents-form>
@endsection
@push('styles')

    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
    @endpush