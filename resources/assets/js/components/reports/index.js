import { TableComponent, TableColumn } from 'vue-table-component';
import moment from "moment/moment";
Vue.component('reports-index', {
    data() {
        return  {
            modalData: {
                report: null,

            },
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
            type: null,

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
        async fetchData({page, filter, sort}) {
            let start_date = this.value6 ? this.changeDate(this.value6[0]) : '';
            let end_date = this.value6 ? this.changeDate(this.value6[1]) : '';
            let user_id = this.user_id ? this.user_id.id : '';
            let type = this.type ? this.type : '';
            jQuery(".table-component__message").html('<i id="load_search_news" class="fa fa-spinner fa-spin"></i>')
            const response = await axios.get(`${BASE_URL}/dashboard/reports/search`, {
                params: {
                    page, filter: {
                        start_date: start_date,
                        end_date: end_date,
                        type: type

                    }, sort
                }
            });
            if (response.data.reports.data.length == 0) {
                jQuery(".table-component__message").html('تعذر وجود بيانات')
            }
            return {

                data: response.data.reports.data,
                pagination: {
                    currentPage: response.data.reports.current_page,
                    totalPages: response.data.reports.last_page
                }
            };

        },
        deleteReport(id) {
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
                    axios.delete(`${BASE_URL}/dashboard/reports/` + id).then(response => {
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
        changeDate(val) {
            if (val) {
                return moment(val).format('YYYY-MM-DD');
            }

        },
        searchResult() {
            this.fetchData(1, [], []);
            this.$refs.table.refresh();
        },
        cancelSearch() {
            this.type = null;
            this.value6 = [];
            this.$refs.table.refresh();
        }

    },
});