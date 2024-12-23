import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';
import moment from "moment/moment";

Vue.component('events-form', {


    props: {
        event: Object,
        users: Array,
        users_add: Array,

    },

    data() {
        return {
            name: null,
            details:null,
            active_case:{id:'1',name:'منشور'},
            actives:[{id:'1',name:'منشور'},{id:'0',name:'غير منشور'}],
            user_id:[],
            pickerOptions1: {
                shortcuts: [{
                    text: 'Today',
                    onClick(picker) {
                        picker.$emit('pick', new Date());
                    }
                }, {
                    text: 'Yesterday',
                    onClick(picker) {
                        const date = new Date();
                        date.setTime(date.getTime() - 3600 * 1000 * 24);
                        picker.$emit('pick', date);
                    }
                }, {
                    text: 'A week ago',
                    onClick(picker) {
                        const date = new Date();
                        date.setTime(date.getTime() - 3600 * 1000 * 24 * 7);
                        picker.$emit('pick', date);
                    }
                }]
            },
            value1: '',
            value2: '',
            value3: '',
            redirectPath: `${BASE_URL}/dashboard/events`,
            saveAction: {
                link: `${BASE_URL}/dashboard/events`,
                type: 'post'
            },
        }
    },

    mounted(){
        if(this.event) {
            this.name = this.event.name;
            this.details = this.event.details;
            this.user_id=this.users_add
            if(this.event.active==1){
                this.active_case={id:'1',name:'منشور'};
            }else{
                this.active_case={id:'0',name:'غير منشور'};
            }
            this.value1=this.event.remember_date;

                this.saveAction = {
                link: `${BASE_URL}/dashboard/events/${this.event.id}`,

                    type: 'put'
            };
           // console.log(this.saveAction)
        }

    },

    methods: {
        save() {
            let data = {
                name: this.name,
                user_id: this.user_id,
                details:this.details,
                active:this.active_case?this.active_case.id:'',
                remember_date:this.value1?this.changeDate(this.value1):'',
            }
            this.saveForm(data);
        },
        changeDate(val){
            if(val){
                return moment(val).format('YYYY-MM-DD H:m:s');
            }


        },

    },
    components: {
        VSelect: Multiselect
    },

    mixins: [form],
});