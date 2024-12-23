import form from '../../mixins/form';
import Multiselect from 'vue-multiselect';
import VueCropper from "vue-cropperjs";
Vue.component('users-form', {

    props: {
        roles: Array,
        user: Object
    },

    data() {
        return {
            name: null,
            mobile: null,
            email: null,
            password: null,
            imgSrc: null,
            cropImg: null,
            role_id:null,
            redirectPath: `${BASE_URL}/dashboard/users`,
            saveAction: {
                link: `${BASE_URL}/dashboard/users`,
                type: 'post'
            },
        }
    },

    mounted(){
        if(this.user) {
            this.name = this.user.name;
            this.mobile = this.user.mobile;
            this.email = this.user.email;
            this.type = this.user.type;
            this.role_id = this.user.role;
            if(_AVATAR_IMAGE != null) {
                this.imgSrc = _AVATAR_IMAGE;
                this.cropImg = _AVATAR_IMAGE;
                this.$refs.cropper.replace(_AVATAR_IMAGE);
            }
            this.redirectPath= `${BASE_URL}/dashboard/users/${this.user.id}/edit`,

                this.saveAction = {
                link: `${BASE_URL}/dashboard/users/${this.user.id}`,
                type: 'put'
            };
        }
    },

    methods: {
        save() {
            let data = {
                name: this.name,
                mobile: this.mobile,
                email: this.email,
                type: this.type,
                password: this.password,
                photo: this.cropImg,
                role:this.role_id?this.role_id.id:null
            }
            this.saveForm(data);
        },
        setImage (e) {
            const file = e.target.files[0];

            if (!file.type.includes('image/')) {
                alert('Please select an image file');
                return;
            }

            if (typeof FileReader === 'function') {
                const reader = new FileReader();

                reader.onload = (event) => {
                    this.imgSrc = event.target.result;
                    this.cropImg = this.imgSrc;
                    // rebuild cropperjs with the updated source
                    this.$refs.cropper.replace(event.target.result);
                };

                reader.readAsDataURL(file);
            } else {
                alert('Sorry, FileReader API not supported');
            }
        },
        cropImage () {
            this.cropImg = this.$refs.cropper.getCroppedCanvas().toDataURL();
        },

    },

    mixins: [form],

    components: {
        vueCropper: VueCropper,
        VSelect: Multiselect
    },
});