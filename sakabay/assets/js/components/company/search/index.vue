<template>
  <div class="skb-body container-fluid">
    <div class="row py-3">
      <div class="container">
        <div class="row pt-3 pb-4">
          <div class="col">
            <b-form-group
              horizontal
              class="mb-0"
            >
              <b-input-group>
                <b-form-input
                  v-model="filters.filter"
                  class="fontAlice"
                  :placeholder="$t('commons.placeholder.search')"
                  @keydown.enter.native="applyFilter()"
                />
              </b-input-group>
            </b-form-group>
          </div>
          <div class="col">
            <multiselect
              v-model="filters.category"
              v-validate="'required'"
              :options="category"
              name="category"
              :placeholder="$t('commons.placeholder.category')"
              :searchable="false"
              :close-on-select="false"
              :show-labels="false"
              label="name"
              track-by="name"
              class="fontAlice"
            />
          </div>
          <div class="col">
            <b-form-group
              horizontal
              class="mb-0"
            >
              <b-input-group>
                <autocomplete
                  ref="autocomplete"
                  :min="3"
                  :debounce="500"
                  :on-should-render-child="$getCityLabel"
                  :on-select="setCity"
                  :placeholder="$t('commons.placeholder.city')"
                  :on-blur="resetCity"
                  param="autocomplete"
                  url="/api/admin/cities"
                  anchor="label"
                  style="width:85%"
                  :classes="{input: 'form-control'}"
                  class="fontAlice"
                />
                <b-input-group-append>
                  <b-btn
                    disabled
                    style="height:min-content"
                  >
                    <i class="fas fa-map-marker-alt" />
                  </b-btn>
                </b-input-group-append>
              </b-input-group>
            </b-form-group>
          </div>
          <div class="col">
            <b-button
              :disabled="!filters.filter && !filters.category && !filters.city"
              class="w-100"
              @click="applyFilter()"
            >
              <span class="mr-2 fontAlice">{{ $t('commons.search_button') }}</span><i class="ml-2 fas fa-search" />
            </b-button>
          </div>
        </div>
        <div
          v-if="loading"
          class="loader2"
        />
        <!-- Results here -->
        <div v-else-if="companies && companies.length > 0">
          <div
            v-for="(companie, index) in companies"
            :key="'card_' + index"
            class="row"
          >
            <div class="col-10 mx-auto">
              <company-card :company="companie" />
            </div>
          </div>
          <b-row align-h="center">
            <b-col cols="12">
              <b-pagination
                v-model="filters.currentPage"
                :total-rows="pager.totalRows"
                :per-page="filters.perPage"
                align="center"
              />
            </b-col>
          </b-row>
        </div>
        <!-- No Results founds here -->

        <div v-else-if="companies && companies.length == 0">
          <div class="col-10 mx-auto text-center mt-5">
            <span class="fontPoppins fontSize16">{{ $t('commons.no_results_found') }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import axios from 'axios';
  import searchMixin from 'mixins/searchMixin';
  import CompanyCard from './company-card';
  import Autocomplete from 'vue2-autocomplete-js';
  import _ from 'lodash';

  export default {
    components: {
      CompanyCard,
      Autocomplete
    },
    mixins: [
      searchMixin,
    ],
    props: {
    },
    data() {
      return {
        currentFilter: '',
        filters: {
          filter: '',
          filterFields: 'name, description',
          category: null,
          sortBy: 'name',
          sortDesc: false,
          currentPage: 1,
          perPage: 10,
          codeStatut: 'VAL',
          city: null
        },
        pager: {
          pageOptions: [10, 50, 100],
          totalRows: 0
        },
        category: [],
        companies: null,
        loading: false,
      };
    },
    created() {
      let promises = [];
      promises.push(axios.get('/api/admin/categories'));
      return Promise.all(promises).then(res => {
        this.category = res[0].data;
      });
    },
    methods: {
      applyFilter() {
        let sentFilter = this.setFilter();
        this.loading = true;
        return axios.get('/api/companies', {
          params: sentFilter
        }).then(response => {
          this.companies = _.cloneDeep(response.data);
          this.pager.totalRows = parseInt(response.headers['x-total-count']);
          this.loading = false;
        }).catch(error => {
          this.$handleError(error);
          this.loading = false;
        });
      },
      setCity(city) {
        this.filters.city = city;
        this.$refs.autocomplete.setValue(city.name);
      },
      resetCity() {
        if (!this.$refs.autocomplete.value) {
          this.filters.city = null;
        }
      }
    },
  };
</script>
