<template>
  <div class="container-fluid skb-body">
    <div class="row my-4">
      <div class="col-4">
        <h1 class="fontUbuntu orange-skb">{{ this.$t('company.title_subscribed') }}</h1>
      </div>
      <div class="col-1"></div>
      <div class="col-6">
        <b-form-group
          horizontal
          class="mb-0"
        >
          <b-input-group>
            <b-form-input
              v-model="currentFilter"
              :placeholder="$t('commons.rechercher')"
              @keydown.enter.native="applyFilter()"
            />
            <b-input-group-append>
              <b-btn
                :disabled="!currentFilter"
                @click="applyFilter()"
              ><i class="fas fa-search"></i></b-btn>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </div>
    </div>
    <!-- Table -->
    <b-row>
      <b-col cols="12">
        <b-table
          class="tablestyle"
          ref="table"
          :items="refreshData"
          :fields="table.field"
          :current-page="pager.currentPage"
          :per-page="pager.perPage"
          :busy.sync="table.isBusy"
          :filter="table.filter"
          :sort-by.sync="table.sortBy"
          :sort-desc.sync="table.sortDesc"
          small
          bordered
          responsive
          fixed
        >
          <template v-slot:cell(actions)="data">
            <b-button-group>
              <a
                :href="'/admin/entreprise/show/' + data.value "
                v-if="canRead"
              >
                <b-button><i class="fas fa-eye"></i></b-button>
              </a>
              <a
                v-if="canEdit"
                :href="'/admin/entreprise/edit/' + data.value "
                class="mx-1"
              >
                <b-button><i class="fas fa-edit"></i></b-button>
              </a>
              <b-button
                v-if="canDelete"
                @click="deleteFonction(data.value)"
              ><i class="fas fa-trash"></i></b-button>
            </b-button-group>
          </template>
        </b-table>
      </b-col>
    </b-row>
    <b-row align-h="center">
      <b-col cols="12">
        <b-pagination
          v-model="pager.currentPage"
          :total-rows="pager.totalRows"
          :per-page="pager.perPage"
          align="center"
        ></b-pagination>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import axios from 'axios';
import paginationMixin from 'mixins/paginationMixin';

export default {
  mixins: [paginationMixin],
  props: {
    canRead: {
      type: Boolean,
      default: false
    },
    canEdit: {
      type: Boolean,
      default: false
    },
    canDelete: {
      type: Boolean,
      default: false
    },
  },
  data () {
    return {
      currentFilter: '',
      table: {
        field: [
          { key: 'name', label: this.$t('company.table.fields.name'), sortable: true, thClass: "tableitem" },
          { key: 'numSiret', label: this.$t('company.fields.num_siret'), thClass: "tableitem", class: 'col-size-10' },
          { key: 'url_name', label: this.$t('company.table.fields.url_name'), thClass: "tableitem" },
          { key: 'utilisateur', label: this.$t('company.table.fields.utilisateur'), thClass: "tableitem" },
          { key: 'category', label: this.$t('company.table.fields.category'), thClass: "tableitem" },
          (!this.canDelete && !this.canEdit && !this.canRead) ? null : { key: 'actions', label: this.$t('commons.actions'), class: 'col-size-8', thClass: "tableitem" },
        ],
        sortBy: 'name'
      }
    };
  },
  methods: {
    deleteFonction (companyId) {
      return axios.delete("/api/companies/" + companyId)
        .then(response => {
          window.location.assign(response.headers.location);
        });
    },
    refreshData () {
      return axios.get("/api/companies" , {
        params: {
          filterFields: 'name',
          filter: this.currentFilter,
          sortBy: this.table.sortBy,
          sortDesc: this.table.sortDesc,
          currentPage: this.pager.currentPage,
          perPage: this.pager.perPage,
          codeStatut: 'BEAUTE'
        }
      }).then(response => {
        console.log(response.data);
        let items = _.map(response.data, company => _.assign(company, {
          name: company.name,
          numSiret: company.num_siret,
          urlName: company.url_name,
          utilisateur: company.utilisateur.login,
          category: company.category.name,
          actions: company.id,
        }));
        this.pager.totalRows = parseInt(response.headers['x-total-count']);
        return items;
      }).catch(error => {
        console.log(error);
        return [];
      });
    },
  },
}
</script>
