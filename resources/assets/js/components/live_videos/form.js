import form from '../../mixins/form';
import VueVideoPlayer from 'vue-video-player';
//import video from 'videojs-youtube';
import Multiselect from 'vue-multiselect';
import 'video.js/dist/video-js.css';
import moment from "moment/moment";
Vue.use(VueVideoPlayer);
Vue.component('live_videos-form', {


    props: {
        video: Object

    },
    components: {
        VueVideoPlayer,
        VSelect: Multiselect

    },

    data() {
        return {
            playerOptions: {
                // videojs options
                muted: false,
                //width: 'full',
                // height: '360',
                aspectRatio: "4:3",
                language: 'en',
                playbackRates: [0.7, 1.0, 1.5, 2.0],
                sources: [{
                    type: "video/mp4",
                    src: "/uploads/videos/19834543_483577855319685_4446274531367059456_n.mp4"
                }],
                height:300,
                //poster: "/static/images/author.jpg",
            },
            videoFile:new FormData(),
            video_type:null,
            name: null,
            youtube_link: null,
            description: null,
            video_path: null,
            upload_status: true,
            is_upload_now:false,
            prgoress_bar:null,
            facebook:null,
            active_post:{id:'1',name:'منشور'},
            duration:0,
            actives:[{id:'1',name:'منشور'},{id:'0',name:'مسودة'}],
            redirectPath: `${BASE_URL}/dashboard/live_videos`,
            saveAction: {
                link: `${BASE_URL}/dashboard/live_videos`,
                type: 'post'
            },
            start_at:this.changeDate(new Date()),

        }
    },

    mounted(){
        //////////////
        if(this.video) {
            this.name = this.video.name;
            this.youtube_link = this.video.youtube_link;
            this.description = this.video.description;
            this.video_path = this.video.file_name;
            this.duration=this.video.duration
            this.start_at=this.video.start_at;
            this.facebook=this.video.facebook;
            if(this.video.active==1){
                this.active_post={id:'1',name:'منشور'};
            }else{
                this.active_post={id:'0',name:'مسودة'};
            }

            this.redirectPath= `${BASE_URL}/dashboard/live_videos/${this.video.id}/edit`,
            jQuery('#main_photo_id').val(this.video.photo_id);

            this.saveAction = {
                link: `${BASE_URL}/dashboard/live_videos/${this.video.id}`,
                type: 'put'
            };
            if(this.video.file_name){
                this.playerOptions.sources=[{
                    type: "video/mp4",
                    src: this.video.file_name
                }];
            }

        }
    },

    methods: {
        save() {
            let data = {
               // video_type:this.video_type,
                name: this.name,
                youtube_link: this.youtube_link,
                description: this.description,
                video_path: this.video_path,
                facebook: this.facebook,
                active:this.active_post?this.active_post.id:'',
                photo_id:jQuery('#main_photo_id').val(),
                start_at:this.start_at?this.changeDate(this.start_at):'',
                duration:this.duration,

            }
            this.saveForm(data);
        },
        getName(yotube){
            let link = yotube.split('v=');
            console.log(link[1])
            return link[1]
        },
        changeDate(val){
            if(val){
                return moment(val).format('YYYY-MM-DD H:m:s');
            }


        },

        uploadVideoFile (e)
        {
            this.upload_status=false;
            jQuery("#progress_br").show();
            jQuery("#father_progress_bar").css('background-color','#f5f5f5');
            this.is_upload_now=true;
            let inputData = e.target.files[0];
            let formData = new FormData();
            formData.append('file', inputData);
            this.uploadImage(formData, this.onProgress).
            then((response) => {
                console.log(response)
                this.upload_status=true;
                this.video_path=response.full_path;
                jQuery("#progress_br").hide();
                jQuery("#father_progress_bar").css('background-color','green');
                //this.is_upload_now=false;
            });
        },
        uploadImage(data, onProgress){
    const url = `${BASE_URL}/dashboard/live_videos/uploadVideoFile`;
    let config = {
        onUploadProgress(progressEvent) {
            let percentCompleted = Math.round((progressEvent.loaded * 100) /
                progressEvent.total);

            this.prgoress_bar=percentCompleted+'%';
            jQuery("#progress_br").css('width',percentCompleted+'%')
            // execute the callback
        },

    };
    return axios.post(url, data, config).
    then(x => x.data).
    catch(error => error);
},
        onProgress(percent){
        },

        deleteVideoFile(id) {
            swal({
                    title: "هل أنت متأكد من ازالة الفيديو ؟",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "الغاء الأمر",
                    confirmButtonText: "نعم, قم بالازالة",
                    closeOnConfirm: true
                },
                () => {
                    axios.delete(`${BASE_URL}/dashboard/live_videos/` + id+'/deleteVideo').then(response => {
                        jQuery("#video_file").remove();
                        jQuery('#video_file').html('');
                        this.video_path=null;
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

    },



    mixins: [form],
});