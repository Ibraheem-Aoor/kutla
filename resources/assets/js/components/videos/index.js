import { TableComponent, TableColumn } from 'vue-table-component';
import Multiselect from 'vue-multiselect';
import VueVideoPlayer from 'vue-video-player';
//import video from 'videojs-youtube';
import 'video.js/dist/video-js.css';
import moment from "moment/moment";
Vue.use(VueVideoPlayer);
//Vue.use(video);

Vue.component('videos-index', {
    props: {
        categories: Array,
        cases: Object
    },
    data() {
        return  {
            video_select:null,
            pickerOptions2: {
                shortcuts: [{
                    text: 'Last week',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: 'Last month',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: 'Last 3 months',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
                        picker.$emit('pick', [start, end]);
                    }
                }]
            },
            value6: [],
            value7: '',
            category_id: null,
            title:null,
            playerOptions: {
                // videojs options
                muted: false,
                video_html:null,
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
            ////////
            modalData: {
                category: null,

            },

            redirectPath: null,
        }
    },

    components: {
        'table-component': TableComponent,
        'table-column': TableColumn,
        VSelect: Multiselect,
        VueVideoPlayer,
      //  video
    },

    methods: {
        async fetchData({ page, filter, sort }) {
            let start_date = this.value6?this.changeDate(this.value6[0]):'';
            let end_date=this.value6?this.changeDate(this.value6[1]):'';
            let category_id=this.category_id?this.category_id.id:'';
            let title=this.title;
            let case_id=null
            if(this.cases){
                case_id = this.cases.id;
            }
            jQuery(".table-component__message").html('<i  id="load_search_news" class="fa fa-spinner fa-spin"></i>')
            const response = await axios.get(`${BASE_URL}/dashboard/videos/search?cases=`+case_id, {params: { page, filter:{
                        title:title,
                        start_date:start_date,
                        end_date:end_date,
                        category_id:category_id
                    }, sort }});
            if(response.data.types.data.length==0){
                jQuery(".table-component__message").html('تعذر وجود بيانات')
            }
            return {
                data: response.data.types.data,
                pagination: {
                    currentPage: response.data.types.current_page,
                    totalPages: response.data.types.last_page
                }
            };
        },
        deleteCategory(id) {
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
                    axios.delete(`${BASE_URL}/dashboard/videos/` + id).then(response => {
                        this.$refs.table.mapDataToRows();
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
        changeDate(val){
            if(val){
                return moment(val).format('YYYY-MM-DD');
            }

        },
        openVideo(video){
          let video_source=`${BASE_URL}`+video.file_name;
            this.video_select=video;
jQuery("#tab_1_3").html('<video width="800" height="400" controls><source src="'+video_source+'" type="video/mp4"></video>');

            $('#static').modal("show");
        },
        returnClassY(video){
            if(video){
                if(video.file_name && video.youtube_link){
                    return 'active'
                }else{
                    if( video.youtube_link){
                        return 'active'
                    }
                }

            }

            return '';
        },
        returnClassF(video){
            if(video) {
                if (video.file_name && !video.youtube_link) {
                    return 'active'
                }
            }
            return '';
        },
        getName(yotube){
            let link = yotube.split('v=');
            return link[1]

        },
        closeVideo(){
            $('#static').modal("hide");
            jQuery("#tab_1_3").html('');


        },
        searchResult(){
            this.fetchData(1,[],[]);
            this.$refs.table.refresh();
        },
        cancelSearch(){
            this.title=null;
            this.value6=[];
            this.category_id=null;
            this.$refs.table.refresh();
        }

    },
});