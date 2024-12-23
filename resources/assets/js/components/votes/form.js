import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';
import moment from 'moment';

Vue.component('vote-form', {


    props: {
        vote: Object,
        categories:Array,

    },

    data() {
        return {
            name: null,
            details:null,
            answers:[],
            active_vote:{id:'1',name:'منشور'},
            vote_type:{id:'vote',name:'استفتاء عادي'},
            category_id:null,
            all_type:[{id:'vote',name:'استفتاء عادي'},{id:'year',name:'استفتاء سنوي'}],
            actives:[{id:'1',name:'منشور'},{id:'0',name:'غير منشور'}],
            redirectPath: `${BASE_URL}/dashboard/votes`,
            saveAction: {
                link: `${BASE_URL}/dashboard/votes`,
                type: 'post'
            },
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
            value7: ''

        }
    },

    mounted(){
        this.answers.push({name: null,photo_id:null});
        this.answers.push({name: null,photo_id:null});

        if(this.vote) {
            this.name = this.vote.name;
            this.details = this.vote.details;

            this.category_id=this.vote.category
            if(this.vote.active==1){
                this.active_vote={id:'1',name:'منشور'};
            }else{
                this.active_vote={id:'0',name:'غير منشور'};
            }
            if(this.vote.type=='vote'){
                this.vote_type={id:'vote',name:'استفتاء عادي'};
            }else{
                this.vote_type={id:'year',name:'استفتاء سنوي'};
            }
            this.value6=[this.vote.start_date,this.vote.end_date]

            jQuery('#main_photo_id').val(this.vote.photo_id);
            this.answers = this.vote.answers;

                this.saveAction = {
                link: `${BASE_URL}/dashboard/votes/${this.vote.id}`,

                    type: 'put'
            };
           // console.log(this.saveAction)
        }

    },

    methods: {
        save() {
            let answer_image=[];
            jQuery(".image_answer").each(function(){
                answer_image.push(jQuery(this).val())
            });
            let data = {
                name: this.name,
                category_id: this.category_id?this.category_id.id:'',
                details:this.details,
                type:this.vote_type?this.vote_type.id:'',
                answers:this.answers,
                answer_image:answer_image,
                active:this.active_vote?this.active_vote.id:'',
                start_date:this.value6?this.changeDate(this.value6[0]):'',
                end_date:this.value6?this.changeDate(this.value6[1]):'',
                photo_id:jQuery('#main_photo_id').val(),
            }
            this.saveForm(data);
        },
        changeDate(val){
            if(val){
                return moment(val).format('YYYY-MM-DD');
            }


        },
        addItem() {
            this.answers.push({name: null,photo_id:null});
        },

        deleteItem(item) {
            this.answers.splice(this.answers.indexOf(item), 1);
        },
    },
    components: {
        VSelect: Multiselect
    },

    mixins: [form],
});