import { TableComponent, TableColumn } from 'vue-table-component';
Vue.component('posts-position', {
    data() {
        return  {
            modalData: {
                writer: null,

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
    },

    methods: {
        async fetchData({ page, filter, sort }) {
            jQuery(".table-component__message").html('<i  id="load_search_news" class="fa fa-spinner fa-spin"></i>')
            const response = await axios.get(`${BASE_URL}/dashboard/posts/search_postion`, {params: { page, filter, sort }});
            if(response.data.posts.data.length==0){
                jQuery(".table-component__message").html('تعذر وجود بيانات')
            }
            return {
                data: response.data.posts.data,
                pagination: {
                    currentPage: response.data.posts.current_page,
                    totalPages: response.data.posts.last_page
                }
            };
        },
        deletePost(id) {
            swal({
                    title: "هل انت متأكد من ازالة الخبر من موضع التثبيت ؟",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "الغاء الأمر",
                    confirmButtonText: "نعم, قم بالحذف",
                    closeOnConfirm: true
                },
                () => {
                    axios.delete(`${BASE_URL}/dashboard/posts/`+id+'/delete_position').then(response => {
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
        getPostType(type) {
            let types = {
                transported: 'منقول',
                special_report: 'تقرير خاص',
                synthesis_report: 'تجميع تقرير',
                special_interview: 'مقابلة خاصة'
            };
            return types[type];
        },
        getPostActive(type) {
          if(type=='1'){
              return 'منشور';
          }else{
              return 'مسودة';
          }
        },
    },
});