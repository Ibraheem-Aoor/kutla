import form from '../../mixins/form';
Vue.component('v-input-tag', InputTag);
import InputTag from 'vue-input-tag'
Vue.component('alboms-show', {

    props: {
        albom: Object
    },

    components:{
        InputTag
    },
    data() {
        return {
            photo_caption: null,
            tags: [],
            uploaded_img: null,
            image_id: null,
            album_cover:null,
            redirectPath: `${BASE_URL}/dashboard/albums/${this.albom.id}`,
            // saveAction: {
            //     link: '/addPhotoToAlbom',
            //     type: 'post'
            // },
        }
    },

    mounted(){
        if(this.albom) {
            //this.name = this.alboms.name;
          //  this.type = this.alboms.type;
            this.saveAction = {
                link: `${BASE_URL}/dashboard/albums/addPhotoToAlbom/${this.albom.id}`,
                type: 'post'
            };
        }
        jQuery(".cbp-item-wrapper").css('width','220px !important');

    },

    methods: {
        save() {
            let data = {
                albom_id: this.albom.id,
                tags: this.tags,
                image_id:this.image_id,
                photo_caption: this.photo_caption,
                uploaded_img: this.uploaded_img,
                album_cover:this.album_cover,
            }
            this.saveForm(data);
        },

        getFile: function (e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            var result = null;

            reader.onload = (function (theFile) {
                return function (e) {
                    var img = new Image();
                    img.src = e.target.result;
                   // this.imageResize(img);

                    result = reader.result;
                    this.uploaded_img=result;
                }.bind(this);
            }.bind(this))(file);
            reader.readAsDataURL(file);
        },


        editImage(image){
           /// console.log(image)
            this.photo_caption=image.photo_caption;
            this.album_cover=image.album_cover;
            this.tags=image.tag_array;
            this.uploaded_img='/'+image.thump;
            this.image_id=image.id;
            $('#static').modal("show");
        },
        delImage(id){
            swal({
                    title: "هل أنت متأكد من الحذف ؟",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "الغاء الأمر",
                    confirmButtonText: "نعم, قم بالحذف",
                    closeOnConfirm: true
                },
                () => {
                    axios.delete(`${BASE_URL}/dashboard/albums/image/` + id).then(response => {
                        jQuery("#main_photo_"+id).remove();
                    }).catch(response => {

                        this.response = response.response.data
                        if(this.response.message) {
                            swal({
                                title: this.response.message,
                                text: "",
                                type: "error",
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    });
                });
        },
        addCover(id){
            swal({
                    title: "هل أنت متأكد من وضع هذه الصورة غلاف للألبوم ؟",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "الغاء الأمر",
                    confirmButtonText: "نعم",
                    closeOnConfirm: true
                },
                () => {
                    axios.post(`${BASE_URL}/dashboard/albums/image/addcover/` + id).then(response => {
                        swal({
                            title: 'تم التعديل بنجاح',
                            text: "",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }).catch(response => {

                        this.response = response.response.data
                        if(this.response.message) {
                            swal({
                                title: this.response.message,
                                text: "",
                                type: "error",
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    });
                });
        },
        closeModal(){
            $('#static').modal("hide");
            this.photo_caption=null;
            this.tags=[];
            this.uploaded_img='';
            this.image_id=null;
        }


    },

    mixins: [form],
});