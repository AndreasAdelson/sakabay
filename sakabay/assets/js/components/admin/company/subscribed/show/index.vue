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
            :href="'/admin/entreprise/edit/' + companyId"
          >
            <b-button class="button_skb">{{ this.$t('commons.edit') }}</b-button>
          </a>
        </div>
      </div>
      <a href="/admin/entreprise">
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
            <span class="fontPatua fontSize20">{{ $t('company.table.fields.name') }}</span>
          </div>
          <div class="col-6">
            <span class="fontPatua fontSize20">{{ $t('company.table.fields.url_name') }}</span>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-6">
            <span class="fontHelveticaOblique fontSize18">{{ this.company.name }}</span>
          </div>
          <div class="col-6">
            <span class="fontHelveticaOblique fontSize18">{{ this.company.url_name }}</span>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <span class="fontPatua fontSize20">{{ $t('company.table.fields.utilisateur') }}</span>
          </div>
          <div class="col-6">
            <span class="fontPatua fontSize20">{{ $t('company.table.fields.category') }}</span>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-6">
            <a :href="'/admin/utilisateur/show/' + this.company.utilisateur.id">
              <span class="fontHelveticaOblique fontSize18 inscription">{{ this.company.utilisateur.login }}</span>
            </a>
          </div>
          <div class="col-6">
            <span class="fontHelveticaOblique fontSize18">{{ this.company.category.name }}</span>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <span class="fontPatua fontSize20">{{ $t('company.table.fields.statut') }}</span>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-6">
            <span class="fontHelveticaOblique fontSize18">{{ this.company.companystatut.name }}</span>
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
    companyId: {
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
      company: null,
      loading: false
    }
  },
  async created () {
    if (this.companyId) {
      this.loading = true;
      return axios.get('/api/companies/' + this.companyId)
        .then(response => {
          this.company = response.data;
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
