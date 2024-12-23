import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';
import {DateTimePicker} from 'element-ui';
import {Checkbox} from 'element-ui';
import moment from 'moment';
import VueTagsInput from '@johmun/vue-tags-input';

Vue.component('remember-form', {


    props: {
        post_edit: Object,
        categories: Array,
        countries: Array,
        writers: Array,
        cases: Array,
        view_types: Array,
        positions: Array
    },

    data() {
        return {
            title: null,
            category_id: null,
            country_id: null,
            sub_title: null,
            summary: null,
            photo_caption: null,
            post: null,
            post_id:null,
            type: {id: 'transported', name: 'منقول'},
            active_post: {id: '1', name: 'منشور'},
            actives: [{id: '1', name: 'منشور'}, {id: '0', name: 'مسودة'}],
            all_postion: [],
            all_read_more:[],
            read_more_select:[],
            position: null,
            details: null,
            wirter: null,
            case_id: null,
            source: null,
            view_type_id: {id: 1, name: 'خبر'},
            main: false,
            editor: null,
            main2: false,
            main_news: true,
            chosen: false,
            private_file: false,
            slider: false,
            report: false,
            tag: '',
            tags: [],
            static:false,
            remember:true,
            autocompleteItems: [],
            debounce: null,
            publish_at: this.changeDate(new Date()),
            posts_type: [{id: 'transported', name: 'خبر منقول'}, {
                id: 'special_news',
                name: 'خبر خاص'
            }, {id: 'special_report', name: 'تقرير خاص'}, {
                id: 'synthesis_report',
                name: 'تقرير منقول'
            }, {id: 'special_interview', name: 'مقابلة خاصة'}],
            redirectPath: null,
            saveAction: {
                link: `${BASE_URL}/dashboard/remember`,
                type: 'post'
            },
            pickerOptions: {
                disabledDate(date) {
                    return date > new Date();
                }
            }
        }
    },


    mounted() {
        if (this.post_edit) {
            this.details = this.post_edit.details;
            this.saveAction = {
                link: `${BASE_URL}/dashboard/remember/${this.post_edit.id}`,
                type: 'put'
            };

            axios.get(`${BASE_URL}/dashboard/remember/get_post/` +this.post_edit.id).then(response => {
                this.post = response.data.post
                if (this.post) {
                    this.read_more_select=response.data.read_more_selected;
                    this.title = this.post.title;
                    this.category_id = this.post.category;
                    this.country_id = this.post.country;
                    this.details = this.post.details;
                    jQuery('#content').val(this.post.details);
                    this.sub_title = this.post.sub_title;
                    this.type = this.getType(this.post.type);
                    jQuery('#summary').val(this.post.summary);
                    jQuery('#video_id').val(this.post.video);
                    jQuery('#main_youtube').val(this.post.youtube);
                    jQuery('#main_facebook').val(this.post.facebook);
                    this.photo_caption=this.post.photo_caption;
                    jQuery('#main_photo_id').val(this.post.photo_id);
                    this.position = this.post.position ? this.post.position : '';
                    this.wirter = this.post.writer ? this.post.writer : '';
                    this.editor = this.post.editor;
                    this.view_type_id = this.post.view_type ? this.post.view_type : '';
                    this.case_id = this.post.cases ? this.post.cases : '';
                    this.source = this.post.source;
                    if (this.post.main) {
                        this.main = true
                    }
                    if (this.post.main2) {
                        this.main2 = true
                    }
                    if (this.post.main_news) {
                        this.main_news = true
                    }
                    if (this.post.chosen) {
                        this.chosen = true
                    }if (this.post.private_file) {
                        this.private_file = true
                    }if (this.post.slider) {
                        this.slider = true
                    }
                    if (this.post.report) {
                        this.report = true
                    }
                    if (this.post.static) {
                        this.static = true
                    }
                    if (this.post.remember) {
                        this.remember = true
                    }

                    this.publish_at = this.changeDate(this.post.published_at);
                    if (this.post.tags) {
                        this.tags = this.post.tags ? this.post.tags.split(',') : null
                    }

                    if (this.post.active == 1) {
                        this.active_post = {id: '1', name: 'منشور'};
                    } else {
                        this.active_post = {id: '0', name: 'مسودة'};
                    }

                    // this.publish_at= Date(this.publish_at).format('YYYY-MM-DDTH:mm:s'),

                }
            });
        }
        if (this.positions) {
            this.all_postion = this.positions
        }

    },

    methods: {
        search_post(val){
            if(val.length>2){
                axios.post(`${BASE_URL}/dashboard/remember/search`, {
                    key: val
                }).then(response => {
                    this.all_read_more = response.data.posts;

                });
            }

        },
        update(newTags) {
            this.autocompleteItems = [];
            this.tags = newTags;
        },
        initItems() {
            if (this.tag.length === 0) return;
            const url = `${BASE_URL}/dashboard/tags/get_tags?term=
        ${this.tag}&entity=allArtist&attribute=allArtistTerm&limit=6`;

            clearTimeout(this.debounce);
            this.debounce = setTimeout(() => {
                axios.get(url).then(response => {
                    this.autocompleteItems = response.data.tags.map(a => {
                        return {text: a};
                    });
                }).catch(() => console.warn('Oh. Something went wrong'));
            }, 600);
        },
        getType(type) {
            let type_case = null;
            switch (type) {
                case 'transported':
                    type_case = {id: 'transported', name: 'خبر منقول'};
                    break;
                case 'special_news':
                    type_case = {id: 'special_news', name: 'خبر خاص'};
                    break;
                case 'special_report':
                    type_case = {id: 'special_report', name: 'تقرير خاص'};
                    break;
                case 'synthesis_report':
                    type_case = {id: 'synthesis_report', name: 'تقرير منقول'};
                    break;
                case 'special_interview':
                    type_case = {id: 'special_interview', name: 'مقابلة خاصة'};
                    break;

            }
            return type_case;
        },
        changeDate(val) {
            return moment(val).format('YYYY-MM-DD H:m:s');

        },
        changeMain(val) {
            if(val){
                this.main2=false;
            }

        },
        changeMain2(val) {
            if(val){
                this.main=false;
            }
        },
        saveReturn(){
            this.redirectPath=`${BASE_URL}/dashboard/remember`;
            this.save();
        },
        save() {
            let data = {
                title: this.title,
                category_id: this.category_id ? this.category_id.id : '',
                country_id: this.country_id ? this.country_id.id : '',
                detailes: jQuery('#content').val(),
                sub_title: this.sub_title,
                type: this.type ? this.type.id : '',
                summary: jQuery('#summary').val(),
                photo_caption: this.photo_caption,
                writer_id: this.wirter ? this.wirter.id : '',
                case_id: this.case_id ? this.case_id.id : '',
                view_type_id: this.view_type_id ? this.view_type_id.id : '',
                source: this.source,
                position: this.position ? this.position.id : '',
                active: 1,
                photo_id: jQuery('#main_photo_id').val(),
                publish_at: this.changeDate(this.publish_at),
                main: this.main,
                editor:this.editor,
                main2:this.main2,
                main_news:this.main_news,
                chosen:this.chosen,
                tags_post: this.tags,
                read_more_select:this.read_more_select,
                album_image_array: jQuery('#album_image_array').val(),
                video: jQuery('#video_id').val(),
                youtube: jQuery('#main_youtube').val(),
                facebook: jQuery('#main_facebook').val(),
                post_photo_caption:jQuery('#post_photo_caption').val(),
                private_file:this.private_file,
                slider:this.slider,
                report:this.report,
                static:this.static,
                remember:this.remember
            }
            this.saveForm(data);
        },
        savePrivew() {
            let data = {
                title: this.title,
                category_id: this.category_id ? this.category_id.id : '',
                country_id: this.country_id ? this.country_id.id : '',
                detailes: jQuery('#content').val(),
                sub_title: this.sub_title,
                type: this.type ? this.type.id : '',
                summary: jQuery('#summary').val(),
                photo_caption: this.photo_caption,
                writer_id: this.wirter ? this.wirter.id : '',
                case_id: this.case_id ? this.case_id.id : '',
                view_type_id: this.view_type_id ? this.view_type_id.id : '',
                source: this.source,
                position: this.position ? this.position.id : '',
                active: 0,
                photo_id: jQuery('#main_photo_id').val(),
                publish_at: this.changeDate(this.publish_at),
                main: this.main,
                editor:this.editor,
                main2:this.main2,
                main_news:this.main_news,
                chosen:this.chosen,
                tags_post: this.tags,
                album_image_array: jQuery('#album_image_array').val(),
                video: jQuery('#video_id').val(),
                youtube: jQuery('#main_youtube').val(),
                facebook: jQuery('#main_facebook').val(),
                post_photo_caption:jQuery('#post_photo_caption').val(),
                private_file:this.private_file,
                slider:this.slider,
                report:this.report,
                static:this.static,
                remember:this.remember
            }
            axios({
                method: 'post',
                url: `${BASE_URL}/dashboard/posts`,
                data: data
            }).then(response => {
                if(response.data){
                    let win = window.open(`${BASE_URL}/post/`+response.data.post.id, '_blank');
                    win.focus();
                }

            }).catch(error => {

                this.form.disabled = false;
                this.form.error = true;
                if(error.response.data.errors) {
                    this.form.message = 'يوجد بيانات غير مدخلة.';
                    this.form.validations = error.response.data.errors;
                }
                else if(error.response.data.message) {
                    this.form.validations = [];
                    this.form.message = error.response.data.message;
                }
                document.body.scrollTop = 0; // For Chrome, Safari and Opera
                document.documentElement.scrollTop = 0; // For IE and Firefox
            })
        },
        saveDraft() {
            swal({
                    title: "هل تريد حفظ المنشور كمسودة ؟",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "الغاء الأمر",
                    confirmButtonText: "نعم",
                    closeOnConfirm: true
                },
                () => {
                    let data = {
                        title: this.title,
                        category_id: this.category_id ? this.category_id.id : '',
                        country_id: this.country_id ? this.country_id.id : '',
                        detailes: jQuery('#content').val(),
                        sub_title: this.sub_title,
                        type: this.type ? this.type.id : '',
                        summary: jQuery('#summary').val(),
                        photo_caption: this.photo_caption,
                        writer_id: this.wirter ? this.wirter.id : '',
                        case_id: this.case_id ? this.case_id.id : '',
                        view_type_id: this.view_type_id ? this.view_type_id.id : '',
                        source: this.source,
                        position: this.position ? this.position.id : '',
                        active: 0,
                        editor:this.editor,
                        main2:this.main2,
                        main_news:this.main_news,
                        chosen:this.chosen,
                        photo_id: jQuery('#main_photo_id').val(),
                        publish_at: this.changeDate(this.publish_at),
                        main: this.main,
                        tags_post: this.tags,
                        album_image_array: jQuery('#album_image_array').val(),
                        video: jQuery('#video_id').val(),
                        youtube: jQuery('#main_youtube').val(),
                        facebook: jQuery('#main_facebook').val(),
                        slider:this.slider,
                        report:this.report,
                        static:this.static,
                        remember:this.remember
                    }
                    this.saveForm(data);
                });

        },

    },

    components: {
        VSelect: Multiselect,
        'el-checkbox': Checkbox,
        VueTagsInput,
        DateTimePicker
    },
    watch: {
        'tag': 'initItems',
    },
    mixins: [form],
});