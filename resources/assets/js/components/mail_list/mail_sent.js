import { TableComponent, TableColumn } from 'vue-table-component';
Vue.component('mail_list-sent', {
    data() {
        return  {
            modalData: {
                mail_list: null,


            },
            post_array:[],
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

            const response = await axios.get(`${BASE_URL}/dashboard/mail_list/search_mail_sent`, {params: { page, filter, sort }});
            if(response.data.mail_list.data.length==0){
                jQuery(".table-component__message").html('تعذر وجود بيانات')
            }
            return {
                data: response.data.mail_list.data,
                pagination: {
                    currentPage: response.data.mail_list.current_page,
                    totalPages: response.data.mail_list.last_page
                }
            };
        },
        showPost(post) {
            this.post_array=post.post_sent
        },
        getUrl(post){
            return `${BASE_URL}/post/`+post.post_id+'/title';
        }

    },
});