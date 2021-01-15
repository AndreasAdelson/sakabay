<template>
  <div>
    <details-card :company="company" />
    <description-card
      v-if="company.description"
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
      }
    }

  };
</script>
