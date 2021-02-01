<template>
  <div>
    <details-card :company="company" />
    <description-card
      v-if="company.description_clean"
      :is-subscription-active="isSubscriptionActive"
      :company="company"
    />
  </div>
</template>
<script>
  import DetailsCard from './details-card';
  import DescriptionCard from './description-card';

  export default {
    components: {
      DetailsCard,
      DescriptionCard
    },
    props: {
      company: {
        type: Object,
        default: null
      },
      isSubscriptionActive: {
        type: Boolean,
        default: false
      }
    }

  };
</script>
