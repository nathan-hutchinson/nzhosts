<style lang="stylus"></style>

<template>
    <div class="col-md-8" v-show="loaded">
        <h1>{{ host.name }}</h1>

        <p>{{ host.description }}</p>

        <p><a v-link="{ path: '/' }">Back to all hosts.</a></p>
    </div>

    <div class="col-md-8" v-show="!loaded">
        Loading...
    </div>
</template>


<script>
    export default {
        data: function() {
            return {
                host: {},
                loaded: false
            };
        },
        ready: function(){
            this.$http.get('hosts/' + this.$route.params.hostID, [], function (data, status, request) {
                this.host = data;
                this.loaded = true;
            }).error(function (data, status, request) {
                console.log('error', data, status);
            });
        }
    };
</script>