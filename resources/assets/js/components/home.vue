<style lang="stylus"></style>

<template>
    <div class="col-md-8">
        <h1>New Zealand Hosts</h1>

        <p v-show="hosts.length==0">Hosts loading...</p>

        <div class="panel panel-default" v-for="host in hosts">
            <div class="panel-heading"><a v-link="{ name: 'host', params: { hostID: host.id }}">{{ host.name }}</a>
            </div>
            <div class="panel-body">
                {{ host.description }}
            </div>
        </div>

        <ul class="pager">
            <li class="previous" v-show="pagination.previous">
                <a class="page-scroll" @click="fetchHostsPaginate('previous')" href="#">Previous</a>
            </li>
            <li class="next" v-show="pagination.next">
                <a class="page-scroll" @click="fetchHostsPaginate('next')" href="#">Next</a>
            </li>
        </ul>

    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                hosts: [],
                pagination: {
                    page: 1,
                    previous: false,
                    next: false
                }
            };
        },
        methods: {
            fetchHostsPaginate: function (direction) {
                if (direction === 'previous') {
                    --this.pagination.page;
                }
                else if (direction === 'next') {
                    ++this.pagination.page;
                }

                this.$http.get('hosts?page=' + this.pagination.page, [], function (data, status, request) {
                    this.hosts = data.data;
                    this.pagination.next = data.pagination.next_page_url;
                    this.pagination.previous = data.pagination.prev_page_url;
                }).error(function (data, status, request) {
                    console.log('error', data, status);
                });
            }
        },
        ready: function () {
            this.fetchHostsPaginate();
        }
    };

</script>