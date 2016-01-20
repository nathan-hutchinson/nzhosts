<style lang="stylus"></style>

<template>
    <div class="col-md-8">
        <h1>About NZ Hosts</h1>


    </div>
</template>


<script>
    export default {
        props: {
            hosts: {
                sync: true
            },
            pageTitle: {
                sync: true
            }
        },
        ready: function()
        {
            //this.pageTitle = "About";
        }
    };

</script>