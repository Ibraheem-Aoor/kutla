import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';

Vue.component('writers-form', {


    props: {
        writer: Object,
        categories: Array,
        countries: Array
    },

    data() {
        return {
            name: null,
            category_id: this.categories?this.categories[0]:null,
            country_id:null,
            mobile:null,
            facebook:null,
            instagram:null,
            twitter:null,
            details:null,
            description:null,
            redirectPath: `${BASE_URL}/dashboard/writers`,
            saveAction: {
                link: `${BASE_URL}/dashboard/writers`,
                type: 'post'
            },
        }
    },

    mounted(){
        if(this.writer) {
            this.name = this.writer.name;
            this.category_id = this.writer.category;
            this.country_id = this.writer.country;
            this.mobile = this.writer.mobile;
            this.facebook = this.writer.facebook;
            this.instagram = this.writer.instagram;
            this.twitter = this.writer.twitter;
            this.details = this.writer.details;
            this.description=this.writer.description;
            jQuery('#post_photo_caption').val(this.writer.photo_caption);
            jQuery('#main_photo_id').val(this.writer.photo_id);

                this.saveAction = {
                link: `${BASE_URL}/dashboard/writers/${this.writer.id}`,
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
                country_id:this.country_id?this.country_id.id:'',
                mobile:this.mobile,
                facebook:this.facebook,
                instagram:this.instagram,
                twitter:this.twitter,
                details:this.details,
                description:this.description,
                photo_caption:jQuery('#post_photo_caption').val(),
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