<style lang="stylus">
    .alert
        background-color: lightgrey
        border: 1px solid grey
        padding: 1em
        position: relative

    .alert--success
        background-color: lightgreen
        border: 1px solid green

    .alert--error
        background-color: lighten(red, 70%)
        border: 1px solid red

    .alert__close
        position: absolute
        cursor: pointer
        top: 1em
        right: 1em
</style>

<template>
<div :class="alertClass" v-show="show">
      <slot></slot>

      <span class="alert__close" @click="show = false">
        x
      </span>
    </div>
</template>

<script>
export default {
          props: ['type'],
          data: function(){
            return {
              show: true
            };
          },
          computed: {
            alertClass: function(){
              return {
                alert: true,
                'alert--success': this.type == 'success',
                'alert--error': this.type == 'error',
              };
            }
          }
        };
</script>