<template>
  <div>
    <div>
      <navbar></navbar>
      <carousel></carousel>
    </div>

    <b-input-group
      size="sm"
      class="mb-2"
    >
      <b-input-group-prepend is-text>
        <b-icon icon="search"></b-icon>
      </b-input-group-prepend>
      <b-form-input
        type="search"
        placeholder="Search terms"
      ></b-form-input>
    </b-input-group>
    <b-input-group class="mb-2">
      <b-input-group-prepend is-text>
        <b-icon icon="tag-fill"></b-icon>
      </b-input-group-prepend>
      <b-form-tags
        separator=" ,;"
        tag-variant="primary"
        placeholder="Enter new tags separated by space, comma or semicolon"
        no-add-on-enter
      ></b-form-tags>
    </b-input-group>
    <b-input-group class="mb-2">
      <b-input-group-prepend is-text>
        <b-icon icon="person-fill"></b-icon>
      </b-input-group-prepend>
      <b-form-input
        type="text"
        placeholder="User ID"
      ></b-form-input>
    </b-input-group>
    <b-input-group size="lg">
      <b-input-group-prepend is-text>
        <b-icon icon="envelope"></b-icon>
      </b-input-group-prepend>
      <b-form-input
        type="email"
        placeholder="me@example.com"
      ></b-form-input>
    </b-input-group>
  </div>
</template>


<script>
import carousel from './carousel'
import Navbar from './navbar'
export default {
  components: {
    carousel, Navbar,
  },
  data () {
    return {
      slide: 0,
      sliding: null
    }
  },
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
