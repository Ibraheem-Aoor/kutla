import { TableComponent, TableColumn } from 'vue-table-component';
Vue.component('votes-index', {
    data() {
        return  {
            modalData: {
                vote: null,
            },
            vote_details:null,
            redirectPath: null,
            answers:[]
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

            const response = await axios.get(`${BASE_URL}/dashboard/votes/search`, {params: { page, filter, sort }});
            if(response.data.votes.data.length==0){
                jQuery(".table-component__message").html('تعذر وجود بيانات')
            }
            return {
                data: response.data.votes.data,
                pagination: {
                    currentPage: response.data.votes.current_page,
                    totalPages: response.data.votes.last_page
                }
            };
        },
        deleteVote(id) {
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
                    axios.delete(`${BASE_URL}/dashboard/votes/` + id).then(response => {
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