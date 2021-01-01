<template>
  <div class="container">
    <div class="row w-50 px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <div class="card-deck col-md-12">
        <div class="card mb-2 ">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">
              PREMIUM
            </h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">
              30€ <small class="text-muted">/ mois</small>
            </h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>data</li>
              <li>data</li>
              <li>data</li>
              <li>data</li>
            </ul>
            <button
              type="button"
              class="btn btn-lg btn-block btn-primary"
            >
              S'abonner
            </button>
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
    utilisateurId: {
      type: Number,
      default: null
    },
    companyId: {
      type: Number,
      default: null
    },
    subscriptionName: {
      type: String,
      default: null
    },
  },

  data () {

    return {
      subscription: new Object(),
      company: new Array(),
    };
  },
  created () {
    this.getSubcriptionName();
    this.getUtilisateurCompany();
  },
  methods: {
    getSubcriptionName () {
      if (this.subscriptionName) {
        this.loading = true;
        return axios.get('/api/subscribes/' + this.subscriptionName)
          .then(response => {
            this.subscription = response.data;
          }).catch(error => {
            this.$handleError(error);

          });
      }
    },
    getUtilisateurCompany () {
      this.loading = true;
      return axios.get('/api/companies/utilisateur/' + this.utilisateurId)
        .then(response => {
          this.company = response.data;
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
