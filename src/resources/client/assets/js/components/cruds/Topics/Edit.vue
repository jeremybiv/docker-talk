<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Topic</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <form @submit.prevent="submitForm" novalidate>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit</h3>
                            </div>

                            <div class="box-body">
                                <back-buttton></back-buttton>
                            </div>

                            <bootstrap-alert />

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="subject">Subject *</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="subject"
                                            placeholder="Enter Subject *"
                                            :value="item.subject"
                                            @input="updateSubject"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="description">Description *</label>
                                    <vue-ckeditor
                                            name="description"
                                            :id="'description'"
                                            :value="item.description"
                                            @input="updateDescription"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input
                                            type="email"
                                            class="form-control"
                                            name="email"
                                            placeholder="Enter Email *"
                                            :value="item.email"
                                            @input="updateEmail"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="date">Date *</label>
                                    <date-picker
                                            :value="item.date"
                                             :config="options"
                                            name="date"
                                            placeholder="Enter Date *"
                                            @dp-change="updateDate"
                                            >
                                    </date-picker>
                                </div>
                                <div class="form-group">
                                    
                                    <input
                                            type="hidden"
                                            max="1"
                                            class="form-control"
                                            name="status"
                                            placeholder="Enter Status"
                                            :value="item.status"
                                            @input="updateStatus"
                                            >
                                </div>
                            </div>

                            <div class="box-footer">
                                <vue-button-spinner
                                        class="btn btn-primary btn-sm"
                                        :isLoading="loading"
                                        :disabled="loading"
                                        >
                                    Save
                                </vue-button-spinner>
                                <button
                                @click.prevent="submitForm(true)"
                                        class="publish btn btn-primary btn-success btn-sm"
                                        :isLoading="loading"
                                        :disabled="loading"
                                        >
                                    Publish
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            options : {
                format: 'YYYY-MM-DD',
                locale: 'en',
                useCurrent: false,
                enabledDates :  this.getFutureTuesday()
            }
        } 
    },
    computed: {
        ...mapGetters('TopicsSingle', ['item', 'loading']),
    },
    created() {
        this.fetchData(this.$route.params.id)
    },
    destroyed() {
        this.resetState()
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.fetchData(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions('TopicsSingle', ['fetchData', 'updateData', 'resetState', 'setSubject', 'setDescription', 'setEmail', 'setDate', 'setStatus']),
        updateSubject(e) {
            this.setSubject(e.target.value)
        },
        updateDescription(value) {
            this.setDescription(value)
        },
        updateEmail(e) {
            this.setEmail(e.target.value)
        },
        updateDate(e) {
            this.setDate(e.target.value)
        },
        updateStatus(e) {
            this.setStatus(e.target.value)
        },
        submitForm(publish = false) {
            if(publish)
                this.setStatus(1);
            this.updateData()
                .then(() => {
                     if(publish)
                        this.$router.push({ name: 'topics.drafts' })
                    else
                        this.$router.push({ name: 'topics.index' })
                    this.$eventHub.$emit('update-success')
                })
                .catch((error) => {
                    console.error(error)
                })
        },
        getFutureTuesday() 
        {
            var m = new Date(Date.now()).getMonth();
            var y = new Date(Date.now()).getFullYear();
            
            var x = 0;
            var i = 0;
            var t= 0;
            var months = [];
            var monthsnYear = [];
            for (i = m; i <= (m+6); i++) {
                if(i<12 && i %2==1)
                months.push(i);    
            }
            // get also all tuesday for next year
            if(m>6) {
                for (i = 0; i <= (12-m); i++) {
                if(i<12 && i %2==1)
                    monthsnYear.push(i);    
                }
            }
            var  days = [];
            for (x of months) {
                days.push(this.nthDayInMonth(1, 2, x));
            }
            for (t of monthsnYear) {
                days.push(this.nthDayInMonth(1, 2, t, parseInt(y+1) ));
            }
            return days;
    },
    nthDayInMonth(n, day, m, y) {
        // day is in range 0 Sunday to 6 Saturday
        var y = y ||
                new Date(Date.now()).getFullYear();
        var m = m ||
                new Date(Date.now()).getMonth();
        var d = this.firstDayInMonth(day, m, y);
        return new Date(y,
            d.getMonth(), d.getDate() + (n - 1) * 7);
    },
    firstDayInMonth(day, m, y) {
        // day is in range 0 Sunday to 6 Saturday
        var y = y ||
                new Date(Date.now()).getFullYear();
        var m = m ||
                new Date(Date.now()).getMonth();
        return new Date(y, m, 1 +
        (day - new Date(y, m, 1).getDay() + 7) % 7);
    }

    }
}
</script>


<style scoped>
button.publish {
    margin-left:20px;
    display:block;
}
</style>
