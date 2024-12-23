import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';
import moment from "moment/moment";

Vue.component('reports-form', {


    props: {


    },

    data() {
        return {
            type: null,
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
            facebook: null,
            twitter: null,
            youtube: null,
            whatsapp: null,
            instagram: null,
            redirectPath: `${BASE_URL}/dashboard/reports`,
            saveAction: {
                link: `${BASE_URL}/dashboard/reports`,
                type: 'post'
            },
        }
    },

    mounted(){

    },

    methods: {
        save() {
            let data = {
                type: this.type,
                facebook: this.facebook,
                twitter: this.twitter,
                youtube: this.youtube,
                whatsapp: this.whatsapp,
                instagram: this.instagram,
                start_date:this.value6?this.changeDate(this.value6[0]):'',
                end_date:this.value6?this.changeDate(this.value6[1]):'',

            }
            this.saveForm(data);
        },
        changeDate(val){
            if(val){
                return moment(val).format('YYYY-MM-DD');
            }


        },


    },
    components: {
        VSelect: Multiselect
    },

    mixins: [form],
});