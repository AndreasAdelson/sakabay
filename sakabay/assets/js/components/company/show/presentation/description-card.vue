<template>
  <div class="row mt-3 ">
    <div class="col-6 card-skb">
      <div class="title-card-skb">
        <i class="fas fa-file-alt fa-lg yellow-login-skb" />
        <span class="fontPoppins underline">{{ $t('company.presentation.description') }}</span>
      </div>
      <div class="details-card">
        <p class="fontAlice fontSize18">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
      </div>
    </div>
    <div class="col-4" />
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
