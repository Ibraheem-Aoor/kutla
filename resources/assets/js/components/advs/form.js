import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';

Vue.component('advs-form', {

    props: {
        adv: Object,
        setting: Array,
    },

    data() {
        return {
            title: null,
            url1: null,
            url2: null,
            url3: null,
            url4: null,
            iframe: null,
            position: null,
            image_src1: null,
            image_src2: null,
            image_src3: null,
            image_src4: null,
            cropImg: null,
            page: 'main',
            image_src_mobile1:null,
            image_src_mobile2:null,
            image_src_mobile3:null,
            image_src_mobile4:null,
            adv_number:1,
            iframe1:null,
            iframe2:null,
            iframe3:null,
            iframe4:null,
            active_adv:1,
            location:'all',
            actives:[{id:'1',name:'منشور'},{id:'0',name:'غير منشور'}],
            positions: [{id: 1, name: 'الهيدر'}, {id: 2,name: 'اعلان جانبي'}, {id: 3, name: 'اعلان قسم 1'}, {id: 14, name: 'اعلان أسفل القائمة الرئيسية'}
                , {id: 4, name: 'اعلان قسم 2'}, {id: 5, name: 'اعلان قسم 3'}, {id: 6, name: 'اعلان قسم 4'}, {id: 7, name: 'اعلان قسم 5'}
                , {id: 8, name: 'اعلان قسم 6'}, {id: 9, name: 'اعلان قسم 7'}, {id: 10, name: 'اعلان قسم 8'}, {id: 11, name: 'اعلان قسم 9'}
                , {id: 12, name: 'اعلان قسم 10'}, {id: 13, name: 'اعلان قسم 12'}],
            redirectPath: `${BASE_URL}/dashboard/advs`,
            image_src: null,
            saveAction: {
                link: `${BASE_URL}/dashboard/advs`,
                type: 'post'
            },
        }
    },

    mounted(){
        if(this.adv) {
            this.title = this.adv.title;
            this.page=this.adv.page;
            this.url1 = this.adv.url1;
            this.url2 = this.adv.url2;
            this.url3 = this.adv.url3;
            this.url4 = this.adv.url4;
            this.location=this.adv.location;
            this.iframe1 = this.adv.iframe1;
            this.iframe2 = this.adv.iframe2;
            this.iframe3 = this.adv.iframe3;
            this.iframe4 = this.adv.iframe4;
            this.image_src1 = _AVATAR_IMAGE1;
            this.image_src2 = _AVATAR_IMAGE2;
            this.image_src3 = _AVATAR_IMAGE3;
            this.image_src4 = _AVATAR_IMAGE4;
            this.image_src_mobile1 = _AVATAR_IMAGE_mobile1;
            this.image_src_mobile1 = _AVATAR_IMAGE_mobile2;
            this.image_src_mobile1 = _AVATAR_IMAGE_mobile3;
            this.image_src_mobile1 = _AVATAR_IMAGE_mobile4;
            this.position= this.getPosition(this.adv)
                this.active_adv=this.adv.active;

            this.saveAction = {
                link: `${BASE_URL}/dashboard/advs/${this.adv.id}`,
                type: 'post'
            };
        }
    },

    methods: {
        save() {
            let formdata = new FormData();
            formdata.append('location', this.location?this.location:'');
            formdata.append('url1', this.url1?this.url1:'');
            formdata.append('url2', this.url2?this.url2:'');
            formdata.append('url3', this.url3?this.url3:'');
            formdata.append('url4', this.url4?this.url4:'');
            formdata.append('title', this.title?this.title:'');
            formdata.append('position', this.position?this.position.id:'');
            formdata.append('page', this.page?this.page:'');
            formdata.append('active',this.active_adv?this.active_adv:'');
            formdata.append('image_src1', this.image_src1?document.getElementById('image_src1').files[0]:'');
            formdata.append('image_src2', this.image_src2?document.getElementById('image_src2').files[0]:'');
            formdata.append('image_src3', this.image_src3?document.getElementById('image_src3').files[0]:'');
            formdata.append('image_src4', this.image_src4?document.getElementById('image_src4').files[0]:'');
            formdata.append('image_src_mobile1', this.image_src_mobile1?document.getElementById('image_src_mobile1').files[0]:'');
            formdata.append('image_src_mobile2', this.image_src_mobile2?document.getElementById('image_src_mobile2').files[0]:'');
            formdata.append('image_src_mobile3', this.image_src_mobile3?document.getElementById('image_src_mobile3').files[0]:'');
            formdata.append('image_src_mobile4', this.image_src_mobile4?document.getElementById('image_src_mobile4').files[0]:'');
            formdata.append('image_src_mobile4', this.image_src_mobile4?document.getElementById('image_src_mobile4').files[0]:'');

            formdata.append('image_src1_edit', this.image_src1);
            formdata.append('image_src2_edit', this.image_src2);
            formdata.append('image_src3_edit', this.image_src3);
            formdata.append('image_src4_edit', this.image_src4);
            formdata.append('image_src_mobile1_edit', this.image_src_mobile1);
            formdata.append('image_src_mobile2_edit', this.image_src_mobile2);
            formdata.append('image_src_mobile3_edit', this.image_src_mobile3);
            formdata.append('image_src_mobile4_edit', this.image_src_mobile4);
            formdata.append('image_src_mobile4_edit', this.image_src_mobile4);
            formdata.append('iframe1', this.iframe1?this.iframe1:'');
            formdata.append('iframe2', this.iframe2?this.iframe2:'');
            formdata.append('iframe3', this.iframe3?this.iframe3:'');
            formdata.append('iframe4', this.iframe4?this.iframe4:'');


            this.saveForm(formdata);
        },
        setImage1: function (e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            var result = null;

            reader.onload = (function (theFile) {
                return function (e) {
                    var img = new Image();
                    img.src = e.target.result;
                    // this.imageResize(img);

                    result = reader.result;
                    this.image_src1=result;
                }.bind(this);
            }.bind(this))(file);
            reader.readAsDataURL(file);
        },
        setImage2: function (e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            var result = null;

            reader.onload = (function (theFile) {
                return function (e) {
                    var img = new Image();
                    img.src = e.target.result;
                    // this.imageResize(img);

                    result = reader.result;
                    this.image_src2=result;
                }.bind(this);
            }.bind(this))(file);
            reader.readAsDataURL(file);
        },
        setImage3: function (e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            var result = null;

            reader.onload = (function (theFile) {
                return function (e) {
                    var img = new Image();
                    img.src = e.target.result;
                    // this.imageResize(img);

                    result = reader.result;
                    this.image_src3=result;
                }.bind(this);
            }.bind(this))(file);
            reader.readAsDataURL(file);
        },
        setImage4: function (e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            var result = null;

            reader.onload = (function (theFile) {
                return function (e) {
                    var img = new Image();
                    img.src = e.target.result;
                    // this.imageResize(img);

                    result = reader.result;
                    this.image_src4=result;
                }.bind(this);
            }.bind(this))(file);
            reader.readAsDataURL(file);
        },
        setImageMobile1: function (e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            var result = null;

            reader.onload = (function (theFile) {
                return function (e) {
                    var img = new Image();
                    img.src = e.target.result;
                    // this.imageResize(img);
                    result = reader.result;
                    this.image_src_mobile1=result;
                }.bind(this);
            }.bind(this))(file);
            reader.readAsDataURL(file);
        },
        setImageMobile2: function (e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            var result = null;

            reader.onload = (function (theFile) {
                return function (e) {
                    var img = new Image();
                    img.src = e.target.result;
                    // this.imageResize(img);
                    result = reader.result;
                    this.image_src_mobile2=result;
                }.bind(this);
            }.bind(this))(file);
            reader.readAsDataURL(file);
        },
        setImageMobile3: function (e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            var result = null;

            reader.onload = (function (theFile) {
                return function (e) {
                    var img = new Image();
                    img.src = e.target.result;
                    // this.imageResize(img);
                    result = reader.result;
                    this.image_src_mobile3=result;
                }.bind(this);
            }.bind(this))(file);
            reader.readAsDataURL(file);
        },
        setImageMobile4: function (e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            var result = null;
            reader.onload = (function (theFile) {
                return function (e) {
                    var img = new Image();
                    img.src = e.target.result;
                    // this.imageResize(img);
                    result = reader.result;
                    this.image_src_mobile4=result;
                }.bind(this);
            }.bind(this))(file);
            reader.readAsDataURL(file);
        },
        delImage1: function (e) {
            this.image_src1=null;

        },
        delImage2: function (e) {
            this.image_src2=null;

        },
        delImage3: function (e) {
            this.image_src3=null;

        },
        delImage4: function (e) {
            this.image_src4=null;

        },
        delImageMobile1: function (e) {
            this.image_src_mobile1=null;

        },
        delImageMobile2: function (e) {
            this.image_src_mobile2=null;

        },
        delImageMobile3: function (e) {
            this.image_src_mobile3=null;

        },
        delImageMobile4: function (e) {
            this.image_src_mobile4=null;

        },
        changePage(){
       if(this.page=='main'){
           this.positions= [{id: 1, name: 'الهيدر'}, {id: 2,name: 'اعلان جانبي'}, {id: 3, name: 'اعلان قسم 1'}, {id: 14, name: 'اعلان أسفل القائمة الرئيسية'}
               , {id: 4, name: 'اعلان قسم 2'}, {id: 5, name: 'اعلان قسم 3'}, {id: 6, name: 'اعلان قسم 4'}, {id: 7, name: 'اعلان قسم 5'}
               , {id: 8, name: 'اعلان قسم 6'}, {id: 9, name: 'اعلان قسم 7'}, {id: 10, name: 'اعلان قسم 8'}, {id: 11, name: 'اعلان قسم 9'}
               , {id: 12, name: 'اعلان قسم 10'}, {id: 13, name: 'اعلان قسم 12'}];
       }else{
           if(this.page=='details'){
               this.positions= [{id: 1, name: 'اعلان جانبي 1'}, {id: 2,name: 'اعلان جانبي 2'}, {id: 3, name: 'اعلان جانبي 3'}
                   , {id: 4, name: 'أسفل عنوان الخبر'}, {id: 5, name: 'داخل تفاصيل الخبر'}, {id: 6, name: 'تحت تفاصيل الخبر'},
                   {id: 7, name: 'بجانب تفاصيل الخبر'},
                   {id: 8, name: 'اعلان تفاعلي'}];
           }else{
               this.positions= [{id: 1, name: 'اعلان جانبي 1'}, {id: 2,name: 'اعلان جانبي 2'}, {id: 3, name: 'اعلان جانبي 3'},{id: 4, name: 'بجانب الفنادق'}];
           }
       }
        },
        getPosition(pos){
            let array_position=[];

            if(pos.page=='main'){
                array_position= [{id: 1, name: 'الهيدر'}, {id: 2,name: 'اعلان جانبي'}, {id: 3, name: 'اعلان قسم 1'}, {id: 14, name: 'اعلان أسفل القائمة الرئيسية'}
                    , {id: 4, name: 'اعلان قسم 2'}, {id: 5, name: 'اعلان قسم 3'}, {id: 6, name: 'اعلان قسم 4'}, {id: 7, name: 'اعلان قسم 5'}
                    , {id: 8, name: 'اعلان قسم 6'}, {id: 9, name: 'اعلان قسم 7'}, {id: 10, name: 'اعلان قسم 8'}, {id: 11, name: 'اعلان قسم 9'}
                    , {id: 12, name: 'اعلان قسم 10'}, {id: 13, name: 'اعلان قسم 12'}];
            }else{
                if(pos.page=='details'){
                    array_position= [{id: 1, name: 'اعلان جانبي 1'}, {id: 2,name: 'اعلان جانبي 2'}, {id: 3, name: 'اعلان جانبي 3'}
                        , {id: 4, name: 'أسفل عنوان الخبر'}, {id: 5, name: 'داخل تفاصيل الخبر'}, {id: 6, name: 'تحت تفاصيل الخبر'},
                        {id: 7, name: 'بجانب تفاصيل الخبر'},{id: 8, name: 'اعلان تفاعلي'}];
                }else{
                    array_position= [{id: 1, name: 'اعلان جانبي 1'}, {id: 2,name: 'اعلان جانبي 2'}, {id: 3, name: 'اعلان جانبي 3'},{id: 4, name: 'بجانب الفنادق'}];
                }
            }
            let types = {
                main: 0,
                details: 1,
                hotels: 2
            };
            let page_type=types[pos.page];
            let postiton_type = {
                1: 'adv_part_1',
                2: 'adv_part_2',
                3: 'adv_part_3',
                4: 'adv_part_4',
                5: 'adv_part_5',
                6: 'adv_part_6',
                7: 'adv_part_7',
                8: 'adv_part_8',
                9: 'adv_part_9',
                10: 'adv_part_10',
                11: 'adv_part_11',
                12: 'adv_part_12',
                13: 'adv_part_13',
                14:'ad_part_14'

            };
            let position_chose=postiton_type[pos.position]
            this.adv_number=this.setting[page_type][position_chose];
            let index = array_position.findIndex(x => x.id==pos.position);
            return array_position[index];
        },
        changePosition(){
       let number_ad=1;
       let mor_add=true;
            if(this.position.id==14){
                let number_ad=1;
                mor_add=false;
            }else{
                mor_add=true;
            }
       if(this.page=='hotels'){
           if(this.position.id==4){
               let number_ad=1;
               mor_add=false;
           }else{
               mor_add=true;
           }
       }else{
           if(this.page=='details'){
               if(this.position.id==7){
                   let number_ad=1;
                   mor_add=false;
               }else{
                   mor_add=true;
               }
           }else{
               mor_add=true;
           }
       }
       if(mor_add){
           let types = {
               main: 0,
               details: 1,
               hotels: 2
           };
           let postiton_type = {
               1: 'adv_part_1',
               2: 'adv_part_2',
               3: 'adv_part_3',
               4: 'adv_part_4',
               5: 'adv_part_5',
               6: 'adv_part_6',
               7: 'adv_part_7',
               8: 'adv_part_8',
               9: 'adv_part_9',
               10: 'adv_part_10',
               11: 'adv_part_11',
               12: 'adv_part_12',
               13: 'adv_part_13',
               14:'ad_part_14'

           };
           let page_type=types[this.page];
           let position_chose=postiton_type[this.position.id]
           this.adv_number=this.setting[page_type][position_chose];

       }

        },
        canShow1(){
            if(this.position){
                if(this.position.id!=2 && this.adv_number==1){
                    return true;
                }
            }else{
                return false
            }
        },

        canShow3(){
            if(this.position){
                if(this.position.id!=2 && this.adv_number==2){
                    return true;
                }
            }else{
                return false
            }
        },
        canShow5(){
            if(this.position){
                if(this.position.id!=2 && this.adv_number==3){
                    return true;
                }
            }else{
                return false
            }
        },
        canShow7(){
            if(this.position){
                if(this.position.id!=2 && this.adv_number==4){
                    return true;
                }
            }else{
                return false
            }
        },
        canShow2(){
            if(this.position){
                if(this.page=='main') {
                    if (this.position.id == 2 && this.adv_number == 1) {
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    if ((this.position.id == 1 || this.position.id == 2 || this.position.id == 3)&& this.adv_number == 1) {
                        return true;
                    }else{
                        return false;
                    }

                }
            }else{
                return false
            }
        },
        canShow4(){
            if(this.position){
                if(this.page=='main') {
                    if (this.position.id == 2 && this.adv_number == 2) {
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    if ((this.position.id == 1 || this.position.id == 2 || this.position.id == 3)&& this.adv_number == 2) {
                        return true;
                    }else{
                        return false;
                    }

                }
            }else{
                return false
            }
        },
        canShow6(){
            if(this.position){
                if(this.page=='main') {
                    if (this.position.id == 2 && this.adv_number == 3) {
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    if ((this.position.id == 1 || this.position.id == 2 || this.position.id == 3)&& this.adv_number == 3) {
                        return true;
                    }else{
                        return false;
                    }

                }
            }else{
                return false
            }
        },
        canShow8(){
            if(this.position){
                if(this.page=='main') {
                    if (this.position.id == 2 && this.adv_number == 4) {
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    if ((this.position.id == 1 || this.position.id == 2 || this.position.id == 3)&& this.adv_number == 4) {
                        return true;
                    }else{
                        return false;
                    }

                }
            }else{
                return false
            }
        },
        canShow9(){
            if(this.position){
                if(this.page=='main') {
                  return false;
                }else{
                    if(this.page=='details'){
                        if(this.position.id==7){
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        if(this.position.id==4){
                            return true;
                        }else{
                            return false;
                        }
                    }

                }
            }else{
                return false
            }
        },

    },
    components: {
        VSelect: Multiselect
    },

    mixins: [form],
});