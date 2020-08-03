export default {
  data() {
    return {
      // bodyMainHeight: 0,
    };
  },

  mounted() {
    this.$setAreaHeight();
    this.$nextTick(function () {
      window.addEventListener('resize', () => this.$setAreaHeight());
      this.$setAreaHeight();
    });
  },
};
