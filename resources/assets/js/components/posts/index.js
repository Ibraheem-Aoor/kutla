import {TableComponent, TableColumn} from 'vue-table-component';
import Multiselect from 'vue-multiselect';
import moment from 'moment';

Vue.component('posts-index', {
    props: {
        categories: Array,
        view_types: Array,
        posts: Array,
        tag: Object,
        post_more: Object,
        users: Array,
        cases: Object
    },
    data() {
        return {
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
            category_id: null,
            active_post: null,
            actives: [{id: '1', name: 'منشور'}, {id: '0', name: 'مسودة'}],
            view_type_id: 1,
            title: null,
            last_id: null,
            all_posts: this.posts,
            redirectPath: null,
            load_more: true,
            load_news: false,
            logarea: document.getElementById("logarea"),
            user: null,
            has_more: this.post_more ? true : false,
            result_count: '',
            count_like: null,
            count_haha: null,
            count_wow: null,
            count_sad: null,
            count_angry: null,
            show_post: null,
            loading: false,
            c_type:null,
            c_types:[
                {id:'slider_1',name:'في السلايدر'}
                ,{id:'report_1',name:'تقرير'},
                {id:'news',name:'أخبار'},
                {id:'statment_1',name:'بيان'},
                {id:'private',name:'ملف خاص'},
                {id:'remember',name:'تذكاري'}
                ]
        }
    },
    components: {
        'table-component': TableComponent,
        'table-column': TableColumn,
        VSelect: Multiselect
    },
    mounted() {
        jQuery('#table1').rowSorter({
            onDragStart: function(tbody, row, index)
            {
                //log('index: ' + index);
                console.log('onDragStart: active row\'s index is ' + index);
            },
            onDrop: function(tbody, row, new_index, old_index)
            {
                //log('old_index: ' + old_index + ', new_index: ' + new_index);
                let posts = this.all_posts;
                let big_index='';
                let small_index='';
               let base_order='';
                if(old_index>new_index){
                     big_index=old_index;
                     small_index=new_index;
                     base_order=this.all_posts[new_index].order
                }else{
                     big_index=new_index;
                     small_index=old_index;
                    base_order=this.all_posts[old_index].order
                }

                       let new_array_orders = [] ;
                        let y=0;
                        jQuery( ".counter_order" ).each(function( index,all_posts ) {
                            if(index<=big_index) {
                                let post_iid = jQuery(this).val();
                                // console.log( index + ": " +jQuery(this).val() );
                                let post = _.findIndex(posts, p => {
                                    if(p.post_id){

                                        return p.post_id == post_iid;
                                    }else{
                                        return p.id == post_iid;
                                    }

                                })

                                let new_x_order='';
                                if (index == 0) {
                                    posts[post].order = base_order
                                    new_x_order=base_order;
                                } else {
                                    posts[post].order = base_order - y
                                    new_x_order= base_order - y;
                                }
                                let new_aa = {id: post_iid, order: new_x_order}
                                new_array_orders.push(new_aa)
                                y++;
                            }
                        });
                        console.log(new_array_orders)
                        this.all_posts=posts;
                        let data={
                            new_array_orders:new_array_orders
                        }
                axios({
                    method: 'post',
                    url: `${BASE_URL}/dashboard/posts/new_orders`,
                    data: data
                }).then(response => {

                })


            }.bind(this)
        });
    },
    methods: {
        log(text) {
            this.logarea.innerHTML = text;
        },
        destroyRowSorter() {
            sorter.destroy();
        },
        loadMore() {
            this.load_news = true;
            let start_date = this.value6 ? this.changeDate(this.value6[0]) : '';
            let end_date = this.value6 ? this.changeDate(this.value6[1]) : '';
            let category_id = this.category_id ? this.category_id.id : '';
            let view_type_id = this.view_type_id ? this.view_type_id.id : '';
            let active_post = this.active_post ? this.active_post.id : '';
            let tage_name = this.tag ? this.tag.name : '';
            let cases = this.cases ? this.cases.id : '';
            let user = this.user ? this.user.id : '';
            let type = this.c_type ? this.c_type.id : '';
            let last_id = this.last_id;


            axios.get(`${BASE_URL}/dashboard/posts/search`, {
                params: {
                    filter: {
                        title: this.title,
                        tag: tage_name,
                        start_date: start_date,
                        end_date: end_date,
                        category_id: category_id,
                        view_type_id: view_type_id,
                        last_id: this.last_id,
                        active_post: active_post,
                        tage_name: tage_name,
                        cases: cases,
                        user: user,
                        type:type
                    }
                }
            }).then(response => {
                this.load_news = false;
                this.all_posts = this.all_posts.concat(response.data.posts);
                if (response.data.post_more == 0) {
                    this.has_more = false
                }
                else {
                    this.has_more = true
                }

            })

        },
        deletePost(id, index) {
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
                    axios.delete(`${BASE_URL}/dashboard/posts/` + id).then(response => {
                        this.all_posts.splice(index, 1);
                    }).catch(response => {
                        this.response = response.response.data
                        if (this.response.message) {
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
        getPostType(type) {
            let types = {
                transported: 'خبر منقول',
                special_report: 'تقرير خاص',
                special_news: 'خبر خاص',
                synthesis_report: 'تقرير منقول',
                special_interview: 'مقابلة خاصة'
            };
            return types[type];
        },
        getPostActive(type) {
            if (type == '1') {
                return 'منشور';
            } else {
                return 'مسودة';
            }
        },
        changeDate(val) {
            if (val) {
                return moment(val).format('YYYY-MM-DD');
            }

        },
        searchResult() {
            let start_date = this.value6 ? this.changeDate(this.value6[0]) : '';
            let end_date = this.value6 ? this.changeDate(this.value6[1]) : '';
            let category_id = this.category_id ? this.category_id.id : '';
            let view_type_id = this.view_type_id ? this.view_type_id.id : '';
            let active_post = this.active_post ? this.active_post.id : '';
            let tage_name = this.tag ? this.tag.name : '';
            let cases = this.cases ? this.cases.id : '';
            let last_id = '';
            let user = this.user ? this.user.id : '';
            let type=this.c_type?this.c_type.id:'';
            axios.get(`${BASE_URL}/dashboard/posts/search`, {
                params: {
                    filter: {
                        title: this.title,
                        tag: tage_name,
                        start_date: start_date,
                        end_date: end_date,
                        category_id: category_id,
                        view_type_id: view_type_id,
                        last_id: last_id,
                        active_post: active_post,
                        tage_name: tage_name,
                        cases: cases,
                        user: user,
                        type:type
                    }
                }
            }).then(response => {
                this.load_news = false;
                this.all_posts = response.data.posts;
                this.result_count = response.data.result_count;
                if (response.data.post_more == 0) {
                    this.has_more = false
                } else {
                    this.has_more = true
                }

            })
        },
        cancelSearch() {
            this.last_id = '';
            this.title = null;
            this.value6 = [];
            this.category_id = null;
            this.view_type_id = null;
            this.active_post = null;
            this.result_count = '';
            this.all_posts = this.posts;
            this.c_type=null;
            if (this.post_more > 0) {
                this.has_more = true
            }
        },
        getUrl(post) {
            if (post.title) {
                let title = post.title;
                return title.split(' ').join('_');
            }

        },
        publishPost(id, index) {
            swal({
                    title: "هل أنت متأكد من نشر هذا الخبر ؟",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "الغاء الأمر",
                    confirmButtonText: "نعم, قم بالنشر",
                    closeOnConfirm: true
                },
                () => {
                    axios.post(`${BASE_URL}/dashboard/posts/publish_post/` + id).then(response => {
                        this.all_posts[index].active = 1;
                    }).catch(response => {

                        if (this.response.message) {
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
        UnPublishPost(id, index) {
            swal({
                    title: "هل أنت متأكد من الغاء نشر هذا الخبر ؟",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "الغاء الأمر",
                    confirmButtonText: "نعم, قم باالالغاء",
                    closeOnConfirm: true
                },
                () => {
                    axios.post(`${BASE_URL}/dashboard/posts/unpublish_post/` + id).then(response => {
                        console.log(response.data.post)
                        this.all_posts[index].active = 0;
                    }).catch(response => {
                        this.response = response.response.data
                        if (this.response.message) {
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

        returnID(post){
            if(post.post_id){
                this.last_id = post.post_id
                return post.post_id
            }else{
                this.last_id = post.id
                return post.id
            }
        },
        getReaction(post) {
            let post_id=this.returnID(post)
            this.show_post= post
            axios.get(`${BASE_URL}/dashboard/posts/get_reaction/` + post_id).then(response => {
                   this.count_like=response.data.count_like;
                    this.count_haha=response.data.count_haha;
                    this.count_wow=response.data.count_wow;
                    this.count_sad=response.data.count_sad;
                    this.count_angry=response.data.count_angry;

            })
        },
    },


});