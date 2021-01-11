<template>
  <div class="w-50">
    <quick-menu
      :menu-count="getCount"
      :icon-class="icons"
      :menu-url-list="list"
      :background-color="backgroundColor"
      :color="color"
      :width="width"
      :height="height"
      :position="position"
      :size="size"
      :style="quickMenuStyle"
      @process="print"
    />
  </div>
</template>

<script>
import quickMenu from 'vue-quick-menu';
export default {
  components: {
    'quickMenu': quickMenu,
  },
  props: {
    // position: {
    //   type: String,
    //   default: 'top-right'
    // }
  },
  data () {
    return {
      count: 3,
      icons: ['icon-login far fa-user', 'icon-user fas fa-user-plus', 'fa fa-envelope',],
      list: [{ 'isLink': false, url: '/login' }, { 'isLink': false, url: '/register' }, { 'isLink': false, url: '/contact' },],
      backgroundColor: '#17c4c5',
      color: '#ffffff',
      position: 'top-right',
      width: '49px',
      height: '49px',
      // isOpenNewTab: true
      size: 40,
    };
  },
  computed: {
    getCount () {
      return Number(this.count);
    },
    getIsOpenNewTab () {
      return Boolean(this.isOpenNewTab);
    },
    quickMenuStyle () {
      const topPosition = { top: '0px' },
        bottomPosition = { bottom: '30px' },
        leftPosition = { left: '0px' },
        rightPosition = { right: '0px' };

      let style = this.isTop ? topPosition : bottomPosition;
      Object.assign(style, this.isLeft ? leftPosition : rightPosition);
      Object.assign(style, { transform: this.isLeft ? 'rotate(-180deg)' : 'rotate(180deg)' });
      return style;
    },
    isTop () {
      return !!~this.position.toLowerCase().indexOf('top');
    },
    isLeft () {
      return !!~this.position.toLowerCase().indexOf('left');
    }
  },
  methods: {
    print (key) {
      if (key === 2) {
        // console.log('please send me an email');
        window.location.href = '/contact';
      }
      if (key === 0) {
        // window.open('https://github.com/AshleyLv/vue-quick-menu');
        window.location.href = '/login';
      }
      if (key === 1) {
        // window.open('https://github.com/AshleyLv/vue-quick-menu');
        window.location.href = '/register';
      }
    }
  }
};
</script>

<style lang="less">
</style>
