import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';

Vue.component('link-form', {


    props: {
        case: Object,

    },

    data() {
        return {
            title: null,
            link:null,
            active_case:{id:'1',name:'منشور'},
            actives:[{id:'1',name:'منشور'},{id:'0',name:'غير منشور'}],

            redirectPath: `${BASE_URL}/dashboard/link`,
            saveAction: {
                link: `${BASE_URL}/dashboard/link`,
                type: 'post'
            },
        }
    },

    mounted(){
        if(this.case) {
            this.title = this.case.title;
            this.link = this.case.link;
            if(this.case.active==1){
                this.active_case={id:'1',name:'منشور'};
            }else{
                this.active_case={id:'0',name:'غير منشور'};
            }
            jQuery('#main_photo_id').val(this.case.photo_id);

            this.saveAction = {
                link: `${BASE_URL}/dashboard/link/${this.case.id}`,

                type: 'put'
            };
            // console.log(this.saveAction)
        }

    },

    methods: {
        save() {
            let data = {
                title: this.title,
                link: this.link,
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