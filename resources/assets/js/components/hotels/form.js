import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';

Vue.component('hotels-form', {


    props: {
        hotel: Object
    },

    data() {
        return {
            name: null,
            address:null,
            mobile:null,
            facebook:null,
            site:null,
            phone:null,
            whatsapp:null,
            redirectPath: `${BASE_URL}/dashboard/hotels`,
            saveAction: {
                link: `${BASE_URL}/dashboard/hotels`,
                type: 'post'
            },
        }
    },

    mounted(){
        if(this.hotel) {
            this.name = this.hotel.name;
            this.mobile = this.hotel.mobile;
            this.facebook = this.hotel.facebook;
            this.phone = this.hotel.phone;
            this.site = this.hotel.site;
            this.address = this.hotel.address;
            this.whatsapp=this.hotel.whatsapp;
            jQuery('#post_photo_caption').val(this.hotel.photo_caption);
            jQuery('#main_photo_id').val(this.hotel.photo_id);

                this.saveAction = {
                link: `${BASE_URL}/dashboard/hotels/${this.hotel.id}`,
                type: 'put'
            };
           // console.log(this.saveAction)
        }

    },

    methods: {
        save() {
            let data = {
                name: this.name,
                address:this.address,
                mobile:this.mobile,
                facebook:this.facebook,
                site:this.site,
                phone:this.phone,
                whatsapp:this.whatsapp,
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