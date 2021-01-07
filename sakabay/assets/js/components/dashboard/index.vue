<template>
  <div class="skb-body container-fluid p-4 dashboard">
    <div v-show="!utilisateur">
      <div class="loader-container-full">
        <div class="loader" />
      </div>
    </div>
    <!-- Content -->
    <div class="row py-3">
      <div class="col-3">
        <h1 class="fontPoppins fontSize20 dashboard-title">
          {{ $t('dashboard.title') }}
        </h1>
        <i class="fas fa-home grey-skb fontSize20" />
      </div>
    </div>
    <div
      v-if="utilisateur && utilisateur.company"
      class="row"
    >
      <div class="col-3">
        <link-item
          icon-label="fas fa-edit"
          button-text="Publiez une offre"
          class-color="flat-color-1"
          :small-text="false"
        />
      </div>
      <div class="col-3">
        <link-item
          icon-label="fas fa-wrench"
          button-text="Voir les abonnements"
          class-color="flat-color-2"
          :small-text="true"
          :href="'/subscription'"
        />
      </div>
      <div class="col-3">
        <link-item
          icon-label="far fa-eye"
          button-text="Consultez vos messages"
          class-color="flat-color-3"
          :small-text="true"
        />
      </div>
      <div class="col-3">
        <link-item
          icon-label="fas fa-paste"
          button-text="Récapitulatif"
          class-color="flat-color-4"
          :small-text="true"
        />
      </div>
    </div>
    <!-- Notifications center -->
    <div class="orders">
      <div class="row">
        <div class="mx-auto col-10">
          <div class="card">
            <div class="card-body navigation-menu">
              <div class="row">
                <!-- Gestion affichage information de la carte -->
                <div class="col-2">
                  <ul class="list-unstyled text-center scroll-h300">
                    <!-- Recent Notification bouton -->
                    <vuescroll :ops="opsButton">
                      <a
                        :class="notificationActive ? 'navigation-dashboard-link-active': 'navigation-dashboard-link'"
                        href="#"
                        class="w-90"
                        @click="activeNotification()"
                      >
                        <li>
                          <span class="box-title notification-title">
                            {{ $t('dashboard.recent_activity') }}
                          </span>
                          <span
                            v-if="numberUnseen != 0"
                            class="fontPoppins fontSize12 py-1 px-2 orange-gradiant white-skb rounded"
                          >{{ numberUnseen }}</span>
                        </li>
                      </a>
                      <!-- Subscription History bouton -->
                      <a
                        v-if="utilisateur && utilisateur.company"
                        :class="historyActive ? 'navigation-dashboard-link-active': 'navigation-dashboard-link'"
                        href="#"
                        class="w-90"
                        @click="activeHistory()"
                      >
                        <li>
                          <span class="box-title notification-title">
                            {{ $t('dashboard.susbcription_history') }}
                          </span>
                        </li>
                      </a>
                    </vuescroll>
                  </ul>
                </div>
                <div class="col-10">
                  <!-- Notifications List -->
                  <div
                    v-if="notificationActive"
                    class="row scroll-h300"
                  >
                    <vuescroll>
                      <div class="col-12">
                        <ul class="notification-item mb-0">
                          <notification-item
                            v-for="(notif, index) in notifications"
                            :key="notif.id"
                            :notif="notif"
                            @notification-seen="onNotificationSeen(index)"
                            @notification-unseen="onNotificationUnSeen(index)"
                            @notification-deleted="onNotificationDeleted(index)"
                          />
                        </ul>
                      </div>
                    </vuescroll>
                  </div>
                  <!-- History SUbscription List -->
                  <div
                    v-else-if="historyActive && utilisateur && utilisateur.company"
                    class="row scroll-h300"
                  >
                    <vuescroll>
                      <div class="col-12">
                        <history-item :company-subscriptions="companySubscriptions" />
                      </div>
                    </vuescroll>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Info line -->
    <div class="row">
      <div class="col-sm-12 mb-4">
        <div class="card-group">
          <info-item
            title="87500"
            sub-title="Visitors"
            icon-class="fa fa-users"
            color-class="bg-flat-color-1"
          />
          <info-item
            title="385"
            sub-title="New Clients"
            icon-class="fa fa-user-plus"
            color-class="bg-flat-color-2"
          />
          <info-item
            title="1238"
            sub-title="Products sold"
            icon-class="fa fa-cart-plus"
            color-class="bg-flat-color-3"
          />
          <info-item
            title="28%"
            sub-title="Returning Visitors"
            icon-class="fas fa-undo-alt"
            color-class="bg-flat-color-4"
          />
          <info-item
            title="5:34:11"
            sub-title="Avg. Time"
            icon-class="fa fa-clock"
            color-class="bg-flat-color-5"
          />
          <info-item
            title="973"
            sub-title="COMMENTS"
            icon-class="fa fa-users"
            color-class="bg-flat-color-1"
          />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import LinkItem from './link-item.vue';
  import NotificationItem from './notification-item.vue';
  import HistoryItem from './history-item.vue';
  import InfoItem from './info-item.vue';
  import vuescroll from 'vuescroll';
  import axios from 'axios';
  import _ from 'lodash';

  export default {
    components: {
      LinkItem,
      NotificationItem,
      HistoryItem,
      InfoItem,
      vuescroll
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
        opsButton: {
          bar: {
            keepShow: false,
            minSize: 0.3,
          },
          rail: {
            background: '#c5c9cc',
            opacity: 0.4,
            size: '6px',
            specifyBorderRadius: false,
            gutterOfEnds: '1px',
            gutterOfSide: '2px',
            keepShow: false
          },
        },
        notifications: [
        ],
        utilisateur: null,
        notificationActive: true,
        historyActive: false,
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
      },

      companySubscriptions() {
        let history = _.cloneDeep(this.utilisateur.company.companysubscriptions);

        return  history;
      }
    },
    created() {
      this.getNotifications();
      this.getUser();
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

      onNotificationSeen(index) {
        this.notifications[index].seen = true;
      },

      onNotificationUnSeen(index) {
        this.notifications[index].seen = false;
      },

      onNotificationDeleted(index) {
        this.notifications.splice(index, 1);
      },

      sortNotifications() {
        this.notifications.sort(function(a, b) {
          return a.notification.date - b.notification.date;
        });
      },

      getUser() {
        return axios.get('api/admin/utilisateurs/' + this.utilisateurId, {params: { 'serial_group': 'api_dashboard_utilisateur' }})
          .then(response => {
            console.log(response);
            this.utilisateur = response.data;
          }).catch(e => {
            this.$handleError(e);
          });
      },

      onNotificationMarked(index) {
        return this.notifications[index].seen = true;
      },

      activeNotification() {
        this.notificationActive = true;
        this.historyActive = false;
      },
      activeHistory() {
        this.notificationActive = false;
        this.historyActive = true;
      },
    },
  };
</script>
