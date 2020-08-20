<template>
  <b-container
    fluid
    class="p-4"
  >
    <b-row>
      <b-col>
        <b-img
          :src="images.default"
          center
          alt="Center image"
        ></b-img>
        <p>toto</p>
        <h1>Sakabay</h1>

        <!-- <img :src="images.logo" alt="logo"> -->
      </b-col>
    </b-row>
  </b-container>
</template>


<script>
import setAreaHeightMixin from 'mixins/setAreaHeightMixin';
export default {
  data () {
    return {
      images: require('../../../pictures/logo.png')
    }
  },
  components: {

  },
  mixins: [
    setAreaHeightMixin,
  ],
  methods: {
    onSlideStart (slide) {
      this.sliding = true
    },
    onSlideEnd (slide) {
      this.sliding = false
    }
  }
}
</script>
