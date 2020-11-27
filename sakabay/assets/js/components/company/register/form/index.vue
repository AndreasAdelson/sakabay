<template>
  <div class="skb-body container">
    <a href="/">
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
                  <label class="fontUbuntu fontSize14">{{ this.$t('company.fields.name') }}</label>
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
                  id="postalAddress"
                  class="postalAddress"
                >
                  <label class="fontUbuntu fontSize14">{{ this.$t('company.table.fields.address.postal_address') }}</label>
                  <input
                    v-validate="'required'"
                    name="postalAddress"
                    type="text"
                    maxlength="255"
                    class="form-control"
                    v-on:blur="() => {
                      if (formFields.address.postalCode && formFields.address.postalAddress) {
                        getLongLat();
                      }
                    }"
                    :placeholder="$t('company.placeholder.postal_address')"
                    v-model="formFields.address.postalAddress"
                  >
                  <div
                    v-for="errorText in formErrors.postalAddress"
                    :key="'code_' + errorText"
                  >
                    <span class="fontUbuntu fontSize13 red-skb">{{ errorText }}</span>
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
                  <label class="fontUbuntu fontSize14">{{ this.$t('company.table.fields.address.postal_code') }}</label>
                  <input
                    v-validate="'required'"
                    type="text"
                    name="postalCode"
                    class="form-control"
                    :placeholder="$t('company.placeholder.postal_code')"
                    v-on:blur="() => {
                      if (formFields.address.postalCode && formFields.address.postalAddress) {
                        getLongLat();
                      }
                    }"
                    onkeypress="return event.charCode === 0 || event.charCode === 47 || (event.charCode >= 48 && event.charCode <= 57)"
                    v-model="formFields.address.postalCode"
                  >
                  <div
                    v-for="errorText in formErrors.postalCode"
                    :key="'name_' + errorText"
                  >
                    <span class="fontUbuntu fontSize13 red-skb">{{ errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
          <!-- Map row -->
          <div v-if="loading">
            <div class="loader3"></div>
          </div>
          <div
            class="row mb-3"
            v-else-if="formFields.address.latitude && formFields.address.longitude"
          >
            <div
              class="col-12"
              style="height:300px"
            >
              <v-map
                :zoom=16
                :center="[formFields.address.latitude, formFields.address.longitude]"
                style="height:300px"
              >
                <v-marker
                  :draggable="true"
                  :lat-lng.sync="position"
                ></v-marker>
                <v-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></v-tile-layer>
              </v-map>
            </div>
            <div class="col-12 warning-message">
              <span class="fontUbuntu fontSize16 red-skb">{{$t('company.table.fields.address.warning_message')}}</span>
            </div>
          </div>
          <!-- third row -->
          <div class="row mb-3">
            <div class="col-12">
              <label class="fontUbuntu fontSize14">{{ this.$t('company.table.fields.category') }}</label>

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
                  open-direction="below"
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
          <!-- fourth row -->

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <fieldset
                  id="lastName"
                  class="lastName"
                >
                  <label class="fontUbuntu fontSize14">{{ this.$t('user.fields.last_name') }}</label>
                  <input
                    v-validate="{ required: true, regex:/^\D*$/ }"
                    name="lastName"
                    type="text"
                    maxlength="100"
                    class="form-control"
                    :placeholder="$t('user.placeholder.last_name')"
                    v-model="formFields.utilisateur.lastName"
                    onkeypress="return event.charCode === 0  ||
                                      (event.charCode >= 65 && event.charCode <= 90) ||
                                      (event.charCode >= 97 && event.charCode <= 122) ||
                                      (event.charCode >= 224 && event.charCode <= 246) ||
                                      (event.charCode >= 249 && event.charCode <= 255)"
                  >
                  <div
                    v-for="errorText in formErrors.lastName"
                    :key="'code_' + errorText"
                  >
                    <span class="fontUbuntu fontSize13 red-skb">{{ errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">

                <fieldset
                  id="firstName"
                  class="firstName"
                >
                  <label class="fontUbuntu fontSize14">{{ this.$t('user.fields.first_name') }}</label>
                  <input
                    v-validate="'required'"
                    type="text"
                    name="firstName"
                    class="form-control"
                    :placeholder="$t('user.placeholder.first_name')"
                    onkeypress="return event.charCode === 0  ||
                                      (event.charCode >= 65 && event.charCode <= 90) ||
                                      (event.charCode >= 97 && event.charCode <= 122) ||
                                      (event.charCode >= 224 && event.charCode <= 246) ||
                                      (event.charCode >= 249 && event.charCode <= 255)"
                    v-model="formFields.utilisateur.firstName"
                  >
                  <div
                    v-for="errorText in formErrors.firstName"
                    :key="'name_' + errorText"
                  >
                    <span class="fontUbuntu fontSize13 red-skb">{{ errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
          <!-- fifth row -->
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <fieldset
                  id="email"
                  class="email"
                >
                  <label class="fontUbuntu fontSize14">{{ this.$t('user.fields.email') }}</label>
                  <input
                    v-validate="'required|email'"
                    type="text"
                    name="email"
                    class="form-control"
                    :placeholder="$t('user.placeholder.email')"
                    v-model="formFields.utilisateur.email"
                  >
                  <div
                    v-for="errorText in formErrors.email"
                    :key="'email_' + errorText"
                  >
                    <span class="fontUbuntu fontSize13 red-skb">{{ errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
            <div class="col-6 my-auto">
              <div class="row">
                <div class="col-8 my-auto">
                  <div class="form-group mb-0">
                    <fieldset
                      id="imageProfil"
                      class="imageProfil"
                    >
                      <label class="fontUbuntu fontSize14"> {{ $t('user.placeholder.image_profil') }}</label>
                      <input
                        name="imageProfil"
                        type="file"
                        @change="onFileSelected"
                        ref="imageProfil"
                      >
                      <div
                        v-for="errorText in formErrors.imageProfil"
                        :key="'imageProfil_' + errorText"
                      >
                        <span class="fontUbuntu fontSize13 red-skb">{{ errorText }}</span>
                      </div>
                    </fieldset>
                  </div>
                </div>
                <div class="col-4">
                  <b-img
                    v-if="urlImageProfil"
                    class="rounded-circle logo-size-75"
                    :src="urlImageProfil"
                  />
                </div>
              </div>
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
            <!-- <div class="col-3">
              <button
                type="button"
                class="btn button_skb fontUbuntu"
                @click="test()"
              >Test</button>
            </div> -->
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
import axios from 'axios';
import validatorRulesMixin from 'mixins/validatorRulesMixin';
import _ from 'lodash';
import adminFormMixin from 'mixins/adminFormMixin';
import DualList from 'components/commons/dual-list';
export default {
  components: {
    DualList
  },
  mixins: [
    validatorRulesMixin,
    adminFormMixin
  ],
  props: {
  },
  data () {
    return {
      loading: false,
      API_URL: '/api/companies',
      formFields: {
        name: null,
        numSiret: null,
        utilisateur: new Object(),
        address: new Object(),
        category: null,
      },
      position: {
        lng: null,
        lat: null
      },
      formErrors: {
        name: [],
        numSiret: [],
        firstName: [],
        lastName: [],
        email: [],
        imageProfil: [],
        category: [],
        postalAddress: [],
        postalCode: []
      },
      urlImageProfil: null,
      imageProfilSelected: null,
      imageName: '',
      category: []
    };
  },
  created () {
    return axios.get("/api/admin/categories")
      .then(response => {
        this.category = response.data;
      }).catch(e => {
        console.log(e);
      });
  },
  methods: {

    onFileSelected () {
      this.imageProfilSelected = this.$refs.imageProfil.files[0];
      this.imageName = this.$refs.imageProfil.files[0].name;
      this.urlImageProfil = URL.createObjectURL(this.imageProfilSelected);
    },

    getLongLat () {
      let query = this.formFields.address.postalAddress + ', ' + this.formFields.address.postalCode;
      this.loading = true;
      return axios.get('https://api-adresse.data.gouv.fr/search/', {
        params: {
          q: query,
          limit: 10
        }
      }).then(response => {
        if (response.data.features) {
          this.$set(this.formFields.address, 'longitude', response.data.features[0].geometry.coordinates[0]);
          this.$set(this.formFields.address, 'latitude', response.data.features[0].geometry.coordinates[1]);
          this.position.lat = response.data.features[0].geometry.coordinates[1];
          this.position.lng = response.data.features[0].geometry.coordinates[0];

        } else {
          this.$set(this.formFields.address, 'longitude', 0);
          this.$set(this.formFields.address, 'latitude', 0);
        }
        this.loading = false;
      }).catch(e => {
        this.$handleError(e);
        this.loading = false;

      });
    },

    submitForm () {
      if (this.position.lat !== this.formFields.address.latitude && this.position.ngt !== this.formFields.address.longitude) {
        this.formFields.address.longitude = this.position.lng.toFixed(6);
        this.formFields.address.latitude = this.position.lat.toFixed(6);
      }
      let formData = this.$getFormFieldsData(this.formFields);
      if (this.imageProfilSelected) {
        formData.append('file', this.imageProfilSelected);
      }
      return axios.post(this.API_URL, formData)
        .then(response => {
          window.location.assign(response.headers.location);
        }).catch(e => {
          if (e.response && e.response.status && e.response.status == 400) {
            this.$handleFormError(e.response.data);
          }
        });
    },
  },
}
</script>
