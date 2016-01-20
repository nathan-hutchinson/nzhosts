<style lang="stylus"></style>

<template>
    <div class="col-md-8">
        <h1>New Zealand Hosts</h1>

        <p v-show="hosts.length==0">No hosts yet.</p>

    </div>
</template>

<script>
    export default {
        props: {
            hosts: {
                sync: true
            }
        },
        methods: {
            voteFor: function (topic) {
                this.$http.post('topics/' + topic.id + '/votes', [], function (data, status, request) {
                    // New vote
                    if (status == 200) {
                        topic.votes++;
                    }
                    topic.userVotedFor = true;
                }).error(function (data, status, request) {
                    console.log('error', data, status);
                });
            }
        }
    };

</script>