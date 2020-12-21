<template>
  <li
    class="row align-items-center py-3"
  >
    <div class="col-9">
      <span class="fontPoppins fontSize14">{{ notification.message }}</span>
    </div>
    <div class="col-1">
      <span class="fontPoppins fontSize14">{{ notification.date }}</span>
    </div>
    <div class="col-2">
      <span class="fontPoppins fontSize14">{{ notification.date }}</span>
    </div>
  </li>
</template>
<script>
export default {
  props: {
    notification: {
      type: Object,
      default: null
    },
  },
  data () {
    return {
    }
  },
}
</script>
