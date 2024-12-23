import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';
import { TableComponent, TableColumn } from 'vue-table-component';


Vue.component('mail_list-send', {


    props: {


    },

    data() {
        return {
            title: null,
            posts_chose:[],

            redirectPath: `${BASE_URL}/dashboard/mail_list/mail_sent`,
            saveAction: {
                link: `${BASE_URL}/dashboard/mail_list/send`,
                type: 'post'
            },
        }
    },

    mounted(){

    },

    methods: {
        chose_post(post){
            if(!this.posts_chose.includes(post)){
                this.posts_chose.push(post)
            }

        },
        async fetchData({ page, filter, sort }) {
            jQuery(".table-component__message").html('<i id="load_search_news" class="fa fa-spinner fa-spin"></i>')

            const response = await axios.get(`${BASE_URL}/dashboard/mail_list/search_posts`, {params: { page, filter, sort }});
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
        deletePost(item) {
            this.posts_chose.splice(this.posts_chose.indexOf(item), 1);
        },
        save() {
            let data = {
                title: this.title,
                posts_chose: this.posts_chose,
            }
            this.saveForm(data);
        },

    },
    components: {
        VSelect: Multiselect,
        'table-component': TableComponent,
        'table-column': TableColumn,
    },

    mixins: [form],
});