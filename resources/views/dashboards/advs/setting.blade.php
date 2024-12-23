@extends('layouts.app')

@section('content')
    <advs-settings  :setting='{!! isset($setting) ? $setting : 'null' !!}'  inline-template>
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
                            <h2>اعلانات الصفحة الرئيسية</h2>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان الهيدر</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="header" id="header" value="1" v-model="header" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="header" id="header" value="2" v-model="header" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="header" id="header" value="3" v-model="header"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="header" id="header" value="4" v-model="header"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="header" id="header" value="5" v-model="header">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">تحت القائمة الرئيسية</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="main_under_title" id="header" value="1" v-model="main_under_title" > يعمل
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="main_under_title" id="header" value="5" v-model="main_under_title">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان الجانبي</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="main_side_1" id="header" value="1" v-model="main_side_1" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="main_side_1" id="header" value="2" v-model="main_side_1" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="main_side_1" id="header" value="3" v-model="main_side_1"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="main_side_1" id="header" value="4" v-model="main_side_1"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="main_side_1" id="header" value="5" v-model="main_side_1">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان القسم 1</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="part_1" id="header" value="1" v-model="part_1" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_1" id="header" value="2" v-model="part_1" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_1" id="header" value="3" v-model="part_1"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_1" id="header" value="4" v-model="part_1"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_1" id="header" value="5" v-model="part_1">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان القسم 2</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="part_2" id="header" value="1" v-model="part_2" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_2" id="header" value="2" v-model="part_2" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_2" id="header" value="3" v-model="part_2"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_2" id="header" value="4" v-model="part_2"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_2" id="header" value="5" v-model="part_2">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان القسم 3</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="part_3" id="header" value="1" v-model="part_3" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_3" id="header" value="2" v-model="part_3" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_3" id="header" value="3" v-model="part_3"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_3" id="header" value="4" v-model="part_3"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_3" id="header" value="5" v-model="part_3">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان القسم 4</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="part_4" id="header" value="1" v-model="part_4" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_4" id="header" value="2" v-model="part_4" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_4" id="header" value="3" v-model="part_4"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_4" id="header" value="4" v-model="part_4"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_4" id="header" value="5" v-model="part_4">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان القسم 5</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="part_5" id="header" value="1" v-model="part_5" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_5" id="header" value="2" v-model="part_5" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_5" id="header" value="3" v-model="part_5"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_5" id="header" value="4" v-model="part_5"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_5" id="header" value="5" v-model="part_5">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان القسم 6</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="part_6" id="header" value="1" v-model="part_6" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_6" id="header" value="2" v-model="part_6" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_6" id="header" value="3" v-model="part_6"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_6" id="header" value="4" v-model="part_6"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_6" id="header" value="5" v-model="part_6">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان القسم 7</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="part_7" id="header" value="1" v-model="part_7" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_7" id="header" value="2" v-model="part_7" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_7" id="header" value="3" v-model="part_7"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_7" id="header" value="4" v-model="part_7"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_7" id="header" value="5" v-model="part_7">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان القسم 8</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="part_8" id="header" value="1" v-model="part_8" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_8" id="header" value="2" v-model="part_8" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_8" id="header" value="3" v-model="part_8"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_8" id="header" value="4" v-model="part_8"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_8" id="header" value="5" v-model="part_8">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان القسم 9</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="part_9" id="header" value="1" v-model="part_9" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_9" id="header" value="2" v-model="part_9" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_9" id="header" value="3" v-model="part_9"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_9" id="header" value="4" v-model="part_9"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_9" id="header" value="5" v-model="part_9">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان القسم 10</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="part_10" id="header" value="1" v-model="part_10" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_10" id="header" value="2" v-model="part_10" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_10" id="header" value="3" v-model="part_10"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_10" id="header" value="4" v-model="part_10"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_10" id="header" value="5" v-model="part_10">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان القسم 11</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="part_11" id="header" value="1" v-model="part_11" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_11" id="header" value="2" v-model="part_11" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_11" id="header" value="3" v-model="part_11"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_11" id="header" value="4" v-model="part_11"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="part_11" id="header" value="5" v-model="part_11">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h2>اعلانات صفحة تفاصيل الخبر</h2>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان جانبي 1</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_1" id="header" value="1" v-model="details_side_1" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_1" id="header" value="2" v-model="details_side_1" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_1" id="header" value="3" v-model="details_side_1"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_1" id="header" value="4" v-model="details_side_1"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_1" id="header" value="5" v-model="details_side_1">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان جانبي 2</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_2" id="header" value="1" v-model="details_side_2" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_2" id="header" value="2" v-model="details_side_2" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_2" id="header" value="3" v-model="details_side_2"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_2" id="header" value="4" v-model="details_side_2"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_2" id="header" value="5" v-model="details_side_2">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان جانبي 3</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_3" id="header" value="1" v-model="details_side_3" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_3" id="header" value="2" v-model="details_side_3" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_3" id="header" value="3" v-model="details_side_3"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_3" id="header" value="4" v-model="details_side_3"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_side_3" id="header" value="5" v-model="details_side_3">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">أسفل عنوان الخبر</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="under_title" id="header" value="1" v-model="under_title" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="under_title" id="header" value="2" v-model="under_title" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="under_title" id="header" value="3" v-model="under_title"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="under_title" id="header" value="4" v-model="under_title"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="under_title" id="header" value="5" v-model="under_title">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">داخل تفاصيل الخبر</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="details_inside" id="header" value="1" v-model="details_inside" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_inside" id="header" value="2" v-model="details_inside" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_inside" id="header" value="3" v-model="details_inside"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_inside" id="header" value="4" v-model="details_inside"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="details_inside" id="header" value="5" v-model="details_inside">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">تحت تفاصيل الخبر</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="after_details" id="header" value="1" v-model="after_details" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="after_details" id="header" value="2" v-model="after_details" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="after_details" id="header" value="3" v-model="after_details"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="after_details" id="header" value="4" v-model="after_details"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="after_details" id="header" value="5" v-model="after_details">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">بجانب تفاصيل الخبر</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="infront_details" id="header" value="1" v-model="infront_details" > يعمل
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="infront_details" id="header" value="5" v-model="infront_details">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <br/>
                            <h2>اعلانات صفحة الفنادق</h2>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان جانبي 1</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_1" id="header" value="1" v-model="hotel_side_1" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_1" id="header" value="2" v-model="hotel_side_1" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_1" id="header" value="3" v-model="hotel_side_1"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_1" id="header" value="4" v-model="hotel_side_1"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_1" id="header" value="5" v-model="hotel_side_1">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان جانبي 2</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_2" id="header" value="1" v-model="hotel_side_2" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_2" id="header" value="2" v-model="hotel_side_2" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_2" id="header" value="3" v-model="hotel_side_2"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_2" id="header" value="4" v-model="hotel_side_2"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_2" id="header" value="5" v-model="hotel_side_2">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اعلان جانبي 3</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_3" id="header" value="1" v-model="hotel_side_3" > 1
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_3" id="header" value="2" v-model="hotel_side_3" > 2
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_3" id="header" value="3" v-model="hotel_side_3"> 3
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_3" id="header" value="4" v-model="hotel_side_3"> 4
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="hotel_side_3" id="header" value="5" v-model="hotel_side_3">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">بجانب الفنادق</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="infront_hotels" id="header" value="1" v-model="infront_hotels" > يعمل
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="infront_hotels" id="header" value="5" v-model="infront_hotels">متوقف
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group"  style="visibility: hidden;">
                                <label></label>
                                <input type="text" class="form-control" >
                            </div>

                        </div>
                        <div class="form-actions">
                            <button @click="save" class="btn blue" :disabled="form.disabled">
                                <span v-if="form.disabled">
                                    <i class="fa fa-btn fa-spinner fa-spin"></i>
                                </span> حفظ
                            </button>
                            <a href="{{ route('advs.index') }}" class="btn default">إلغاء الأمر</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </advs-form>
@endsection
