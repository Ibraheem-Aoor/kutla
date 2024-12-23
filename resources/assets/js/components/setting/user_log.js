import {TableComponent, TableColumn} from 'vue-table-component';
import Multiselect from 'vue-multiselect';
import moment from 'moment';

Vue.component('user_logs-index', {
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
            logs_count:0,
            event: null,
            events: [{id: 'created', name: 'إضافة'}, {id: 'updated', name: 'تعديل'}, {id: 'deleted', name: 'حذف'}],
            table: null,
            tables: [{id: 'App\\Models\\Post', name: 'مشنورات'},
                {id: 'App\\Models\\Events', name: 'أجندة'},
                {id: 'App\\Models\\Urgent', name: 'أخبار عاجلة'},
                {id: 'App\\Models\\Adv', name: 'إعلانات'},
                {id: 'App\\Models\\Albom', name: 'ألبومات صور'},
                {id: 'App\\Models\\Cases', name: 'ملفات خاصة'},
                {id: 'App\\Models\\LiveVideo', name: 'فيديوهات بث مباشر'},
                {id: 'App\\Models\\Page', name: 'صفحات'},
                {id: 'App\\Models\\Role', name: 'الصلاحيات'},
                {id: 'App\\Models\\Video', name: 'فيديوهات'},
                {id: 'App\\Models\\Vote', name: 'استطلاع رأي'},
                {id: 'App\\Models\\Writer', name: 'كتاب'},
                {id: 'App\\Models\\FileLibrary', name: 'صور'}],
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
            let event = this.event ? this.event.id : '';
            let table = this.table ? this.table.id : '';
            jQuery(".table-component__message").html('<i id="load_search_news" class="fa fa-spinner fa-spin"></i>')
            const response = await axios.get(`${BASE_URL}/dashboard/user_logs/search`, {
                params: {
                    page, filter: {
                        title: this.title,
                        start_date: start_date,
                        end_date: end_date,
                        user_id: user_id,
                        table: table,
                        event: event,

                    }, sort
                }
            });
            if (response.data.posts.data.length == 0) {
                jQuery(".table-component__message").html('تعذر وجود بيانات')
            }
            this.logs_count=response.data.logs_count;
            return {

                data: response.data.posts.data,
                pagination: {
                    currentPage: response.data.posts.current_page,
                    totalPages: response.data.posts.last_page
                }
            };

        },
        getPostType(type) {

            let types = {
                created: 'إضافة',
                updated: 'تعديل',
                deleted: 'حذف'
            };
            return types[type];
        },
        getPostTable(table) {
            let tables = {
                'App\\Models\\Post': 'مشنورات',
                'App\\Models\\Events': 'أجندة',
                'App\\Models\\Urgent': 'أخبار عاجلة',
                'App\\Models\\Adv': 'إعلانات',
                'App\\Models\\Albom': 'ألبومات صور',
                'App\\Models\\Cases': 'ملفات خاصة',
                'App\\Models\\LiveVideo': 'فيديوهات بث مباشر',
                'App\\Models\\Page': 'صفحات',
                'App\\Models\\Role': 'الصلاحيات',
                'App\\Models\\Video': 'فيديوهات',
                'App\\Models\\Vote': 'استطلاع رأي',
                'App\\Models\\Writer': 'كتاب',
                'App\\Models\\FileLibrary': 'صور',
            };

            return tables[table];
        },
        getTitle(title) {
            let event_title = JSON.parse(title)
            if (event_title.title) {
                return event_title.title;
            } else {
                return event_title.name;
            }
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
            this.table = null;
            this.event = null;
            this.value6 = [];
            this.user_id = null;

            this.$refs.table.refresh();
        }
    },

});