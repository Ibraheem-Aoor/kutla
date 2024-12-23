import { TableComponent, TableColumn } from 'vue-table-component';
import VueVideoPlayer from 'vue-video-player';
//import video from 'videojs-youtube';
import 'video.js/dist/video-js.css';
Vue.use(VueVideoPlayer);
//Vue.use(video);

Vue.component('live_videos-index', {
    data() {
        return  {
            video_select:null,
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
    props: {
       // client: Object,
      
    },
    components: {
        'table-component': TableComponent,
        'table-column': TableColumn,
        VueVideoPlayer,
      //  video
    },

    methods: {
        async fetchData({ page, filter, sort }) {
            jQuery(".table-component__message").html('<i id="load_search_news" class="fa fa-spinner fa-spin"></i>')
            const response = await axios.get(`${BASE_URL}/dashboard/live_videos/search`, {params: { page, filter, sort }});
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
                    axios.delete(`${BASE_URL}/dashboard/live_videos/` + id).then(response => {
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
                    }else{
                        if( video.facebook){
                            return 'active'
                        }
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
        returnClassFace(video){
            if(video) {
                if (video.facebook && !video.file_name && !video.youtube_link) {
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
            jQuery("#tab_1_4").html('');


        },
        getFacebook(face_url){
          if(face_url){
              if(face_url.facebook){
                  /*************************************/
                  let url = face_url.facebook;

                  let video_title="";
                  let tmp =url.split('/');
                  let video_id=0;
                  //dd($tmp);
                  if(tmp.length >=3){
                      if (tmp[tmp.length - 3].toLowerCase()== 'videos') {
                          video_id = tmp[tmp.length - 2];
                      }
                  }else if(tmp.length >=2)
                  {
                      if(tmp[tmp.length - 2].toLowerCase()== 'videos')
                      {
                          video_id = tmp[tmp.length - 1];
                      }
                  }
                  else {
                      video_id = 0;
                  }
                  if(video_id != 0) {

                      console.log(app_token);
                      let facebook_frame="";
                      $.getJSON('https://graph.facebook.com/v2.8/'+video_id+'?fields=description,format,content_category,length&access_token='+app_token+'&format=json&callback=?',function(data){
                          video_title= JSON.stringify(data['description']);
                           facebook_frame='<div class="article-video-box">'+
                              '<div class="embed-responsive embed-responsive-16by9">'+
                              '<iframe src="https://www.facebook.com/plugins/video.php?href='+url+'&width=560&show_text=false&appId='+face_app+'&height=315"'+
                              'width="560" height="315" style="border:none;overflow:hidden" scrolling="no" frameborder="0" '+
                              'allowTransparency="true" allowfullscreen="true"  autoplay="false" show-text="false" show-captions="false"></iframe>'+
                              '</div>'+
                              '<p>'+video_title+'</p>'+
                              '</div><br/>';
                           jQuery("#tab_1_4").html(facebook_frame)

                      });

                  }

                  /*************************************/
              }
          }


        }

    },
});