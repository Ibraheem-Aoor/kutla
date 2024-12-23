import { TableComponent, TableColumn } from 'vue-table-component';
Vue.component('hotels-index', {
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

            const response = await axios.get(`${BASE_URL}/dashboard/hotels/search`, {params: { page, filter, sort }});
            if(response.data.hotels.data.length==0){
                jQuery(".table-component__message").html('تعذر وجود بيانات')
            }
            return {
                data: response.data.hotels.data,
                pagination: {
                    currentPage: response.data.hotels.current_page,
                    totalPages: response.data.hotels.last_page
                }
            };
        },
        deleteHotel(id) {
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
                    axios.delete(`${BASE_URL}/dashboard/hotels/` + id).then(response => {
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

    },
});