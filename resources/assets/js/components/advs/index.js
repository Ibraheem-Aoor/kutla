import { TableComponent, TableColumn } from 'vue-table-component';
Vue.component('advs-index', {
    data() {
        return  {
            modalData: {
                urgent: null,

            },
            loading: true,

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
            jQuery(".table-component__message").html('<i  id="load_search_news" class="fa fa-spinner fa-spin"></i>')
            const response = await axios.get(`${BASE_URL}/dashboard/advs/search`, {params: { page, filter, sort }});
            this.loading = false;
            if(response.data.advs.data.length==0){
                jQuery(".table-component__message").html('تعذر وجود بيانات')
            }
            return {
                data: response.data.advs.data,
                pagination: {
                    currentPage: response.data.advs.current_page,
                    totalPages: response.data.advs.last_page
                }
            };
        },
        getPosition(pos){
            let array_position=[];

            if(pos.page=='main'){
                 array_position= { 1: 'الهيدر',
                      2: 'اعلان جانبي',
                      3: 'اعلان قسم 1',
                      4: 'اعلان قسم 2',
                     5: 'اعلان قسم 3',
                     6: 'اعلان قسم 4',
                     7: 'اعلان قسم 5',
                    8: 'اعلان قسم 6',
                     9: 'اعلان قسم 7',
                     10: 'اعلان قسم 8',
                     11: 'اعلان قسم 9',
                    12: 'اعلان قسم 10',
                     13: 'اعلان قسم 12',
                     14: 'اعلان أسفل القائمة الرئيسية'
                 }
            }else{
                if(pos.page=='details'){

                    array_position= { 1: 'اعلان جانبي 1',
                        2: 'اعلان جانبي 2',
                        3: 'اعلان جانبي 3',
                        4: 'أسفل عنوان الخبر',
                        5: 'داخل تفاصيل الخبر',
                       6: 'تحت تفاصيل الخبر',
                        7: 'بجانب تفاصيل الخبر',
                        8: 'اعلان تفاعلي'}
                }else{
                    array_position= { 1: 'اعلان جانبي 1',
                        2: 'اعلان جانبي 2',
                        3: 'اعلان جانبي 3',
                        4: 'بجانب الفنادق'}
                }
            }
            return array_position[pos.position];
        },
        getLocation(pos){
            let array_position=[];

                    array_position= { ps: 'فلسطين واسرائيل',
                        other: 'باقي الدول',
                        all: 'كل العالم'}


            return array_position[pos];
        },
        getPage(pos){

            let types = {
                main: 'الرئيسية',
                details: 'تفاصيل الخبر',
                hotels: 'الفنادق'
            };
            return types[pos];
        },
        deleteAdv(id) {
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
                    axios.delete(`${BASE_URL}/dashboard/advs/` + id).then(response => {
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