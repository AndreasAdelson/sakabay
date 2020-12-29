<template>
  <a
    :href="url"
    class="row dashboard-link align-items-center ml-0"
    :class="classColor"
  >
    <div class="col-12">
      <div class="row">
        <div class="col-12 icon-button">
          <i :class="iconLabel + ' fa-4x'" />
        </div>
      </div>
      <div class="row">
        <div class="col-12 icon-button mt-3">
          <span class="fontSize18 fontPoppins">{{ buttonText }}</span>
        </div>
      </div>
    </div>
  </a>
</template>
<script>
  export default {
    props: {
      url: {
        type: String,
        default: '#'
      },
      iconLabel: {
        type: String,
        default: null
      },
      buttonText: {
        type: String,
        default: null
      },
      classColor: {
        type: String,
        default: null
      }
    },
    data() {
      return {
      };
    },
  };
</script>
