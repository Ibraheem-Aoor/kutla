import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';

Vue.component('relase-form', {


    props: {
        case: Object,

    },

    data() {
        return {
            title: null,
            description:null,
            link:null,
            active_case:{id:'1',name:'منشور'},
            actives:[{id:'1',name:'منشور'},{id:'0',name:'غير منشور'}],

            redirectPath: `${BASE_URL}/dashboard/releas`,
            saveAction: {
                link: `${BASE_URL}/dashboard/releas`,
                type: 'post'
            },
        }
    },

    mounted(){
        if(this.case) {
            this.title = this.case.title;
            this.description = this.case.description;
            this.link = this.case.link;
            if(this.case.active==1){
                this.active_case={id:'1',name:'منشور'};
            }else{
                this.active_case={id:'0',name:'غير منشور'};
            }
            jQuery('#main_photo_id').val(this.case.photo_id);

            this.saveAction = {
                link: `${BASE_URL}/dashboard/releas/${this.case.id}`,

                type: 'put'
            };
            // console.log(this.saveAction)
        }

    },

    methods: {
        save() {
            let logoImg = $('#file').get(0).files[0];

            let formData2 = new FormData();
            formData2.append('file', logoImg);
            formData2.append('title', this.title);
            formData2.append('link', this.link);
            formData2.append('description', this.description);
            formData2.append('active', this.active_case?this.active_case.id:'');
            formData2.append('photo_id', jQuery('#main_photo_id').val());

            // formData.append('file', logoImg);
            let data = {
                title: this.title,
                link: this.link,
                description:this.description,
                active:this.active_case?this.active_case.id:'',
                photo_id:jQuery('#main_photo_id').val(),

            }
            this.saveForm(formData2);
        },


    },
    components: {
        VSelect: Multiselect
    },

    mixins: [form],
});