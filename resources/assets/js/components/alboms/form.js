import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';
import {Checkbox} from 'element-ui';
import moment from "moment";
import {DateTimePicker} from 'element-ui';
Vue.component('alboms-form', {


    props: {
        albom: Object,
        cases:Array
    },

    data() {
        return {
            watermark:false,
            name: null,
            category_id: this.categories?this.categories[0]:null,
            details: null,
            case_id:null,
            categories: [],
            uploaded_imgs: [],
            uploaded_imgs_base64: [],
            upload:{
                disabled:false
            },
            publish_at: this.changeDate(new Date()),
            active_post:{id:'1',name:'منشور'},
            actives:[{id:'1',name:'منشور'},{id:'0',name:'مسودة'}],
            redirectPath: `${BASE_URL}/dashboard/albums`,
            saveAction: {
				link: `${BASE_URL}/dashboard/albums`,
                type: 'post'
            },
            pickerOptions: {
                disabledDate(date) {
                    return date > new Date();
                }
            }
        }
    },

    mounted(){
        if(this.albom) {
            this.name = this.albom.name;
            this.category_id = this.albom.category_id;
            this.details = this.albom.details;
            this.uploaded_imgs=this.albom.photos;
            this.case_id=this.albom.cases?this.albom.cases:'';
            this.publish_at = this.albom.published_at;
            if(this.albom.active==1){
                this.active_post={id:'1',name:'منشور'};
            }else{
                this.active_post={id:'0',name:'مسودة'};
            }
            this.saveAction = {
                link: `${BASE_URL}/dashboard/albums/${this.albom.id}`,
                type: 'put'
            };
        }
        this.getAlbomCat();
    },

    methods: {
        save() {
            let data = {
                name: this.name,
                category_id: this.category_id,
                details: this.details,
                images: this.uploaded_imgs,
                case_id:this.case_id?this.case_id.id:'',
                watermark:this.watermark,
                active:this.active_post?this.active_post.id:'',
                publish_at:this.publish_at

        };

            // async function firstAsync() {
            //     this.saveImageForAlbom()
            // }
            //
            // firstAsync().then(  );
            this.saveForm(data)

        },

        getAlbomCat(){
            axios.get(`${BASE_URL}/dashboard/albums/getAlbomCat`).then(response => {
                this.categories=response.data;
                this.category_id= this.categories?this.categories[0].id:null;

            }).catch(error => {

            })
        },

        removeImg(img){
            //  this.images.$remove(img);
            let index = this.uploaded_imgs.indexOf(img)
            this.uploaded_imgs.splice(index, 1);
        },

        getFile: function (e) {

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
                    this.uploaded_imgs_base64.push(result);

                }.bind(this);
            }.bind(this))(file);
            reader.readAsDataURL(file);
                }, 500);
        }
        },

        saveImageForAlbom(){
            this.upload.disabled=true
            for( let i=0;i<this.uploaded_imgs_base64.length;i++){
                axios.post(`${BASE_URL}/dashboard/albums/saveImageForAlbom`,{
                    image:this.uploaded_imgs_base64[i],
                    watermark:this.watermark
                }).then(response => {
                    this.uploaded_imgs.push(response.data.photo_id);
                    this.upload.disabled=true
                }).catch(error => {

                })

            }
            this.upload.disabled=false;
            return true


        },
        uploadImage(){
            this.upload.disabled=true;
            for( let i=0;i<this.uploaded_imgs_base64.length;i++){
                axios.post(`${BASE_URL}/dashboard/albums/saveImageForAlbom`,{
                    image:this.uploaded_imgs_base64[i],
                    watermark:this.watermark
                }).then(response => {
                    this.uploaded_imgs.push(response.data.photo_id);
                    this.upload.disabled=true;
                }).catch(error => {

                })

            }
            this.upload.disabled=false;
        },
        changeDate(val) {
            return moment(val).format('YYYY-MM-DD H:m:s');

        },
    },
    components: {
        VSelect: Multiselect,
        'el-checkbox': Checkbox
    },
    mixins: [form],
});