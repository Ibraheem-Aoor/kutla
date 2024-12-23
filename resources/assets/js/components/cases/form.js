import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';

Vue.component('case-form', {


    props: {
        case: Object,

    },

    data() {
        return {
            name: null,
            details:null,
            active_case:{id:'1',name:'منشور'},
            actives:[{id:'1',name:'منشور'},{id:'0',name:'غير منشور'}],

            redirectPath: `${BASE_URL}/dashboard/cases`,
            saveAction: {
                link: `${BASE_URL}/dashboard/cases`,
                type: 'post'
            },
        }
    },

    mounted(){
        if(this.case) {
            this.name = this.case.name;
            this.details = this.case.details;
            if(this.case.active==1){
                this.active_case={id:'1',name:'منشور'};
            }else{
                this.active_case={id:'0',name:'غير منشور'};
            }
            jQuery('#main_photo_id').val(this.case.photo_id);

                this.saveAction = {
                link: `${BASE_URL}/dashboard/cases/${this.case.id}`,

                    type: 'put'
            };
           // console.log(this.saveAction)
        }

    },

    methods: {
        save() {
            let data = {
                name: this.name,
                category_id: this.category_id?this.category_id.id:'',
                details:this.details,
                active:this.active_case?this.active_case.id:'',
                photo_id:jQuery('#main_photo_id').val(),
            }
            this.saveForm(data);
        },


    },
    components: {
        VSelect: Multiselect
    },

    mixins: [form],
});