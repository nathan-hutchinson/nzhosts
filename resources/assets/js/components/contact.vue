<style lang="stylus"></style>

<template>
    <div class="col-md-8">
        <h1>Contact NZ Hosts</h1>

        <router-view></router-view>

        <p>Submit the form below and we will get back to you right away!</p>

        <form role="form">
            <div class="form-group">
                <label for="name">Your name:</label> <input type="text" class="form-control" v-model="contactForm.name"
                                                            id="name">
            </div>
            <div class="form-group">
                <label for="email">Email address:</label> <input type="email" class="form-control" id="email"
                                                                 name="email" v-model="contactForm.email">
            </div>
            <div class="form-group">
                <label for="message">Message:</label> <textarea name="message" class="form-control" id="message"
                                                                rows="5" v-model="contactForm.message"></textarea>
            </div>

            <div style="display:none">
                <input type="text" name="my_name" v-model="contactForm.my_name"> <input type="text" name="my_time"
                                                                                        v-model="contactForm.my_time">
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
                contactForm: {
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
                if ($('input[name="my_time"]').val() != this.contactForm.my_time || $('input[name="my_name"]').val() != "") {
                    return alert('Spammer!');
                }

                this.submittingForm = true;

                this.contactForm.my_time = $('input[name="my_time"]').val();
                this.contactForm.my_name = $('input[name="my_name"]').val();

                this.$http.post('contact/send', this.contactForm, function (data) {

                    if (data.success) {
                        this.contactForm.name = "";
                        this.contactForm.email = "";
                        this.contactForm.message = "";

                        this.$route.router.go('/contact/send');
                    }
                    else {
                        this.$route.router.go('/contact/error');
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
            this.$http.get('contact/honey', [], function (data) {
                this.contactForm.my_time = data.encrypted;
                $('input[name="my_time"]').val(data.encrypted);
            }).error(function (data, status) {
                console.log('error', data, status);
            });
        }
    };

</script>