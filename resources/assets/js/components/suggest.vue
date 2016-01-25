<style lang="stylus"></style>

<template>
    <div class="col-md-8">
        <h1>Suggest a Host</h1>

        <router-view></router-view>

        <p>Submit the form below and we will get back to you right away!</p>

        <p><b>Please note:</b> We only list hosts that have services located in New Zealand.</p>

        <form role="form">
            <div class="form-group">
                <label for="name">Your name:</label> <input type="text" class="form-control" v-model="suggestForm.name"
                                                            id="name">
            </div>
            <div class="form-group">
                <label for="email">Email address:</label> <input type="email" class="form-control" id="email"
                                                                 name="email" v-model="suggestForm.email">
            </div>
            <div class="form-group">
                <label for="email">Host Website:</label> <input type="text" class="form-control" id="website"
                                                                 name="website" v-model="suggestForm.website">
            </div>
            <div class="form-group">
                <label for="message">Message:</label> <textarea name="message" class="form-control" id="message"
                                                                rows="5" v-model="suggestForm.message"></textarea>
            </div>

            <div style="display:none">
                <input type="text" name="my_name" v-model="suggestForm.my_name"> <input type="text" name="my_time"
                                                                                        v-model="suggestForm.my_time">
            </div>

            <button class="btn btn-default" @click.prevent="submitForm" v-show="!submittingForm">Submit</button>
            <img src="/images/loading.gif" alt="Loading" v-show="submittingForm"> <br/><br/>
        </form>
    </div>
</template>


<script>
    export default {
        data: function () {
            return {
                suggestForm: {
                    'name': '',
                    'email': '',
                    'message': '',
                    'my_time': '',
                    'my_name': ''
                },
                submittingForm: false
            };
        },
        methods: {
            submitForm: function () {
                if ($('input[name="my_time"]').val() != this.suggestForm.my_time || $('input[name="my_name"]').val() != "") {
                    return alert('Spammer!');
                }

                this.submittingForm = true;

                this.suggestForm.my_time = $('input[name="my_time"]').val();
                this.suggestForm.my_name = $('input[name="my_name"]').val();

                this.$http.post('suggest/send', this.suggestForm, function (data) {

                    if (data.success) {
                        this.suggestForm.name = "";
                        this.suggestForm.email = "";
                        this.suggestForm.message = "";
                        this.submittingForm = false;

                        this.$route.router.go('/suggest/send');
                    }
                    else {
                        this.submittingForm = false;
                        this.$route.router.go('/suggest/error');
                    }

                }).error(function (data, status) {
                    if (status == 422) {
                        this.submittingForm = false;

                        var errors = "The following errors occurred:";

                        for (var key in data) {
                            if (data.hasOwnProperty(key)) {
                                errors = errors + '\n' + data[key];
                            }
                        }

                        alert(errors);
                    }
                });

            }
        },
        ready: function () {
            this.$http.get('suggest/honey', [], function (data) {
                this.suggestForm.my_time = data.encrypted;
                $('input[name="my_time"]').val(data.encrypted);
            }).error(function (data, status) {
                console.log('error', data, status);
            });
        }
    };

</script>