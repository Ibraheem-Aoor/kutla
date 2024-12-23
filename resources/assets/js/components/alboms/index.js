import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';
import {TableColumn, TableComponent} from "vue-table-component";
import VueVideoPlayer from "vue-video-player";
import moment from "moment/moment";
import eventHub from '../../events.js'

Vue.component('alboms-index', {


    props: {
        categories: Array,

            for: {
                type: String,
                default: 'default'
            },
        cases: Object
    },

    data() {
        return {
			  pagesLeft: [],
                pagesMiddle: [],
                pagesRight: [],
              pagination:[],
                next: '&raquo;',
                last: '&raquo;&raquo;',
                previous: '&laquo;',
                first: '&laquo;&laquo;',
            name: null,
            type: null,
            meta:null,
            alboms_arr:[],
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
            title:null,
            redirectPath: `${BASE_URL}/dashboard/albums`,
            saveAction: {
                link: `${BASE_URL}/dashboard/albums`,
                type: 'post'
            },
        }
    },

    mounted(){
		   this.pages(this.pagination.current_page);
		    this.getAlbumos(1);
            eventHub.$on('permits.switched-page', this.getAlbumos)
        

    },
    components: {
        VSelect: Multiselect
    },
    methods: {
        save() {
            let data = {
                name: this.name,
                type: this.type,
            }
            this.saveForm(data);
        },
        getCover(image) {
            if(image.photoscover){
                console.log(image.photoscover.thump)
                return image.photoscover.thump
            }else{
                return image.cover
            }

        },
        delAlbom(id) {
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
                    axios.delete(`${BASE_URL}/dashboard/albums/` + id).then(response => {
                        location.reload();
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
        searchResult(){
            let start_date = this.value6?this.changeDate(this.value6[0]):'';
            let end_date=this.value6?this.changeDate(this.value6[1]):'';
            let category_id=this.category_id?this.category_id.id:'';
            let title=this.title
            let case_id=null
            if(this.cases){
                case_id = this.cases.id;
            }
            axios.get(`${BASE_URL}/dashboard/albums/search?cases=`+case_id, {params: {  filter:{
                        title:title,
                        start_date:start_date,
                        end_date:end_date,
                        category_id:category_id
                    } }}).then(response => {
                this.alboms_arr =response.data.data.albums;
                this.meta =response.data.data.meta;
                this.pagination =response.data.data.meta;
            });

        },
        cancelSearch(){
            this.title=null;
            this.value6=[];
            this.category_id=null;
            let start_date = this.value6?this.changeDate(this.value6[0]):'';
            let end_date=this.value6?this.changeDate(this.value6[1]):'';
            let category_id=this.category_id?this.category_id.id:'';
            let title=this.title;
            axios.get(`${BASE_URL}/dashboard/albums/search`, {params: {  filter:{
                        title:title,
                        start_date:start_date,
                        end_date:end_date,
                        category_id:category_id
                    } }}).then(response => {
                this.alboms_arr =response.data.data.albums;
                this.meta =response.data.data.meta;
                this.pagination =response.data.data.meta;
            });
        },
        changeDate(val){
            if(val){
                return moment(val).format('YYYY-MM-DD');
            }

        },
		  switchPage (page) {
                if (page < 1 || page > this.pagination.last_page || page == this.pagination.current_page) {
                    return
                }

                eventHub.$emit(this.for + '.switched-page', page)
                this.pages(page);
            },
            pages(page){
                if(this.pagination.last_page + 1 <= 10) {
                    this.pagesLeft = _.range(1, this.pagination.last_page + 1);
                    this.pagesRight = [];
                    this.pagesMiddle = null;
                }
                else if(page <= 6){
                    this.pagesLeft = _.range(1, 8);
                    this.pagesRight = _.range(this.pagination.last_page - 2, this.pagination.last_page + 1);
                    this.pagesMiddle = null;
                }
                else if( (page > (this.pagination.last_page - 4)) || (page  == this.pagination.last_page + 1) ){
                    this.pagesLeft = _.range(1, 3);
                    this.pagesMiddle = null;
                    this.pagesRight = _.range(this.pagination.last_page - 4, this.pagination.last_page + 1);
                }
                else {
                    this.pagesLeft = _.range(1, 3);
                    this.pagesMiddle = _.range(page - 2, page + 3);
                    this.pagesRight = _.range(this.pagination.last_page - 1, this.pagination.last_page + 1);
                }
            },
   getAlbumos(page) {
                this.currentPage = page;
       this.currentPage = page;
       this.title=null;
       this.value6=[];
       this.category_id=null;
       let start_date = this.value6?this.changeDate(this.value6[0]):'';
       let end_date=this.value6?this.changeDate(this.value6[1]):'';
       let category_id=this.category_id?this.category_id.id:'';
       let title=this.title;
       axios.get(`${BASE_URL}/dashboard/albums/search`,{params: {  filter:{
                   title:title,
                   start_date:start_date,
                   end_date:end_date,
                   page:page,
                   category_id:category_id
               } }}).then(response => {
           this.alboms_arr =response.data.data.albums;
           this.meta =response.data.data.meta;
           this.pagination =response.data.data.meta;
           document.getElementById('loading-div').style.display = 'none';
       }).catch(response => {
           document.getElementById('loading-div').style.display = 'none';
       });



            },
   },


    mixins: [form],
});