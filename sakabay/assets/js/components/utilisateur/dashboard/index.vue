<template>
  <div class="container-fluid skb-body px-5">
    <div class="row py-3">
      <div class="col-3">
        <h1 class="fontPoppins fontSize20 dashboard-title">{{ $t('dashboard.title') }}</h1>
        <i class="fas fa-home grey-skb fontSize20"></i>
      </div>
    </div>
    <!-- Notifications center -->
    <div class="row notifications-card border mb-4">
      <div class="col-12">
        <div class="row mb-3">
          <div class="col-3 pt-3 pl-4">
            <h2 class="fontPoppins fontSize16 notification-title mt-2">{{ $t('dashboard.recent_activity') }}</h2>
            <i class="fas fa-history orange-skb fontSize20"></i>
          </div>
        </div>
        <div class="row notification-scroll">
          <div class="col-12">
            <ul class="notification-item">
              <notification-item
                v-for="(notification, index) in notifications"
                :key="'notification_' + index"
                :notification="notification"
              ></notification-item>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Buttons rows -->
    <div
      class="row mb-3"
      v-if="true"
    >
      <!-- Company button -->
      <div class="col-2">
        <link-item
          iconLabel="far fa-building"
          :buttonText="$tc('dashboard.link.n_company', 1)"
          classColor="blue-gradiant"
        ></link-item>
      </div>
      <!-- Subscribtion button -->
      <div class="col-2">
        <link-item
          iconLabel="fas fa-crown"
          :buttonText="$t('dashboard.link.subscription')"
          classColor="yellow-gradiant"
        ></link-item>
      </div>
      <!-- Recruit button -->
      <div class="col-2">
        <link-item
          iconLabel="fas fa-paste"
          :buttonText="$t('dashboard.link.recruit')"
          classColor="orange-gradiant"
        ></link-item>
      </div>
      <!-- Opportunity button -->
      <div class="col-2">
        <link-item
          iconLabel="far fa-copy"
          :buttonText="$t('dashboard.link.opportunity')"
          classColor="green-gradiant"
        ></link-item>
      </div>
      <!-- CV & LM button -->
      <div class="col-2">
        <link-item
          iconLabel="fas fa-edit"
          :buttonText="$t('dashboard.link.nomination')"
          classColor="yellow-gradiant"
        ></link-item>
      </div>
      <!-- Nomination button -->
      <div class="col-2">
        <link-item
          iconLabel="far fa-folder-open"
          :buttonText="$t('dashboard.link.papers')"
          classColor="blue-gradiant"
        ></link-item>
      </div>
    </div>
    <div
      class="row mb-3"
      v-if="false"
    >
      <!-- CV & LM button -->
      <div class="col-2">
        <link-item
          iconLabel="fas fa-edit"
          :buttonText="$t('dashboard.link.nomination')"
          classColor="yellow-gradiant"
        ></link-item>
      </div>
      <!-- Nomination button -->
      <div class="col-2">
        <link-item
          iconLabel="far fa-folder-open"
          :buttonText="$t('dashboard.link.papers')"
          classColor="blue-gradiant"
        ></link-item>
      </div>
    </div>
  </div>
</template>
<script>
import LinkItem from './link-item.vue';
import NotificationItem from './notification-item.vue';

export default {
  components: {
    LinkItem,
    NotificationItem
  },
  props:
  {
    utilisateurId: {
      type: Number,
      default: null
    }
  },
  data () {
    return {
      notifications: [
        { message: "Une nouvelle inscription vient d'être réalisée", date: "23/12/20200 000 00" },
        { message: "Une nouvelle inscription vient d'être réalisée", date: "23/12/2020 000 00" },
        { message: "Une nouvelle inscription vient d'être réalisée", date: "23/12/2020 000 00" },
        { message: "Une nouvelle inscription vient d'être réalisée", date: "23/12/2020 000 00" },
        { message: "Une nouvelle inscription vient d'être réalisée", date: "23/12/2020 000 00" },
        { message: "Une nouvelle inscription vient d'être réalisée", date: "23/12/2020 000 00" },
        { message: "Une nouvelle inscription vient d'être réalisée", date: "23/12/2020 00 00" }
      ]
    }
  },
}
</script>
