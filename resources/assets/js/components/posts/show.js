import { TableComponent, TableColumn } from 'vue-table-component';
import myDatepicker from 'vue-datepicker'
import moment from "moment";

Vue.component('employees-show', {
    props: {
        employee: Object,
    },

    data() {
        return {
            startTime: {
                time: ''
            },
            endTime: {
                time: ''
            },

            start_option: {
                type: 'day',
                week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                format: 'YYYY-MM-DD',
                placeholder: 'من ',
            },
            end_option: {
                type: 'day',
                week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                format: 'YYYY-MM-DD',
                placeholder: 'إلى ',
            },
            exportExcelParams: {},
        }
    },

    components: {
        'table-component': TableComponent,
        'table-column': TableColumn,
        'date-picker': myDatepicker
    },

    methods: {
        async fetchData({ page, filter, sort }) {
            this.exportExcelParams = {
                page: page,
                filter: filter,
                sort: sort,
                start: this.startTime.time,
                end: this.endTime.time
            };
            const response = await axios.get('/employees/'+this.employee.id+'/show/get_activities?start='+this.startTime.time+'&end='+this.endTime.time, {params: { page, filter, sort }});
            return {
                data: response.data.employee_activity.data,

                pagination: {
                    currentPage: response.data.employee_activity.current_page,
                    totalPages: response.data.employee_activity.last_page
                }
            };
        },

        exportExcel() {
            document.getElementById("exportExcel").submit();
        },

        getMomentTime(emp_activity) {
            return moment(emp_activity.registered_time).format('hh:mm');
        },

        getEmployee(){
            return this.employee;
        },

        getStatus(employee_activity) {
            if(employee_activity.status_duration == 0) {
                return 'في الوقت';
            }
            if(employee_activity.status_duration > 0) {
                return 'في الوقت ' + '(+' + employee_activity.status_duration + ')';
            }
            if(employee_activity.status_duration < 0) {
                return 'متأخر ' + '(' + employee_activity.status_duration + ')';
            }
            return '';
        },

        getFontColor(employee_activity) {
            if(employee_activity.status_duration == 0) {
                return 'label label-success';
            }
            if(employee_activity.status_duration > 0) {
                return 'label label-success';
            }
            if(employee_activity.status_duration < 0) {
                return 'label label-danger';
            }
            return 'label label-danger';
        },

        startTimeOperation() {
            if(this.endTime.time) {
                if(moment(this.startTime.time) <= moment(this.endTime.time)) {
                    this.$refs.table.refresh();
                } else {
                    swal (
                        "تاريخ البداية يجب أن يكون أقل من تاريخ النهاية" ,
                        "" ,
                        "error"
                    )
                }
            }
        },

        endTimeOperation() {
            if(this.startTime.time) {
                if(moment(this.startTime.time) <= moment(this.endTime.time)) {
                    this.$refs.table.refresh();
                } else {
                    swal (
                        "تاريخ البداية يجب أن يكون أقل من تاريخ النهاية" ,
                        "" ,
                        "error"
                    )
                }
            } else {
                swal (
                    "أدخل تاريخ البداية" ,
                    "" ,
                    "error"
                )
            }
        }
    },
});