export default {
  data() {
    return {
      table: {
        filter: '',
        isBusy: false,
        sortDesc: false
      },
      pager: {
        currentPage: 1,
        perPage: 10,
        pageOptions: [10, 50, 100],
        totalRows: 0
      }
    };
  },

  methods: {
    applyFilter: function () {
      if (this.table.filter !== this.currentFilter) {
        this.pager.currentPage = 1;
      }
      this.table.filter = this.currentFilter;
    },
  },
};
