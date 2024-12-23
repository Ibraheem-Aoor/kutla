import moment from 'moment'
import { TableComponent, TableColumn } from 'vue-table-component';
import form from '../../mixins/form';

Vue.component('roles-index', {
    mixins: [form],

    data() {
        return  {
            name:null,
            saveAction:{
                link: `${BASE_URL}/dashboard/users/roles`,
                type: 'post'
            },
            redirectPath: null,
        }
    },

    components: {
        'table-component': TableComponent,
        'table-column': TableColumn,
    },

    methods: {
        save() {
            let data = {
                name: this.name,
            }
            this.saveForm(data)

        },
        async fetchData({ page, filter, sort }) {
            jQuery(".table-component__message").html('<i  id="load_search_news" class="fa fa-spinner fa-spin"></i>')
            const response = await axios.get(`${BASE_URL}/dashboard/users/roles/search`, {params: { page, filter, sort }});
            if(response.data.roles.data.length==0){
                jQuery(".table-component__message").html('تعذر وجود بيانات')
            }
            return {
                data: response.data.roles.data,
                pagination: {
                    currentPage: response.data.roles.current_page,
                    totalPages: response.data.roles.last_page
                }
            };
        },

        closeModal(){
            $('#static').modal("hide");
            this.name=null;

        },
        openModalEdit(name){
            $('#static').modal("show");
            this.name=name.name;
            this.saveAction = {
                link: `${BASE_URL}/dashboard/users/roles/`+name.id,
                type: 'put'
            };

        },
        openModalAdd(){
            this.saveAction = {
                link: `${BASE_URL}/dashboard/users/roles`,
                type: 'post'
            };

        },
        deleteRole(id) {
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
                    axios.delete(`${BASE_URL}/dashboard/users/roles/` + id).then(response => {
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