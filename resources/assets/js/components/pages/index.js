import { TableComponent, TableColumn } from 'vue-table-component';
Vue.component('pages-index', {
    data() {
        return  {
            modalData: {
                writer: null,

            },

            redirectPath: null,
        }
    },
    props: {

      
    },
    components: {
        'table-component': TableComponent,
        'table-column': TableColumn,
    },

    methods: {
        async fetchData({ page, filter, sort }) {
            jQuery(".table-component__message").html('<i id="load_search_news" class="fa fa-spinner fa-spin"></i>')
                const response = await axios.get(`${BASE_URL}/dashboard/pages/search`, {params: { page, filter, sort }});
            if(response.data.pages.data.length==0){
                jQuery(".table-component__message").html('تعذر وجود بيانات')
            }
                return {
                    data: response.data.pages.data,
                    pagination: {
                        currentPage: response.data.pages.current_page,
                        totalPages: response.data.pages.last_page
                    }
                };
        },
        deletePage(id) {
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
                    axios.delete(`${BASE_URL}/dashboard/pages/` + id).then(response => {
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
        getPostActive(type) {
          if(type=='1'){
              return 'منشور';
          }else{
              return 'مسودة';
          }
        },
    },
});