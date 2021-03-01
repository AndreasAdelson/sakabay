<template>
  <div class="container-fluid skb-body p-4 dashboard">
    <div v-show="loading">
      <div class="loader-container-full">
        <div class="loader" />
      </div>
    </div>
    <div class="row justify-content-between pt-4 mb-4">
      <div class="col-4 align-self-center">
        <i class="far fa-copy grey-skb fontSize20 mr-2" />
        <h1 class="text-center fontPoppins fontSize20 dashboard-title">
          {{ $t('opportunity.title_list') }}
        </h1>
      </div>
      <div class="col-3">
        <fieldset
          id="companySelected"
          class="companySelected"
        >
          <multiselect
            v-model="companySelected"
            :disabled="onlyOne"
            :options="companies"
            name="companySelected"
            :searchable="false"
            :close-on-select="true"
            :show-labels="false"
            label="name"
            track-by="name"
          />
        </fieldset>
      </div>
    </div>
    <div class="container opportunity-list">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row scroll-h650">
                <vuescroll :ops="opsButton">
                  <div class="col" />
                </vuescroll>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import axios from 'axios';
  import _ from 'lodash';
  import vuescroll from 'vuescroll';


  export default {
    components: {
      vuescroll,
    },
    props: {
      utilisateurId: {
        type: Number,
        default: null
      }
    },
    data() {
      return {
        loading: true,
        opsButton: {
          bar: {
            keepShow: true,
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
        opportunities: [],
        companies: [],
        companySelected: null,
        onlyOne: true,
        category: null,
        sousCategories: null
      };
    },
    watch: {
      companySelected(newValue) {
        this.sousCategories = [];
        this.category =  _.clone(newValue.category.code);
        if (newValue.sous_categorys.length > 0) {
          this.sousCategories = _.clone(_.map(newValue.sous_categorys, 'code'));
        }
        this.getOpportunities();
      }
    },
    created() {
      let promises = [];
      promises.push(axios.get('/api/companies/utilisateur/' + this.utilisateurId));
      return Promise.all(promises).then(res => {
        this.loading = false;
        this.companies = _.cloneDeep(res[0].data);
        if (this.companies.length > 0) {
          this.companySelected = this.companies[0];
          if (this.companies.length > 1) {
            this.onlyOne =  false;
          }
        }
      }).catch(e => {
        this.$handleError(e);
        this.loading = false;
      });
    },
    methods: {
      getOpportunities() {
        this.loading = true;
        return axios.get('/api/opportunities', {
          params: {
            category: this.category,
            sousCategory: this.sousCategories
          }
        }).then(res => {
          this.loading = false;
          this.opportunities = res.data;
        }).catch(e => {
          this.$handleError(e);
          this.loading = false;
        });
      },
    }

  };
</script>
