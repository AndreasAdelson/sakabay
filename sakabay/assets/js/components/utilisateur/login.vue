<template>
<div></div>
</template>

<script>

import axios from 'axios';
import _ from 'lodash';
import setAreaHeightMixin from 'mixins/setAreaHeightMixin';
export default {
    data() {
      return {
        form: {
        },
        // show: true
      }
    },
    mixins: [
    setAreaHeightMixin,
    ],
    methods: {
      onSubmit() {
        return axios.post("/api/login", this.form)
        .then(response => {
          console.log(response.data);
        });
      },
    }
}
</script>>
