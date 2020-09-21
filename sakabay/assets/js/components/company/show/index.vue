<template>
  <div class="skb-body">
    <div class="container">
      <div v-if="loading"> Chargement ... </div>
      <div v-else>
        <div class="row mt-4 card-skb">
          <div class="col-7">
            <img
              src="/build/logo.png"
              class="logo-main-info bordered"
            />
            <div class="header-main-info">
              <div class="company-name">
                <h1 class="fontSize32 fontHelveticaBold m-0"> {{ company.name }} </h1>
              </div>
              <div class="activity-domain">
                <span class="fontSize18 fontHelvetica">{{ company.category.name }}</span>
              </div>
            </div>
          </div>
          <div class="col-2">
          </div>
        </div>

        <div class="row navigation-menu card-skb">
          <div class="col-12">
            <a
              href="#presentation"
              class="fontHelvetica"
              :class="presentationActive ? 'navigation-link-active': 'navigation-link'"
              @click="activePresentation()"
            >{{$t("company.nav_title.presentation")}}</a>
            <a
              href="#jobOffers"
              class="fontHelvetica"
              :class="jobOfferActive ? 'navigation-link-active': 'navigation-link'"
              @click="activeJobOffer()"
            >{{$t("company.nav_title.job_offers")}}</a>
            <a
              href="#comments"
              class="fontHelvetica"
              :class="commentActive ? 'navigation-link-active': 'navigation-link'"
              @click="activeComment()"
            >{{$t("company.nav_title.comments")}}</a>
          </div>
        </div>
        <div v-if="presentationActive">
          <presentation-page :company="company" />
        </div>

        <div v-else-if="jobOfferActive">
          <p>Work in progress ... Listing des offres d'emplois</p>
        </div>

        <div v-else-if="commentActive">
          <p>Work in progress ... Listing des commentaires</p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
import presentationPage from './presentation';

export default {
  components: {
    presentationPage
  },
  props: {
    companyUrlName: {
      type: String,
      default: ''
    },

  },
  created () {
    this.loading = true;
    return axios.get('/api/companies/details/' + this.companyUrlName)
      .then(response => {
        this.company = response.data;
        this.loading = false;
      }).catch(e => {
        this.loading = false;
        console.log(e);
      });
  },

  data () {
    return {
      loading: false,
      company: {},
      presentationActive: true,
      jobOfferActive: false,
      commentActive: false,
    }
  },
  methods: {
    activePresentation () {
      this.presentationActive = true;
      this.jobOfferActive = false;
      this.commentActive = false;
    },
    activeJobOffer () {
      this.presentationActive = false;
      this.jobOfferActive = true;
      this.commentActive = false;
    },
    activeComment () {
      this.presentationActive = false;
      this.jobOfferActive = false;
      this.commentActive = true;
    },
  },
}
</script>
