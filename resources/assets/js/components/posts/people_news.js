import { TableComponent, TableColumn } from 'vue-table-component';
Vue.component('posts-people', {
    data() {
        return  {
            modalData: {
                writer: null,
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
            user:null,
            title:null,
            post:null,
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
            let start_date = this.value6?this.changeDate(this.value6[0]):'';
            let end_date=this.value6?this.changeDate(this.value6[1]):'';
            let title = this.title;
            let user = this.user;
            jQuery(".table-component__message").html('<i  id="load_search_news" class="fa fa-spinner fa-spin"></i>')

            const response = await axios.get(`${BASE_URL}/dashboard/posts/search_people_news`, {params: { page,  filter:{
                        title:title,
                        user:user,
                        start_date:start_date,
                        end_date:end_date
                    }, sort }});
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
        DetailsPost(post) {
          this.post=post

            if(this.post.is_read==0){
                axios.get(`${BASE_URL}/dashboard/contactus/is_read/` + this.post.id).then(response => {
                    this.$refs.table.mapDataToRows();
                });

            }


        },
        changeDate(val){
            if(val){
                return moment(val).format('YYYY-MM-DD');
            }

        },
        searchResult(){
            this.fetchData(1,[],[]);
            this.$refs.table.refresh();
        },
        cancelSearch(){
            this.title=null;
            this.value6=[];
            this.user=null;
            this.$refs.table.refresh();
        }
    },
});