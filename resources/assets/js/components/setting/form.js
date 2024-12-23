import form from '../../mixins/form';

Vue.component('setting-form', {


    props: {
        setting: Object
    },

    data() {
        return {
            web_site_name: null,
            mobile:null,
            facebook:null,
            instagram:null,
			email:null,
            twitter:null,
			main_post_template: null,
            phone:null,
            youtube:null,
            googepluse:null,
            whatsapp:null,
			telegram: null,
            nabd:null,
            android:null,
            iphone:null,
            main_tags:null,
            head_script:null,
            footer_script:null,
            soundcloud:null,
            description:null,
            google_analytics:null,
            redirectPath: `${BASE_URL}/dashboard/setting`,
            saveAction: {
                link: `${BASE_URL}/dashboard/setting/update`,
                type: 'post'
            },
        }
    },

    mounted(){
        if(this.setting) {
            this.web_site_name = this.setting.web_site_name;
            this.mobile = this.setting.mobile;
            this.facebook = this.setting.facebook;
            this.instagram = this.setting.instagram;
            this.twitter = this.setting.twitter;
			this.email= this.setting.email;
			this.main_post_template= this.setting.main_post_template;
            this.phone= this.setting.phone;
            this.youtube= this.setting.youtube;
            this.googepluse= this.setting.googepluse;
            this.whatsapp= this.setting.whatsapp;
			this.telegram= this.setting.telegram;
            this.nabd= this.setting.nabd;
            this.android= this.setting.android;
            this.iphone= this.setting.iphone;
            this.main_tags= this.setting.main_tags;
            this.head_script= this.setting.head_script;
            this.footer_script= this.setting.footer_script;
            this.soundcloud=this.setting.soundcloud;
            this.description=this.setting.description;
            this.google_analytics=this.setting.google_analytics;

           // console.log(this.saveAction)
        }

    },

    methods: {
        save() {
            let data = {
            web_site_name: this.web_site_name,
            mobile:this.mobile,
            facebook:this.facebook,
            instagram:this.instagram,
			email:this.email,
            twitter:this.twitter,
			main_post_template: this.main_post_template,
            phone:this.phone,
            youtube:this.youtube,
            googepluse:this.googepluse,
            whatsapp:this.whatsapp,
			telegram: this.telegram,
            nabd:this.nabd,
            android:this.android,
            iphone:this.iphone,
            soundcloud:this.soundcloud,
            main_tags:this.main_tags,
            head_script:this.head_script,
            footer_script:this.footer_script,
            description:this.description,
            google_analytics:this.google_analytics
            }

            this.saveForm(data);
        },


    },


    mixins: [form],
});