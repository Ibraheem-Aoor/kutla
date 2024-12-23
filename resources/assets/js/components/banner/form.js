import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';

Vue.component('banner-form', {


    props: {
        case: Object,

    },

    data() {
        return {
            title: null,
            link:null,
            image1:null,
            image2:null,
            uploaded_imgs_base64:[],
            desctiption:null,
            gif_image:null,
            gif_image_url:null,
            image1_change:null,
            image2_change:null,
            gif_image_change:null,
            gif_active:[{id:'1',name:'منشور'},{id:'0',name:'غير منشور'}],
            gif_active_case:[{id:'0',name:'غير منشور'}],
            active_case:{id:'1',name:'منشور'},
            gif:null,
            actives:[{id:'1',name:'منشور'},{id:'0',name:'غير منشور'}],

            redirectPath: `${BASE_URL}/dashboard`,
            saveAction: {
                link: `${BASE_URL}/dashboard/banner`,
                type: 'post'
            },
        }
    },

    mounted(){
        if(this.case) {
            this.title = this.case.title;
            this.link = this.case.link;
            this.image1 = this.case.image_first;
            this.image2 = this.case.image_second;
            this.gif_image_url = this.case.gif_url;
            this.gif_active = this.case.gif_active;


            if(this.case.active==1){
                this.active_case={id:'1',name:'منشور'};
            }else{
                this.active_case={id:'0',name:'غير منشور'};
            }
            if(this.case.gif_active==1){
                this.gif_active_case={id:'1',name:'منشور'};
            }else{
                this.gif_active_case={id:'0',name:'غير منشور'};
            }
            jQuery('#main_photo_id').val(this.case.photo_id);

            this.saveAction = {
                link: `${BASE_URL}/dashboard/banner/${this.case.id}`,

                type: 'put'
            };
            // console.log(this.saveAction)
        }

    },

    methods: {
        save() {


            let data = {
                title: this.title,
                link: this.link,
                active:this.active_case?this.active_case.id:'',
                gif_active:this.gif_active_case?this.gif_active_case.id:'',
                photo_id:jQuery('#main_photo_id').val(),
                image1:this.image1,
                image1_change:this.image1_change,
                image2_change:this.image2_change,
                gif_image_change:this.gif_image_change,
                image2:this.image2,
                gif_image_url:this.gif_image_url,
                gif:this.gif
            };
            this.saveForm(data);
        },
        getFile: function (e,type) {

            let imagecount = e.target.files.length
            for (let i = 0; i < imagecount; i++) {

                setTimeout(()=>{
                    var file = e.target.files[i];
                    var reader = new FileReader();

                    var result = null;

                    reader.onload = (function (theFile) {
                        console.log(theFile)
                        return function (e) {
                            var img = new Image();
                            img.src = e.target.result;
                            // this.imageResize(img);

                            result = reader.result;

                            if(type == 1){
                                this.image1 = result;
                                this.image1_change=true;
                            }else if(type == 3)
                            {

                                this.sendFile();
                                this.gif_image_url =result;
                                this.gif_image_change=true;

                            }
                            else{
                                this.image2 = result;
                                this.image2_change=true;
                            }
                            //  this.uploaded_imgs_base64.push(result);

                        }.bind(this);
                    }.bind(this))(file);
                    reader.readAsDataURL(file);
                }, 500);
            }
        },
        removeImg(img){
            //  this.images.$remove(img);
            let index = this.uploaded_imgs_base64.indexOf(img);
            this.uploaded_imgs_base64.splice(index, 1);
        },
        sendFile(){
            let file = this.$refs.file.files[0];
            let formdata = new FormData();
            formdata.append('file', document.getElementById('inputfile4').files[0]);

            axios.post(
                `${BASE_URL}/dashboard/banner`,
                formdata,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(response => {
                this.gif=response.data;
            });

        },

    },
    components: {
        VSelect: Multiselect
    },

    mixins: [form],
});