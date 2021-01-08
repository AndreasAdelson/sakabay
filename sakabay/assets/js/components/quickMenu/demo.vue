<template>
  <div>
    <quick-menu
      :menu-count="getCount"
      :icon-class="icons"
      :menu-url-list="list"
      :background-color="backgroundColor"
      :color="color"
      :position="position"
      :is-open-new-tab="getIsOpenNewTab"
      @process="print"
    />
  </div>
</template>

<script>

import quickMenu from 'vue-quick-menu';

export default {
  components: {
    'quickMenu': quickMenu
  },

  data () {
    return {
      name: 'demo',
      count: 4,
      icons: ['fa fa-github', 'fa fa-comment', 'fa fa-code', 'fa fa-envelope'],
      list: [{ 'isLink': false }, { 'isLink': true, url: '/doo' }, { 'isLink': true, url: '/foo' }, { 'isLink': false }],
      backgroundColor: '#17c4c5',
      color: '#ffffff',
      position: 'top-right',
      isOpenNewTab: false

    };
  },
  computed: {
    getCount () {
      return Number(this.count);
    },
    getIsOpenNewTab () {
      return Boolean(this.isOpenNewTab);
    }
  },
  methods: {
    print (key) {
      if (key === 3) {
        console.log('please send me an email');
      }
      if (key === 0) {
        window.open('https://github.com/AshleyLv/vue-quick-menu');

      }
    }
  }
};
</script>

<style>
</style>
