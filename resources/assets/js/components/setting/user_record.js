import {TableComponent, TableColumn} from 'vue-table-component';
import Multiselect from 'vue-multiselect';
import moment from 'moment';

Vue.component('user_record-index', {
    props: {
        users: Array,

    },
    data() {
        return {
            modalData: {},
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
            user_id: null,
            redirectPath: null,
        }
    },
    components: {
        'table-component': TableComponent,
        'table-column': TableColumn,
        VSelect: Multiselect
    },
    methods: {
        async fetchData({page, filter, sort}) {
            let start_date = this.value6 ? this.changeDate(this.value6[0]) : '';
            let end_date = this.value6 ? this.changeDate(this.value6[1]) : '';
            let user_id = this.user_id ? this.user_id.id : '';
            jQuery(".table-component__message").html('<i id="load_search_news" class="fa fa-spinner fa-spin"></i>')
            const response = await axios.get(`${BASE_URL}/dashboard/user_record/search`, {
                params: {
                    page, filter: {
                        start_date: start_date,
                        end_date: end_date,
                        user_id: user_id,


                    }, sort
                }
            });
            if (response.data.posts.data.length == 0) {
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

            this.value6 = [];
            this.user_id = null;

            this.$refs.table.refresh();
        }
    },

});