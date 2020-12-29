<template>
  <div class="skb-body container-fluid p-4">
    <!-- Content -->
    <div class="row py-3">
      <div class="col-3">
        <h1 class="fontPoppins fontSize20 dashboard-title">
          {{ $t('dashboard.title') }}
        </h1>
        <i class="fas fa-home grey-skb fontSize20" />
      </div>
    </div>
    <div class="row">
      <div class="col-3">
        <link-item
          icon-label="fas fa-edit"
          button-text="Publiez votre CV"
          class-color="flat-color-1"
          :small-text="false"
        />
      </div>
      <div class="col-3">
        <link-item
          icon-label="fas fa-wrench"
          button-text="Modifier mes informations personnelles"
          class-color="flat-color-2"
          :small-text="true"
        />
      </div>
      <div class="col-3">
        <link-item
          icon-label="far fa-eye"
          button-text="Consultez votre CV"
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
        <div class="offset-2 col-8">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="row mb-3">
                    <div class="col-3 pt-3 pl-4">
                      <h4 class="box-title notification-title">
                        {{ $t('dashboard.recent_activity') }}
                      </h4>
                      <span class="fontPoppins fontSize12 py-1 px-2 orange-gradiant white-skb rounded">{{ numberUnseen }}</span>
                    </div>
                  </div>
                  <div class="row notification-scroll">
                    <div class="col-12">
                      <ul class="notification-item ">
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
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-12 mb-4">
      <div class="card-group">
        <div class="card col-md-6 no-padding ">
          <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
              <i class="fa fa-users" />
            </div>

            <div class="h4 mb-0">
              <span class="count">87500</span>
            </div>

            <small class="text-muted text-uppercase font-weight-bold">Visitors</small>
            <div
              class="progress progress-xs mt-3 mb-0 bg-flat-color-1"
              style="width: 40%; height: 5px;"
            />
          </div>
        </div>
        <div class="card col-md-6 no-padding ">
          <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
              <i class="fa fa-user-plus" />
            </div>
            <div class="h4 mb-0">
              <span class="count">385</span>
            </div>
            <small class="text-muted text-uppercase font-weight-bold">New Clients</small>
            <div
              class="progress progress-xs mt-3 mb-0 bg-flat-color-2"
              style="width: 40%; height: 5px;"
            />
          </div>
        </div>
        <div class="card col-md-6 no-padding ">
          <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
              <i class="fa fa-cart-plus" />
            </div>
            <div class="h4 mb-0">
              <span class="count">1238</span>
            </div>
            <small class="text-muted text-uppercase font-weight-bold">Products sold</small>
            <div
              class="progress progress-xs mt-3 mb-0 bg-flat-color-3"
              style="width: 40%; height: 5px;"
            />
          </div>
        </div>
        <div class="card col-md-6 no-padding ">
          <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
              <i class="fa fa-pie-chart" />
            </div>
            <div class="h4 mb-0">
              <span class="count">28</span>%
            </div>
            <small class="text-muted text-uppercase font-weight-bold">Returning Visitors</small>
            <div
              class="progress progress-xs mt-3 mb-0 bg-flat-color-4"
              style="width: 40%; height: 5px;"
            />
          </div>
        </div>
        <div class="card col-md-6 no-padding ">
          <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
              <i class="fa fa-clock-o" />
            </div>
            <div class="h4 mb-0">
              5:34:11
            </div>
            <small class="text-muted text-uppercase font-weight-bold">Avg. Time</small>
            <div
              class="progress progress-xs mt-3 mb-0 bg-flat-color-5"
              style="width: 40%; height: 5px;"
            />
          </div>
        </div>
        <div class="card col-md-6 no-padding ">
          <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
              <i class="fa fa-comments-o" />
            </div>
            <div class="h4 mb-0">
              <span class="count">972</span>
            </div>
            <small class="text-muted text-uppercase font-weight-bold">COMMENTS</small>
            <div
              class="progress progress-xs mt-3 mb-0 bg-flat-color-1"
              style="width: 40%; height: 5px;"
            />
          </div>
        </div>
      </div>
    </div>
    <!-- <poubelle /> -->
  </div>
</template>
<script>
  import LinkItem from './link-item.vue';
  import Poubelle from './poubelle.vue';
  import NotificationItem from './notification-item.vue';
  import axios from 'axios';
  export default {
    components: {
      LinkItem,
      Poubelle,
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
