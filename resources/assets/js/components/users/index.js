import moment from 'moment'
import { TableComponent, TableColumn } from 'vue-table-component';
import form from '../../mixins/form';

Vue.component('users-index', {
    mixins: [form],

    data() {
        return  {
            saveAction: {
                link: '',
                type: ''
            },
            redirectPath: null,
        }
    },

    components: {
        'table-component': TableComponent,
        'table-column': TableColumn,
    },

    methods: {
        async fetchData({ page, filter, sort }) {
            jQuery(".table-component__message").html('<i  id="load_search_news" class="fa fa-spinner fa-spin"></i>')

            const response = await axios.get(`${BASE_URL}/dashboard/users/search`, {params: { page, filter, sort }});
            if(response.data.users.data.length==0){
                jQuery(".table-component__message").html('تعذر وجود بيانات')
            }
            return {
                data: response.data.users.data,
                pagination: {
                    currentPage: response.data.users.current_page,
                    totalPages: response.data.users.last_page
                }
            };
        },


    },
});