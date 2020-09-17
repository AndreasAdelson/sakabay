<template>
  <div class="skb-body container ">
    <div v-if="loading">
    </div>
    <div v-else>
      <div
        v-if="canEdit"
        class="row mt-3 "
      >
        <div class="col-2 offset-10 justify-content-end">
          <a
            class="float-right"
            :href="'/admin/group/edit/' + groupId"
          >
            <b-button class="button_skb">{{ this.$t('commons.edit') }}</b-button>
          </a>
        </div>
      </div>
      <a href="/admin/group">
        <button
          :title="$t('commons.go_back')"
          type="button"
          class="w-40px mt-4 p-0 rounded-circle btn-close btn"
        >
          <i class="fas fa-times "></i>
        </button>
      </a>
      <div class="register-card mt-3 w-100 h-100">

        <div class="row">
          <div class="col-6">
            <span class="fontPatua fontSize20">{{ $t('group.fields.name') }}</span>
          </div>
          <div class="col-6">
            <span class="fontPatua fontSize20">{{ $t('group.fields.code') }}</span>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-6">
            <span class="fontHelveticaOblique fontSize18">{{ this.group.name.toUpperCase() }}</span>
          </div>
          <div class="col-6">
            <span class="fontHelveticaOblique fontSize18">{{ this.group.code }}</span>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <span class="fontPatua fontSize20">{{ $t('group.fields.roles') }}</span>
          </div>
          <div class="col-6">
            <span class="fontPatua fontSize20">{{ $t('group.fields.utilisateurs') }}</span>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-6">
            <ul>
              <li
                v-for="(role, index) in group.roles"
                :key="'role_'+ index"
                class="fontHelveticaOblique fontSize18"
              >
                {{ role.name }}
              </li>
            </ul>
          </div>
          <div class="col-6">
            <ul>
              <li
                v-for="(utilisateur, index) in group.utilisateurs"
                :key="'utilisateur_'+ index"
                class="fontHelveticaOblique fontSize18"
              >
                {{ utilisateur.last_name.toUpperCase() + ' ' + utilisateur.first_name + ' ' + ' [' + utilisateur.login + ']' }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>
<script>
import axios from 'axios';

export default {
  props: {
    groupId: {
      type: Number,
      default: null
    },
    canEdit: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {
      group: null,
      loading: false
    }
  },
  async created () {
    if (this.groupId) {
      this.loading = true;
      return axios.get('/api/admin/groups/' + this.groupId)
        .then(response => {
          this.group = response.data;
          this.loading = false;
        }).catch(error => {
          console.log(error);
        });
    }
  },
  methods: {

  },
}
</script>>
