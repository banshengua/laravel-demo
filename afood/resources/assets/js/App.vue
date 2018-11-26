<template>
  <div>
    <v-header></v-header>
    <div class="tab border-1px">
      <div class="tab-item">
        <router-link to="/goods">食品列表</router-link>
      </div>
    </div>
    <keep-alive>
      <router-view :seller="seller" ref="food"></router-view>
    </keep-alive>
  </div>
</template>
<script>
    import header from './components/header/header.vue';
    const ERR_OK = 0;
    export default {
        // header数据
        data () {
          return {
            seller: {},
          };
        },
        created() {
            
        },
        components: {
            'v-header': header
        }
    };
</script>

<style lang="scss" rel="stylesheet/scss">
  @import './common/sass/mixin';
  .tab {
    width: 100%;
    display: flex;
    height: 40px;
    line-height: 40px;
    @include border-1px(rgba(7, 17, 27, 0.1));
    > .tab-item {
      flex: 1;
      text-align: center;
      & > a{
        display: block;
        font-size: 14px;
        color: rgb(77, 85, 93);
        &.active{
          border-bottom: 1px solid red;
        }
      }
    }
  }
</style> 
