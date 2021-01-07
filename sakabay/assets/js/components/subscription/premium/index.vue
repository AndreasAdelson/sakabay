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
              @click="subscribe()"
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
  import moment from 'moment';

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

    data() {

      return {
        API_URL: '/api/subscribes',
        formFields: {
          dtDebut: null,
          dtFin: null,
          company: new Object(),
          subscription: new Object()
        },
        formErrors: {
          dtDebut: [],
          dtFin: [],
          company: [],
          subscription: [],
        },

      };
    },
    created() {
      this.getSubcriptionName();
      this.getUtilisateurCompany();

    },
    methods: {
      getSubcriptionName() {
        if (this.subscriptionName) {
          this.loading = true;
          return axios.get('/api/subscribes/' + this.subscriptionName)
            .then(response => {
              this.formFields.subscription = response.data;
            }).catch(error => {
              this.$handleError(error);

            });
        }
      },
      getUtilisateurCompany() {
        if (this.utilisateurId) {
          this.loading = true;
          return axios.get('/api/companies/utilisateur/' + this.utilisateurId)
            .then(response => {
              this.formFields.company = response.data[0];
              console.log(response.data);
              this.loading = false;
            }).catch(error => {
              this.$handleError(error);
              this.loading = false;
            });
        }
      },
      subscribe() {
        let currentDate = moment().format('YYYY/MM/DD HH:mm:ss');
        let futureMonth = moment(currentDate).add(1, 'M');
        // if (moment(currentDate) != moment(futureMonth) && moment(currentDate) < moment(futureMonth)) {
        //   futureMonth = futureMonth.add(1, 'd');
        // }
        this.formFields.dtDebut = currentDate;
        this.formFields.dtFin = futureMonth.format('YYYY/MM/DD HH:mm:ss');

        return {

          API_URL: '/api/subscribes',
          formFields: {
            dtDebut: moment().format('YYYY/MM/DD H:m:s'),
            dtFin: moment().format('YYYY/MM/DD H:m:s'),
            company: new Object(),
            subscription: new Object()
          },
          formErrors: {
            dtDebut: [],
            dtFin: [],
            company: [],
            subscription: [],
          },

        };
      },
    }
  };
</script>

