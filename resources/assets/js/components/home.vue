<style lang="stylus"></style>

<template>
    <div class="col-md-8">
        <h1>New Zealand Hosts</h1>

        <p v-show="hosts.length==0">No hosts yet.</p>

        <div class="panel panel-default" v-for="host in hosts">
            <div class="panel-heading"><a v-link="{ name: 'host', params: { hostID: host.id }}">{{ host.name }}</a></div>
            <div class="panel-body">
                {{ host.description }}
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: {
            hosts: {
                sync: true
            }
        }
    };

</script>