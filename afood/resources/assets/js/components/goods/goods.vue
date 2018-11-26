<template>
  <div class="goods">
    <div class="menu-warpper" ref=menuWarpper>
      <ul style="list-style:none;">
        <li v-for="(item,$index) in goods"   class="menu-item"   :class="{'current':currentIndex===$index}"
            @click="selectMenu($index,$event)">
          <span class="text border-1px" >
            <span v-show="item.type>0" class="icon" :class="classMap[item.cate_type]"></span>{{item.cate_name}}
          </span>
        </li>
      </ul>
    </div>
    <div class="foods-warpper" ref=foodsWarpper>
      <ul style="list-style:none;">
        <li v-for='item in goods'   class="food-list food-list-hook">
          <h1 class="title" v-show="item.name">{{item.name}}</h1>
          <ul>
            <li v-for="food in item.foods" class="food-item border-1px" @click="selectFood(food,$event)"  v-show="food.surplus">
              <div class="icon">
                <img height="57px" width="57px" :src="food.img">
              </div>
              <div class="content">
                <h2 class="name">{{food.name}}</h2>
                <p class="desc"></p>
                <div class="extra">
                  <span class="count">月售{{food.sellcount}}份</span><span>剩余{{food.surplus}}份</span>
                </div>
                <div class="price">
                  <span class="now">￥{{food.price}}</span>
                </div>
                <div class="cart-controlwrapper">
                  <cartcontrol :food="food"></cartcontrol>
                </div>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <shopcart ref="shopcart" :select-foods="selectFoods" :delivery-price="seller.deliveryPrice"
              :min-price="seller.minPrice" :openid="openid"></shopcart>
  </div>
</template>
<script type='text/ecmascript-6'>
  import BScroll from "better-scroll";
  import shopcart from "../shopcart/shopcart";
  import cartcontrol from '../cartcontrol/cartcontrol';
  const ERR_OK = 0;
  export default {
    props: {
      seller: {
        type: Object
      }
    },
    data() {
      return {
        openid:"",
        goods: [],
        listHeight: [],
        scrollY: 0,
        selectedFood: {},
        classMap:['decrease_3','discount_3','guarantee_3','invoice_3','special_3']
      };
    },
    created() {
      this.$http.get("/afood/api/good").then((response) => {
         this.$http.get("/afood/api/user").then((response) => {
                this.openid=response.data['phone'];
                if(response.data['status']==0){
                   alert("客官货物不足，请补货!")
                   window.location.href="/afood/good#/supply" 
                }
           })
        let data = response.data;
          this.goods = data;
          
          this.$nextTick(() => {
            this._initScroll();
             this._calculateHeight();
          });
       
      });
      this.$root.eventHub.$on('cartAdd', (target) => {
        this.cartAdd(target);
      });

    },
    methods: {
      selectMenu(index, event) {
        if (!event._constructed) {
          return;
        }
        let foodList = this.$refs.foodsWarpper.getElementsByClassName("food-list-hook");
        let el = foodList[index];
        this.foodsScroll.scrollToElement(el, 300);
      },
      selectFood(food, event) {
        if (!event._constructed) {
          return;
        }
        this.selectedFood = food;
        this.$refs.food.show();
      },
      _initScroll() {
        this.menuScroll = new BScroll(this.$refs.menuWarpper, {
          click: true
        });
        this.foodsScroll = new BScroll(this.$refs.foodsWarpper, {
          click: true,
          probeType: 3
        });

        this.foodsScroll.on("scroll", (pos) => {
          this.scrollY = Math.abs(Math.round(pos.y));
        });
      },
      _calculateHeight() {
        let foodList = this.$refs.foodsWarpper.getElementsByClassName("food-list-hook");
        let height = 0;
        this.listHeight.push(height);
        for (let i = 0; i < foodList.length; i++) {
          let item = foodList[i];
          height += item.clientHeight;
          this.listHeight.push(height);
        }
      },
      cartAdd(target) {
        // 体验优化,异步执行下落动画
        this.$nextTick(() => {
          this.$refs.shopcart.drop(target);
        });
      }
    },
    computed: {
      currentIndex() {
        for (let i = 0; i < this.listHeight.length; i++) {
          let height1 = this.listHeight[i];
          let height2 = this.listHeight[i + 1];
          if (!height2 || this.scrollY >= height1 && this.scrollY < height2) {
            return i;
          }
        }
        return 0;
      },
      selectFoods() {
        let foods = [];
        this.goods.forEach((good) => {
          good.foods.forEach((food) => {
            if (food.count) {
              foods.push(food);
            }
          });
        });
        return foods;
      }
    },
    components: {
      shopcart,
      cartcontrol
    }
  };
</script>
<style lang="scss" rel="stylesheet/scss">
  @import "../../common/sass/mixin";

  .goods {
    display: flex;
    position: absolute;
    top: 210px;
    bottom: 46px;
    width: 100%;
    overflow: hidden;
    .menu-warpper {
      flex: 0 0 80px;
      width: 80px;
      background: #f3f5f7;
      .menu-item {
        display: table;
        height: 54px;
        width: 56px;
        padding: 0 12px;
        line-height: 14px;
        &.current {
          position: relative;
          margin-top: -1px;
          z-index: 10;
          background: #fff;
          font-weight: 700;
          .text {
            @include boder-none();
          }
        }
        .icon {
          vertical-align: top;
          display: inline-block;
          width: 12px;
          height: 12px;
          margin-right: 2px;
          background-size: 12px 12px;
          background-repeat: no-repeat;
          &.decrease {
            @include bg-img("decrease_3")
          }
          &.discount {
            @include bg-img("discount_3")
          }
          &.guarantee {
            @include bg-img("guarantee_3")
          }
          &.invoice {
            @include bg-img("invoice_3")
          }
          &.special {
            @include bg-img("special_3")
          }
        }
        .text {
          display: table-cell;
          width: 56px;
          vertical-align: middle;
          @include border-1px(rgba(7, 17, 27, 0.1));
          font-size: 12px;
        }
      }
    }
    .foods-warpper {
      flex: 1;
      .title {
        padding-left: 14px;
        height: 26px;
        line-height: 26px;
        border-left: 1px solid #d9dde1;
        font-size: 12px;
        color: rgb(147, 153, 159);
        background: #f3f5f7;
      }
      .food-item {
        display: flex;
        margin: 18px;
        padding-bottom: 18px;
        @include border-1px(rgba(7, 17, 27, 0.1));
        &:last-child {
          @include boder-none();
          margin-bottom: 0;
        }
        .icon {
          flex: 0 0 57px;
          margin-right: 10px;
        }
        .content {
          flex: 1;
          .name {
            margin: 2px 0 8px 0;
            line-height: 14px;
            font-size: 14px;
            color: rgb(7, 17, 27);
          }
          .desc, .extra {
            line-height: 10px;
            font-size: 10px;
            color: rgb(147, 153, 159);
          }
          .desc {
            line-height: 12px;
            margin-bottom: 8px;
          }
          .extra {
            line-height: 10px;
            .count {
              margin-right: 12px;
            }
          }
          .price {
            font-weight: 700;
            line-height: 24px;
            .now {
              margin-right: 8px;
              font-size: 14px;
              color: rgb(240, 20, 20);
            }
            .old {
              text-decoration: line-through;
              font-size: 10px;
              color: rgb(147, 153, 159);
            }
          }
          .cart-controlwrapper {
            position: absolute;
            right: 0;
            bottom: 12px;
          }
        }
      }
    }
  }
</style>
