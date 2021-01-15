<template>
  <div class="row mt-3 ">
    <div class="mx-auto col-8 card-skb">
      <div class="title-card-skb">
        <i class="fas fa-file-alt fa-lg yellow-login-skb" />
        <span class="fontPoppins underline ml-1">{{ $t('company.presentation.description') }}</span>
      </div>
      <div class="details-card">
        <p class="fontAlice fontSize18">
          {{ company.description }}
        </p>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    props: {
      company: {
        type: Object,
        default: null
      }
    }
  };
</script>
