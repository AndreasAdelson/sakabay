<template>
  <div class="skb-body container">
    <a href="/admin/entreprise">
      <button
        title="Annulez "
        type="button"
        class="w-40px p-0 rounded-circle btn-close btn"
      >
        <i class="fas fa-times "></i>
      </button>
    </a>
    <form>
      <div class="">
        <div class="register-card w-100 h-100">
          <!-- First row  -->
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <fieldset
                  id="name"
                  class="name"
                >
                  <label class="fontUbuntu fontSize14">{{ this.$t('company.table.fields.name') }}</label>
                  <input
                    v-validate="'required'"
                    type="text"
                    name="name"
                    class="form-control"
                    :placeholder="$t('company.placeholder.name')"
                    v-model="formFields.name"
                  >
                  <div
                    v-for="errorText in formErrors.name"
                    :key="'name_' + errorText"
                  >
                    <span class="fontUbuntu fontSize13 red-skb">{{ errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <fieldset
                  id="numSiret"
                  class="numSiret"
                >
                  <label class="fontUbuntu fontSize14">{{ this.$t('company.fields.num_siret') }}</label>
                  <input
                    v-validate="'required'"
                    name="numSiret"
                    type="text"
                    class="form-control"
                    :placeholder="$t('company.placeholder.num_siret')"
                    onkeypress="return event.charCode === 0 || event.charCode === 47 || (event.charCode >= 48 && event.charCode <= 57)"
                    v-model="formFields.numSiret"
                  >
                  <div
                    v-for="errorText in formErrors.numSiret"
                    :key="'code_' + errorText"
                  >
                    <span class="fontUbuntu fontSize13 red-skb">{{ errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
          <!-- second row -->
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <fieldset
                  id="url_name"
                  class="url_name"
                >
                  <label class="fontUbuntu fontSize14">{{ this.$t('company.table.fields.url_name') }}</label>
                  <input
                    v-validate="'required'"
                    type="text"
                    name="url_name"
                    class="form-control"
                    :placeholder="$t('company.placeholder.url_name')"
                    v-model="formFields.url_name"
                  >
                  <div
                    v-for="errorText in formErrors.url_name"
                    :key="'url_name_' + errorText"
                  >
                    <span class="fontUbuntu fontSize13 red-skb">{{ errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
          <!-- Third row -->
          <div class="row">
            <div class="col-12">
              <fieldset
                id="category"
                class="category"
              >
                <multiselect
                  v-validate="'required'"
                  v-model="formFields.category"
                  :options="category"
                  name="category"
                  placeholder="Selectionner categorie"
                  :searchable="false"
                  :close-on-select="false"
                  :show-labels="false"
                  label="name"
                  track-by="name"
                >
                </multiselect>
                <div
                  v-for="errorText in formErrors.category"
                  :key="'category_' + errorText"
                >
                  <span class="fontUbuntu fontSize13 red-skb">{{ errorText }}</span>
                </div>
              </fieldset>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-6 offset-3">
              <button
                type="button"
                class="btn button_skb fontUbuntu"
                @click="$validateForm()"
              >{{ this.$t('commons.create') }}</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
import axios from 'axios';
import _ from 'lodash';
import validatorRulesMixin from 'mixins/validatorRulesMixin';
import adminFormMixin from 'mixins/adminFormMixin';
export default {
  mixins: [
    validatorRulesMixin,
    adminFormMixin
  ],
  props: {
    companyId: {
      type: Number,
      default: null,
    }
  },
  data () {
    return {
      API_URL: '/api/admin/companies/' + this.companyId,
      formFields: {
        name: null,
        numSiret: null,
        category: null,
        url_name: null,
      },
      formErrors: {
        name: [],
        numSiret: [],
        category: [],
        url_name: []
      },
      category: [],
    };
  },
  created () {
    let promises = [];
    promises.push(axios.get("/api/admin/categories"));
    promises.push(axios.get('/api/companies/' + this.companyId));
    return Promise.all(promises).then(res => {
      this.category = res[0].data;
      let company = res[1].data;
      this.$removeFieldsNotInForm(company, Object.keys(this.formFields));
      this.$setEditForm(company);
    });
  },
  methods: {
  },
}
</script>
