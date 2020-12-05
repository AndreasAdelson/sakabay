<template>
  <div class="skb-body container-fluid">
    <div class="row py-3">
      <div class="container">

        <div class="row pt-5 pb-3">
          <div class="col-3">
            <b-form-group
              horizontal
              class="mb-0"
            >
              <b-input-group>
                <b-form-input
                  v-model="filters.filter"
                  :placeholder="$t('commons.placeholder.search')"
                  @keydown.enter.native="applyFilter()"
                />
              </b-input-group>
            </b-form-group>
          </div>
          <div class="col-3">
            <multiselect
              v-validate="'required'"
              v-model="filters.category"
              :options="category"
              name="category"
              :placeholder="$t('commons.placeholder.category')"
              :searchable="false"
              :close-on-select="false"
              :show-labels="false"
              label="name"
              track-by="name"
            >
            </multiselect>
          </div>
          <div class="col-3">
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
                />
                <b-input-group-append>
                  <b-btn
                    disabled
                    style="height:min-content"
                  ><i class="fas fa-map-marker-alt"></i></b-btn>
                </b-input-group-append>
              </b-input-group>
            </b-form-group>
          </div>
          <div class="col-2">
            <b-button
              :disabled="!filters.filter && !filters.category && !filters.city"
              @click="applyFilter()"
              class="w-100"
            ><span class="mr-3">{{ $t('commons.search_button') }}</span><i class="fas fa-search"></i></b-button>
          </div>
        </div>
        <div
          v-if="loading"
          class="loader2"
        >
        </div>
        <div v-else-if="companies">
          <div
            class="row"
            v-for="(companie, index) in companies"
            :key="'card_' + index"
          >
            <div class="col-10 mx-auto">
              <company-card :company="companie"></company-card>
            </div>
          </div>
          <b-row align-h="center">
            <b-col cols="12">
              <b-pagination
                v-model="filters.currentPage"
                :total-rows="pager.totalRows"
                :per-page="filters.perPage"
                align="center"
              ></b-pagination>
            </b-col>
          </b-row>
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
  data () {
    return {
      currentFilter: '',
      filters: {
        filter: '',
        filterFields: 'name',
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
  created () {
    let promises = [];
    promises.push(axios.get("/api/admin/categories"));
    return Promise.all(promises).then(res => {
      this.category = res[0].data;
    });
  },
  methods: {
    applyFilter () {
      let sentFilter = this.setFilter();
      this.loading = true;
      return axios.get("/api/companies", {
        params: sentFilter
      }).then(response => {
        this.companies = response.data;
        this.pager.totalRows = parseInt(response.headers['x-total-count']);
        this.loading = false;
      }).catch(error => {
        this.$handleError(error);
        this.loading = false;
      });
    },
    setCity (city) {
      this.filters.city = city;
      this.$refs.autocomplete.setValue(city.name);
    },
    resetCity () {
      if (!this.$refs.autocomplete.value) {
        this.filters.city = null;
      }
    }
  },
}
</script>
