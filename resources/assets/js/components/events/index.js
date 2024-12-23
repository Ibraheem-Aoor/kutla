import { TableComponent, TableColumn } from 'vue-table-component';
Vue.component('events-index', {
    data() {
        return  {
            modalData: {
                events: null,

            },
            remember:null,
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
            jQuery(".table-component__message").html('<i id="load_search_news" class="fa fa-spinner fa-spin"></i>')
            const response = await axios.get(`${BASE_URL}/dashboard/events/search`, {params: { page, filter, sort }});
            if(response.data.events.data.length==0){
                jQuery(".table-component__message").html('تعذر وجود بيانات')
            }
            return {
                data: response.data.events.data,
                pagination: {
                    currentPage: response.data.events.current_page,
                    totalPages: response.data.events.last_page
                }
            };
        },
        showDetails(event) {
            this.remember=event
        },
        deleteEvent(id) {
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
                    axios.delete(`${BASE_URL}/dashboard/events/` + id).then(response => {
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