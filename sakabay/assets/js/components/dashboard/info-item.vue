<template>
  <div class="card col-md-6 no-padding ">
    <div class="card-body">
      <div class="h1 text-muted text-right mb-4">
        <i :class="iconClass" />
      </div>

      <div class="h4 mb-0">
        <span class="count">{{ title }}</span>
      </div>

      <small class="text-muted text-uppercase font-weight-bold">{{ subTitle }}</small>
      <div
        class="progress progress-xs mt-3 mb-0"
        :class="colorClass"
        style="width: 40%; height: 5px;"
      />
    </div>
  </div>
</template>
<script>
  export default {
    props: {
      title: {
        type: String,
        default: null
      },
      subTitle: {
        type: String,
        default: null
      },
      iconClass: {
        type: String,
        default: null
      },
      colorClass: {
        type: String,
        default: null
      },
    },
  };
</script>
