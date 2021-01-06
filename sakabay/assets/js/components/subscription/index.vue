<template>
  <div class="container skb-body">
    <div v-if="loading">
      <div class="loader-container-full">
        <div class="loader" />
      </div>
    </div>

    <div
      v-else
      class="row"
    >
      <b-card-group deck>
        <b-card
          v-for="(subscription , index) in subscriptions "
          :key="'subscription_'+index"
          :title="subscription.name"
          img-src="build/premium.jpg"
          img-alt="Image"
          img-top
        >
          <b-card-text v-if="subscription.name.toLowerCase() == 'premium'">
            {{ $t('subscription.detailsPremium') }}
          </b-card-text>
          <b-card-text v-if="subscription.name.toLowerCase() == 'pro'">
            {{ $t('subscription.detailsPro') }}
          </b-card-text>
          <b-card-text v-if="subscription.name.toLowerCase() == 'free'">
            {{ $t('subscription.detailsFree') }}
          </b-card-text>
          <b-button
            variant="primary"
            :href="'subscription/'+subscription.name.toLowerCase()"
          >
            Follow
          </b-button>
        </b-card>

        <!-- <b-card
          title="PROFESSIONEL"
          img-src="build/professionel.jpg"
          img-alt="Image"
          img-top
        >
          <b-card-text>
            This card has supporting text below as a natural lead-in to additional content.
          </b-card-text>
          <template #footer>
            <b-button
              href="#"
              variant="primary"
            >
              Follow
            </b-button>
          </template>
        </b-card>

        <b-card
          title="FREE"
          img-src="build/gratuite.jpg"
          img-alt="Image"
          img-top
        >
          <b-card-text>
            This is a wider card with supporting text below as a natural lead-in to additional content.
            This card has even longer content than the first to show that equal height action.
          </b-card-text>
          <template #footer>
            <b-button
              href="#"
              variant="primary"
            >
              Follow
            </b-button>
          </template>
        </b-card> -->
      </b-card-group>
    </div>
  </div>
</template>

<script>

import axios from 'axios';

export default {
  props: {

    subscriptionId: {
      type: Number,
      default: null
    },
  },
  data () {

    return {
      loading: true,
      subscriptions: [],
      currentName: null,
    };
  },
  created () {
    this.getAllSubscriptions();

  }, methods: {
    getAllSubscriptions () {
      this.loading = true;
      return axios.get('/api/subscribes')
        .then(response => {

          this.subscriptions = response.data;
          console.log(response.data);
          this.loading = false;
        }).catch(error => {
          this.$handleError(error);
          this.loading = false;
        });

    },
  },
};
</script>


<style>
</style>
