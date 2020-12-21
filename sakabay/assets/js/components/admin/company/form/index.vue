<template>
  <div class="skb-body container">
    <div v-show="loading">
      <div class="loader-container-full">
        <div class="loader">
        </div>
      </div>
    </div>
    <div>
      <a :href="isValidated ? '/admin/entreprise' : '/admin/registered/entreprise'">
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
                    <label class="fontUbuntuItalic fontSize14">{{ this.$t('company.table.fields.name') }}</label>
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
                      <span class="fontUbuntuItalic fontSize13 red-skb">{{ errorText }}</span>
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
                    <label class="fontUbuntuItalic fontSize14">{{ this.$t('company.fields.num_siret') }}</label>
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
                      <span class="fontUbuntuItalic fontSize13 red-skb">{{ errorText }}</span>
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
                    <label class="fontUbuntuItalic fontSize14">{{ this.$t('company.table.fields.url_name') }}</label>
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
                      <span class="fontUbuntuItalic fontSize13 red-skb">{{ errorText }}</span>
                    </div>
                  </fieldset>
                </div>
              </div>
              <div class="col-6">
                <fieldset
                  id="category"
                  class="category"
                >
                  <label class="fontUbuntuItalic fontSize14">{{ this.$t('company.table.fields.category') }}</label>

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
                    <span class="fontUbuntuItalic fontSize13 red-skb">{{ errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
            <!-- Postal Address and code -->
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <fieldset
                    id="postalAddress"
                    class="postalAddress"
                  >
                    <label class="fontUbuntuItalic fontSize14">{{ this.$t('company.table.fields.address.postal_address') }}</label>
                    <input
                      v-validate="'required'"
                      name="postalAddress"
                      type="text"
                      maxlength="255"
                      class="form-control"
                      :placeholder="$t('company.placeholder.postal_address')"
                      v-model="formFields.address.postal_address"
                    >
                    <div
                      v-for="errorText in formErrors.postal_address"
                      :key="'code_' + errorText"
                    >
                      <span class="fontUbuntuItalic fontSize13 red-skb">{{ errorText }}</span>
                    </div>
                  </fieldset>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">

                  <fieldset
                    id="postalCode"
                    class="postalCode"
                  >
                    <label class="fontUbuntuItalic fontSize14">{{ this.$t('company.table.fields.address.postal_code') }}</label>
                    <input
                      v-validate="'required'"
                      type="text"
                      name="postalCode"
                      class="form-control"
                      :placeholder="$t('company.placeholder.postal_code')"
                      onkeypress="return event.charCode === 0 || event.charCode === 47 || (event.charCode >= 48 && event.charCode <= 57)"
                      v-model="formFields.address.postal_code"
                    >
                    <div
                      v-for="errorText in formErrors.postal_code"
                      :key="'name_' + errorText"
                    >
                      <span class="fontUbuntuItalic fontSize13 red-skb">{{ errorText }}</span>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>
            <!-- City -->
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <fieldset
                    id="city"
                    class="city"
                  >
                    <label class="fontUbuntuItalic fontSize14">{{ this.$t('company.table.fields.city') }}</label>
                    <autocomplete
                      ref="autocomplete"
                      :min="2"
                      :debounce="500"
                      :on-should-render-child="$getCityLabel"
                      :on-select="setCity"
                      :placeholder="$t('company.placeholder.city')"
                      param="autocomplete"
                      url="/api/admin/cities"
                      anchor="label"
                      :classes="{input: 'form-control'}"
                    />
                    <div
                      v-for="errorText in formErrors.city"
                      :key="'city_' + errorText"
                    >
                      <span class="fontUbuntuItalic fontSize13 red-skb">{{ errorText }}</span>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>

            <!-- Fourth row -->
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <fieldset
                    id="latitude"
                    class="latitude"
                  >
                    <label class="fontUbuntuItalic fontSize14">{{ this.$t('company.table.fields.address.latitude') }}</label>
                    <input
                      v-validate="'required'"
                      name="latitude"
                      type="text"
                      pattern="^-?\d{0,3}(\.\d{0,6})?$"
                      maxlength="9"
                      class="form-control"
                      :placeholder="$t('company.placeholder.latitude')"
                      onkeypress="return event.charCode === 0 || event.charCode === 45 || event.charCode === 46 || (event.charCode >= 48 && event.charCode <= 57)"
                      v-model="formFields.address.latitude"
                    >
                    <div
                      v-for="errorText in formErrors.latitude"
                      :key="'code_' + errorText"
                    >
                      <span class="fontUbuntuItalic fontSize13 red-skb">{{ errorText }}</span>
                    </div>
                  </fieldset>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">

                  <fieldset
                    id="longitude"
                    class="longitude"
                  >
                    <label class="fontUbuntuItalic fontSize14">{{ this.$t('company.table.fields.address.longitude') }}</label>
                    <input
                      v-validate="'required'"
                      type="text"
                      pattern="^-?\d{0,3}(\.\d{0,6})?$"
                      maxlength="9"
                      name="longitude"
                      class="form-control"
                      :placeholder="$t('company.placeholder.longitude')"
                      onkeypress="return event.charCode === 0 || event.charCode === 45 || event.charCode === 46 || (event.charCode >= 48 && event.charCode <= 57)"
                      v-model="formFields.address.longitude"
                    >
                    <div
                      v-for="errorText in formErrors.longitude"
                      :key="'name_' + errorText"
                    >
                      <span class="fontUbuntuItalic fontSize13 red-skb">{{ errorText }}</span>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>
            <div
              class="row"
              v-if="formFields.address.latitude && formFields.address.latitude"
            >
              <div class="col-12">
                <v-map
                  :zoom=16
                  :center="[formFields.address.latitude, formFields.address.longitude]"
                  style="height:300px"
                >
                  <v-marker :lat-lng="[formFields.address.latitude, formFields.address.longitude]"></v-marker>
                  <v-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></v-tile-layer>
                </v-map>
              </div>
            </div>
            <div class="row my-3">
              <div class="col-6 offset-3">
                <button
                  type="button"
                  class="btn button_skb fontUbuntuItalic"
                  @click="$validateForm()"
                >{{ this.$t('commons.edit') }}</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
import _ from 'lodash';
import validatorRulesMixin from 'mixins/validatorRulesMixin';
import Autocomplete from 'vue2-autocomplete-js';
import adminFormMixin from 'mixins/adminFormMixin';
export default {
  components: {
    Autocomplete
  },
  mixins: [
    validatorRulesMixin,
    adminFormMixin
  ],
  props: {
    companyId: {
      type: Number,
      default: null,
    },
    isValidated: {
      type: Boolean,
      default: false
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
        address: {},
        city: {},
        validated: this.isValidated
      },
      formErrors: {
        name: [],
        numSiret: [],
        category: [],
        url_name: [],
        postalCode: [],
        postalAddress: [],
        latitude: [],
        longitude: [],
        city: []
      },
      category: [],
      loading: true,
    };
  },
  created () {
    let promises = [];
    promises.push(axios.get("/api/admin/categories"));
    promises.push(axios.get(this.API_URL));
    return Promise.all(promises).then(res => {
      this.category = res[0].data;
      let company = res[1].data;
      this.$removeFieldsNotInForm(company, Object.keys(this.formFields));
      this.$setEditForm(company);
      this.$refs.autocomplete.setValue(company.city.name);
      this.loading = false;
    }).catch(e => {
      this.$handleError(e);
    }).then(() => this.loading = false);
  },
  methods: {
    setCity (city) {
      this.formFields.city = city;
      this.$refs.autocomplete.setValue(city.name);
    },
  },
  computed: {

  },
}
</script>
