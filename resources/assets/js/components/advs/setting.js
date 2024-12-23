import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';

Vue.component('advs-settings', {

    props: {
        setting: Object
    },

    data() {
        return {
            header: null,
            main_side_1: null,
            part_1: null,
            part_2: null,
            part_3: null,
            part_4: null,
            part_5: null,
            part_6: null,
            part_7: null,
            part_8: null,
            part_9: null,
            part_10: null,
            part_11: null,
            details_side_1: null,
            details_side_2: null,
            details_side_3: null,
            under_title: null,
            details_inside: null,
            after_details: null,
            hotel_side_1: null,
            hotel_side_2:null,
            hotel_side_3:null,
            infront_hotels:null,
            infront_details:null,
            main_under_title:null,
            redirectPath: `${BASE_URL}/dashboard/advs`,
            saveAction: {
                link: `${BASE_URL}/dashboard/advs/setting`,
                type: 'post'
            },
        }
    },

    mounted(){
        if(this.setting) {
            this.header=this.setting[0].adv_part_1;
                this.main_side_1=this.setting[0].adv_part_2;
                this.part_1=this.setting[0].adv_part_3;
                this.part_2=this.setting[0].adv_part_4;
                this.part_3=this.setting[0].adv_part_5;
                this.part_4=this.setting[0].adv_part_6;
                this.part_5=this.setting[0].adv_part_7;
                this.part_6=this.setting[0].adv_part_8;
                this.part_7=this.setting[0].adv_part_9;
                this.part_8=this.setting[0].adv_part_1;
                this.part_9=this.setting[0].adv_part_11;
                this.part_10=this.setting[0].adv_part_12;
                this.part_11=this.setting[0].adv_part_13;
                this.details_side_1=this.setting[1].adv_part_1;
                this.details_side_2=this.setting[1].adv_part_2;
                this.details_side_3=this.setting[1].adv_part_3;
                this.under_title=this.setting[1].adv_part_4;
                this.details_inside=this.setting[1].adv_part_5;
                this.after_details=this.setting[1].adv_part_6;
                this.hotel_side_1=this.setting[2].adv_part_1;
                this.hotel_side_2=this.setting[2].adv_part_2;
                this.hotel_side_3=this.setting[2].adv_part_3;
            this.infront_hotels=this.setting[2].adv_part_4;
            this.infront_details=this.setting[1].adv_part_7;
            this.main_under_title=this.setting[0].adv_part_14;
        }

    },

    methods: {
        save() {
            let data = {
                header: this.header,
                main_side_1: this.main_side_1,
                part_1: this.part_1,
                part_2: this.part_2,
                part_3: this.part_3,
                part_4: this.part_4,
                part_5: this.part_5,
                part_6: this.part_6,
                part_7: this.part_7,
                part_8: this.part_8,
                part_9: this.part_9,
                part_10: this.part_10,
                part_11: this.part_11,
                details_side_1: this.details_side_1,
                details_side_2: this.details_side_2,
                details_side_3: this.details_side_3,
                under_title: this.under_title,
                details_inside: this.details_inside,
                after_details: this.after_details,
                hotel_side_1: this.hotel_side_1,
                hotel_side_2:this.hotel_side_2,
                hotel_side_3:this.hotel_side_3,
                infront_hotels:Number(this.infront_hotels),
                infront_details:this.infront_details,
                main_under_title:this.main_under_title,
            }
            this.saveForm(data);
        },

    },
    components: {
        VSelect: Multiselect
    },
    mixins: [form],
});