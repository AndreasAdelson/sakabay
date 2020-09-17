<template>
  <div class="skb-body container">
    <a href="/home">
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
                  <label class="fontUbuntu fontSize14">{{ this.$t('company.fields.numSiret') }}</label>
                  <input
                    v-validate="'required'"
                    name="numSiret"
                    type="text"
                    class="form-control"
                    :placeholder="$t('company.placeholder.numSiret')"
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
import validatorRulesMixin from 'mixins/validatorRulesMixin';
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
    categoryId: {
      type: Number,
      default: null,
    }
  },
  data () {
    return {
      API_URL: '/api/companies',
      fonctionsAtCreation: null,
      fonctions: [],
      formFields: {
        name: null,
        numSiret: null,
        utilisateur: new Object(),
        category: null,
      },
      formErrors: {
        name: [],
        numSiret: [],
        firstName: [],
        lastName: [],
        email: [],
        imageProfil: [],
        category: []
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

    submitForm () {
      let formData = this.$getFormFieldsData(this.formFields, formData);
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
