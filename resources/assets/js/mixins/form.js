export default {
    data() {
        return {
            form: {
                disabled: false,
                error: false,
                validations: [],
                message: null,
            },
        }
    },
    methods: {
        saveForm($data) {
            this.form.disabled = true;
            axios({
                method: this.saveAction.type,
                url: this.saveAction.link,
                data: $data
            }).then(response => {
                jQuery('.modal').modal('hide');
                jQuery('.form-control').val('');
                this.form.disabled = false;
                swal({
                    title: response.data.message,
                    text: "",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
                if(this.redirectPath !== null) {
                    setTimeout(() => {
                        if (this.redirectPath !== null) {
                            location.href = this.redirectPath;
                        }
                        else {
                            this.form.disabled = false;
                        }
                    }, 2000)
                } else {
                    $('#static').modal("hide");
                    this.$refs.table.refresh();
                    this.name=null;
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
    }
}