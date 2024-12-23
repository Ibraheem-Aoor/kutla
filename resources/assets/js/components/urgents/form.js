import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';
import {Checkbox, DateTimePicker} from "element-ui";

Vue.component('urgents-form', {


    props: {
        urgent: Object,
        categories: Array
    },

    data() {
        return {
            duration: null,
            title: null,
            category_id: null,
            url: null,
            redirectPath: `${BASE_URL}/dashboard/urgents`,
            saveAction: {
                link: `${BASE_URL}/dashboard/urgents`,
                type: 'post'
            },
        }
    },

    mounted(){
        if(this.urgent) {
            this.duration = this.urgent.duration;
            this.title = this.urgent.title;
            this.url = this.urgent.url;
            this.category_id = this.urgent.category;

            this.saveAction = {
                link: `${BASE_URL}/dashboard/urgents/${this.urgent.id}`,
                type: 'put'
            };
        }

    },

    methods: {
        save() {
            let data = {
                url: this.url,
                title: this.title,
                category_id: this.category_id ? this.category_id.id : '',
                duration: this.duration
            }
            this.saveForm(data);
        },


    },
    components: {
        VSelect: Multiselect
    },

    mixins: [form],
});