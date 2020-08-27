<template>
  <b-container
    fluid
    class="p-4 skb-body"
  >
    <b-row>
      <b-col>
        <b-img
          :src="images"
          center
          alt="Center image"
        ></b-img>
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
      images: '/build/logo.png'
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
