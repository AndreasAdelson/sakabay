export default {
  data() {
    return {
      // bodyMainHeight: 0,
    };
  },

  mounted() {
    this.$nextTick(function () {
      window.addEventListener('resize', () => this.$setAreaHeight());
      this.$setAreaHeight();
      console.log('fait');
    });
  },
};
