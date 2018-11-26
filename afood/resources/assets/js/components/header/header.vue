<template>
  <div class="header">
  <div class="title">
    <div class="right">用户{{data.phone}}欢迎您</div>
  </div>
  <div class="block">
     <slider :pages="pages" :sliderinit="sliderinit">
    <!-- slot  -->
  </slider>
  </div>
  </div>

</template>
<script>
import slider from 'vue-concise-slider'// 引入slider组件
  export default {
    props: {
      seller: {
        type: Object
      }
    },
    data() {
      return {
        data:{},
         pages:[
          {
            title: '',
            style:{
             background:'url(./1.png)'
            }
          },
          {
           title: '',
           style:{
            background:'url(./2.png)'
            }
          },
          {
            title: 'slide3',
            style:{
              background:'url(./3.png)'
            },
          }
        ],
        //滑动配置[obj]
        sliderinit: {
          currentPage: 0,//当前页码
          thresholdDistance: 500,//滑动判定距离
          thresholdTime: 100,//滑动判定时间
          autoplay:3000,//自动滚动[ms]
          loop:true,//循环滚动
          direction:'horizontal',//方向设置，垂直滚动
          infinite:1,//无限滚动前后遍历数
          slidesToScroll:1,//每次滑动项数
        }
      }
    },
     components: {
        slider
    },
    methods: {
    },
    created() {
      this.$http.get('/afood/api/user').then((res) =>{
              this.data=res.data;
            
      })
    }
  };
</script>
<style lang="scss" rel="stylesheet/scss">
  @import "../../common/sass/mixin";
  .header {
    position: relative;
    color: black;
    background: white;
    height:160px;
  }
  .title{
    font-size:14px;
    background:white;
    height:15px;
     margin-top:2px;
    .left{
      float:left;
      margin-left:4px;
    }
    .right{
      float:right;
       margin-right:4px;
    }
  }
   .el-carousel__item h3 {
    color: #475669;
    font-size: 14px;
    opacity: 0.75;
    line-height: 150px;
    margin: 0;
  }

.block{height:150px;}

</style>
