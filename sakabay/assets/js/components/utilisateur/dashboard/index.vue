<template>
  <div class="container-fluid skb-body px-5">
    <div class="row py-3">
      <div class="col-3">
        <h1 class="fontPoppins fontSize20 dashboard-title">
          {{ $t('dashboard.title') }}
        </h1>
        <i class="fas fa-home grey-skb fontSize20" />
      </div>
    </div>
    <!-- Notifications center -->
    <div class="row notifications-card border mb-4">
      <div class="col-12">
        <div class="row mb-3">
          <div class="col-3 pt-3 pl-4">
            <h2 class="fontPoppins fontSize16 notification-title mt-2">
              {{ $t('dashboard.recent_activity') }}
            </h2>
            <span class="fontPoppins fontSize12 py-1 px-2 orange-gradiant white-skb rounded">{{ numberUnseen }}</span>
            <!-- <i class="fas fa-history orange-skb fontSize20"></i> -->
          </div>
        </div>
        <div class="row notification-scroll">
          <div class="col-12">
            <ul class="notification-item">
              <notification-item
                v-for="(notif, index) in notifications"
                :key="notif.id"
                :notif="notif"
                @notification-marked="onNotificationMarked(index)"
              />
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Buttons rows -->
    <div
      v-if="true"
      class="row mb-3"
    >
      <!-- Company button -->
      <div class="col-2">
        <link-item
          icon-label="far fa-building"
          :button-text="$tc('dashboard.link.n_company', 1)"
          class-color="blue-gradiant"
        />
      </div>
      <!-- Subscribtion button -->
      <div class="col-2">
        <link-item
          icon-label="fas fa-crown"
          :button-text="$t('dashboard.link.subscription')"
          class-color="yellow-gradiant"
        />
      </div>
      <!-- Recruit button -->
      <div class="col-2">
        <link-item
          icon-label="fas fa-paste"
          :button-text="$t('dashboard.link.recruit')"
          class-color="orange-gradiant"
        />
      </div>
      <!-- Opportunity button -->
      <div class="col-2">
        <link-item
          icon-label="far fa-copy"
          :button-text="$t('dashboard.link.opportunity')"
          class-color="green-gradiant"
        />
      </div>
      <!-- CV & LM button -->
      <div class="col-2">
        <link-item
          icon-label="fas fa-edit"
          :button-text="$t('dashboard.link.nomination')"
          class-color="yellow-gradiant"
        />
      </div>
      <!-- Nomination button -->
      <div class="col-2">
        <link-item
          icon-label="far fa-folder-open"
          :button-text="$t('dashboard.link.papers')"
          class-color="blue-gradiant"
        />
      </div>
    </div>
    <div
      v-if="false"
      class="row mb-3"
    >
      <!-- CV & LM button -->
      <div class="col-2">
        <link-item
          icon-label="fas fa-edit"
          :button-text="$t('dashboard.link.nomination')"
          class-color="yellow-gradiant"
        />
      </div>
      <!-- Nomination button -->
      <div class="col-2">
        <link-item
          icon-label="far fa-folder-open"
          :button-text="$t('dashboard.link.papers')"
          class-color="blue-gradiant"
        />
      </div>
    </div>
  </div>
</template>
<script>
  import axios from 'axios';
  import LinkItem from './link-item.vue';
  import NotificationItem from './notification-item.vue';
  import _ from 'lodash';

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
    data() {
      return {
        notifications: [
        ]
      };
    },
    computed: {
      numberUnseen() {
        let unseen = 0;
        this.notifications.forEach(notif => {
          if (!notif.seen) {
            unseen += 1;
          }
        });
        return unseen;
      }
    },
    created() {
      this.getNotifications();
    },
    methods: {
      getNotifications() {
        return axios.get('/notification/all/' + this.utilisateurId)
          .then(response => {
            console.log(response);
            this.notifications = response.data;
          }).catch(e => {
            this.$handleError(e);
          });
      },
      onNotificationMarked(index) {
        return this.notifications[index].seen = true;
      },

      sortNotifications() {
        this.notifications.sort(function(a, b) {
          return a.notification.date - b.notification.date;
        });
      }
    },
  };
</script>
