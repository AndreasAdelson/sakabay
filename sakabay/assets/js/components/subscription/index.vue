<template>
  <div class="container">
    <div class="row">
      <b-card-group deck>
        <b-card
          v-for="(subscription , index) in subscriptions "
          :key="'subscription_'+index"
          :title="subscription.name"
          img-src="build/premium.jpg"
          img-alt="Image"
          img-top
        >
          <b-card-text>
            This is a wider card with supporting text below as a natural lead-in to additional content.
            This content is a little bit longer.
          </b-card-text>
          <template #footer>
            <b-button
              variant="primary"
              data-toggle="modal"
              :data-target="'#' + CONFIRM_SUBSCRIPTION"
              @click="currentName = subscription.name"
            >
              Follow
            </b-button>
          </template>
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
    <confirm-modal
      :id="CONFIRM_SUBSCRIPTION"
      :title-text="$t('commons.confirm_modal.delete.title')"
      :body-text="$t('commons.confirm_modal.delete.text')"
      :button-yes-text="$t('commons.yes')"
      :button-no-text="$t('commons.no')"
      :are-buttons-on-same-line="true"
      @confirm-modal-yes="confirmSubscription('/subscription/')"
    />
  </div>
</template>

<script>

import axios from 'axios';
import ConfirmModal from 'components/commons/confirm-modal';

export default {
  components: {
    ConfirmModal
  },
  props: {

    subscriptionId: {
      type: Number,
      default: null
    },
  },
  data () {

    return {
      CONFIRM_SUBSCRIPTION: 'confirm_subscription_modal',
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
    confirmSubscription (url) {
      window.location.assign(url + this.currentName.toLowerCase());
    },
  },
};
</script>


<style>
</style>
