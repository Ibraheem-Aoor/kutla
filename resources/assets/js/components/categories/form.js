import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';
Vue.component('categories-form', {


    props: {
        category: Object,
        positions: Array
    },

    data() {
        return {
            name: null,
            type: 'post',
            position:null,
            order:null,
            all_postion:[],
            is_menu:{id:'0',name:'لا'},
            actives:[{id:'1',name:'نعم'},{id:'0',name:'لا'}],
            redirectPath: `${BASE_URL}/dashboard/categories`,
            saveAction: {
                link: `${BASE_URL}/dashboard/categories`,
                type: 'post'
            },
        }
    },

    mounted(){
        if(this.positions){
            this.all_postion=this.positions
        }
        if(this.category) {
            this.name = this.category.name;
            this.type= this.category.type;
            this.order= this.category.order;
            this.position=this.category.position?this.category.position:'';
            if(this.category.is_menu==1){
                this.is_menu={id:'1',name:'نعم'};
            }else{
                this.is_menu={id:'0',name:'لا'};
            }
            this.saveAction = {
                link: `${BASE_URL}/dashboard/categories/${this.category.id}`,
                type: 'put'
            };
        }

    },
    components: {
        VSelect: Multiselect
    },
    methods: {
        save() {
            let data = {
                name: this.name,
                type: this.type,
                order: this.order,
                position:this.position?this.position.id:'',
                is_menu:this.is_menu?this.is_menu.id:'',

            }
            this.saveForm(data);
        },


    },

    mixins: [form],
});