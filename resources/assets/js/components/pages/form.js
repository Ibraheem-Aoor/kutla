import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';

Vue.component('pages-form', {


    props: {
        page: Object
    },

    data() {
        return {
            name: null,
            summary:null,
            details:null,
            active_post:{id:'1',name:'منشور'},
            actives:[{id:'1',name:'منشور'},{id:'0',name:'مسودة'}],
             redirectPath: `${BASE_URL}/dashboard/pages`,
            saveAction: {
                link: `${BASE_URL}/dashboard/pages`,
                type: 'post'
            },
        }
    },

    mounted(){

        if(this.page) {
            this.redirectPath= `${BASE_URL}/dashboard/pages/${this.page.id}/edit`,
            this.name = this.page.name;
            this.details=this.page.details;
            jQuery('#content').val(this.page.details);
            jQuery('#summary').val(this.page.summary);
            jQuery('#main_photo_id').val(this.page.photo_id);

                if(this.page.active==1){
                    this.active_post={id:'1',name:'منشور'};
                }else{
                    this.active_post={id:'0',name:'مسودة'};
                }


            this.saveAction = {
                link: `${BASE_URL}/dashboard/pages/${this.page.id}`,
                type: 'put'
            };
        }

    },

    methods: {

        save() {

            let data = {
                name: this.name,
                detailes: jQuery('#content').val(),
                summary:jQuery('#summary').val(),
                active:this.active_post?this.active_post.id:'',
                photo_id:jQuery('#main_photo_id').val(),

            }
            this.saveForm(data);
        },


    },
    components: {
        VSelect: Multiselect,
    },

    mixins: [form],
});