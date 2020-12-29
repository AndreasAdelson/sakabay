<template>
  <li class="row align-items-center notification-item">
    <div
      class="col-11"
    >
      <div
        :class="notif.seen ? '' : 'orange-skb'"
        class="row align-items-center py-3 "
      >
        <div class="col-9">
          <a
            href="#"
            class="fontPoppins fontSize14"
            @click.prevent="goToNotificationSubject()"
          >{{ notif.notification.message }}</a>
        </div>
        <div class="col-2">
          <span class="fontPoppins fontSize14">{{ notificationDate }}</span>
        </div>
      </div>
    </div>
    <a
      v-if="!notif.seen"
      class="col-1 text-center badge badge-complete"
      href="#"
      @click.prevent="markAsSeen()"
    >
      <i class="fas fa-check" />
    </a>
  </li>
</template>
<script>
  import axios from 'axios';
  import moment from 'moment';
  export default {
    props: {
      notif: {
        type: Object,
        default: null
      }
    },
    data() {
      return {
      };
    },
    computed: {
      notificationDate() {
        let actualDate = moment(this.notif.notification.date, 'YYYY-MM-DD H:m:s').format('DD/MM/YYYY H:m:ss');
        if (moment().diff(moment(this.notif.notification.date), 'days') >  7) {
          return 'le ' + moment(this.notif.notification.date, 'YYYY-MM-DD H:m:s').format('D MMMM, H:m');
        }
        else {
          return moment(actualDate, 'DD/MM/YYYY H:m:ss').fromNow();
        }
      },
    },
    created() {

    },
    methods: {
      /**
       * Marks the notification as read asynchronously.
       * Immediately followed by a redirection to the subject of the notification. No further handling required.
       */
      goToNotificationSubject() {
        window.location.assign(this.notif.notification.link);
      // this.markAsSeen();
      },

      markAsSeen() {
        return axios.post('/notification/' + this.notif.notifiable.id + '/mark_as_seen/' + this.notif.notification.id)
          .then(r => {
            this.$emit('notification-marked', this.notif.notification.id);
          })
          .catch(e => {
            this.$handleError(e);
          });
      },
    },
  };
</script>
