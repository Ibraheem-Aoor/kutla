import form from '../../mixins/form';
import {Checkbox} from 'element-ui';

Vue.component('action-role', {

    props: {
        actions: Array,
        user:Object,
        role: Object
    },

    data() {
        return {
            checkall:false,
            privilege:[{add_post:false},{edit_post:false},{delete_post:false},{view_post:false},
                {add_cat:false},{edit_cat:false},{delete_cat:false},{view_cat:false}
            ,{add_album:false},{edit_album:false},{delete_album:false},{view_album:false},
                {add_video:false},{edit_video:false},{delete_video:false},{view_video:false}
            ,{add_user:false},{edit_user:false},{delete_user:false},{view_user:false}
               ,{delete_tag:false},{view_tag:false},{add_writer:false},{edit_writer:false},{delete_writer:false},{view_writer:false}
                ,{add_case:false},{edit_case:false},{delete_case:false},{view_case:false}
                ,{add_vote:false},{edit_vote:false},{delete_vote:false},{view_vote:false}
                ,{add_page:false},{edit_page:false},{delete_page:false},{view_page:false}
                ,{add_urgent:false},{edit_urgent:false},{delete_urgent:false},{view_urgent:false}
                ,{add_adv:false},{edit_adv:false},{delete_adv:false},{view_adv:false},{setting:false},{add_live_videos:false},{edit_live_videos:false},{delete_live_videos:false},{view_live_videos:false}
                ,{view_contactus:false},{replay_contactus:false},{delete_contactus:false},
                {add_events:false},{edit_events:false},{view_events:false},{delete_events:false},{view_user_logs:false}
                ,{add_hotel:false},{edit_hotel:false},{view_hotel:false},{delete_hotel:false}],

            redirectPath: `${BASE_URL}/dashboard/users/roles`,
            saveAction: {
                link: `${BASE_URL}/dashboard/users/roles/privilege`,
                type: 'post'
            },
        }
    },

    mounted(){
if(this.user){
    this.redirectPath= `${BASE_URL}/dashboard/users`;
}
        let someArray = this.privilege;
        for (let x=0;x<this.actions.length;x++){
            let Index = someArray.findIndex( filterCarObj=>
                filterCarObj[this.actions[x]] === false);

            if(this.actions.includes(this.actions[x])){
                this.privilege[Index][this.actions[x]]=true
            }
        }

        },

    methods: {
        save() {
            let data = {
                role: this.role?this.role.id:null,
                user_id:this.user?this.user.id:null,
                privilege: this.privilege,
            }
            this.saveForm(data);
        },


    },
    watch:{
        checkall: function (val) {
           if(val){
               this.privilege=[{add_post:true},{edit_post:true},{delete_post:true},{view_post:true},
                   {add_cat:true},{edit_cat:true},{delete_cat:true},{view_cat:true}
                   ,{add_album:true},{edit_album:true},{delete_album:true},{view_album:true},
                   {add_video:true},{edit_video:true},{delete_video:true},{view_video:true}
                   ,{add_user:true},{edit_user:true},{delete_user:true},{view_user:true}
                   ,{delete_tag:true},{view_tag:true},{add_writer:true},{edit_writer:true},{delete_writer:true},{view_writer:true}
                   ,{add_case:true},{edit_case:true},{delete_case:true},{view_case:true}
                   ,{add_vote:true},{edit_vote:true},{delete_vote:true},{view_vote:true}
                   ,{add_page:true},{edit_page:true},{delete_page:true},{view_page:true}
                   ,{add_urgent:true},{edit_urgent:true},{delete_urgent:true},{view_urgent:true}
                   ,{add_adv:true},{edit_adv:true},{delete_adv:true},{view_adv:true},{setting:true}
                   ,{add_live_videos:true},{edit_live_videos:true},{delete_live_videos:true},{view_live_videos:true}
                   ,{view_contactus:true},{replay_contactus:true},{delete_contactus:true},
                   {add_events:true},{edit_events:true},{view_events:true},{delete_events:true},{view_user_logs:true}
                   ,{add_hotel:true},{edit_hotel:true},{view_hotel:true},{delete_hotel:true}];
           }else{
               this.privilege=[{add_post:false},{edit_post:false},{delete_post:false},{view_post:false},
                   {add_cat:false},{edit_cat:false},{delete_cat:false},{view_cat:false}
                   ,{add_album:false},{edit_album:false},{delete_album:false},{view_album:false},
                   {add_video:false},{edit_video:false},{delete_video:false},{view_video:false}
                   ,{add_user:false},{edit_user:false},{delete_user:false},{view_user:false}
                   ,{delete_tag:false},{view_tag:false},{add_writer:false},{edit_writer:false},{delete_writer:false},{view_writer:false}
                   ,{add_case:false},{edit_case:false},{delete_case:false},{view_case:false}
                   ,{add_vote:false},{edit_vote:false},{delete_vote:false},{view_vote:false}
                   ,{add_page:false},{edit_page:false},{delete_page:false},{view_page:false}
                   ,{add_urgent:false},{edit_urgent:false},{delete_urgent:false},{view_urgent:false}
                   ,{add_adv:false},{edit_adv:false},{delete_adv:false},{view_adv:false},{setting:false}
                   ,{add_live_videos:false},{edit_live_videos:false},{delete_live_videos:false},{view_live_videos:false}
                   ,{view_contactus:false},{replay_contactus:false},{delete_contactus:false}
                   ,{add_events:false},{edit_events:false},{view_events:false},{delete_events:false},{view_user_logs:false}
                   ,{add_hotel:false},{edit_hotel:false},{view_hotel:false},{delete_hotel:false}];
           }
        },
    },

    mixins: [form],

    components:{
        'el-checkbox': Checkbox
    }

});