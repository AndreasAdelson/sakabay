import _ from 'lodash';

export default {
  data() {
    return {

    }
  },
  methods: {
    setFilter() {
      let sentFilter = _.cloneDeep(this.filters);
      Object.keys(sentFilter).forEach(key => {
        if (sentFilter[key] instanceof Array && sentFilter[key].length && _.get(sentFilter[key][0], 'id') !== undefined) {
          sentFilter[key] = _.map(sentFilter[key], 'id');
        }
        if (sentFilter[key] instanceof Object && sentFilter[key].id !== undefined) {
          sentFilter[key] = sentFilter[key].id;
        }
      });
      return sentFilter;
    }
  },
}
