<template>
  <div class="container">
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
                  <label class="fontUbuntu fontSize14">{{ this.$t('admin.role.fields.name') }}</label>
                  <input
                    v-validate="'required'"
                    type="text"
                    name="name"
                    class="form-control"
                    :placeholder="$t('admin.role.placeholder.name')"
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
                  <label class="fontUbuntu fontSize14">{{ this.$t('admin.role.fields.numSiret') }}</label>
                  <input
                    v-validate="'required'"
                    name="numSiret"
                    type="text"
                    class="form-control"
                    :placeholder="$t('admin.role.placeholder.numSiret')"
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
          <!--  <div class="row">
            <div class="col-6">
              <div class="form-group">
                <fieldset
                  id="nameCostumer"
                  class="nameCostumer"
                >
                  <label class="fontUbuntu fontSize14">{{ this.$t('admin.role.fields.nameCostumer') }}</label>
                  <input
                    v-validate="'required'"
                    type="text"
                    name="nameCostumer"
                    class="form-control"
                    :placeholder="$t('admin.role.placeholder.nameCostumer')"
                    v-model="formFields.nameCostumer"
                  >
                  <div
                    v-for="errorText in formErrors.nameCostumer"
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
                  id="lastNameCostumer"
                  class="lastNameCostumer"
                >
                  <label class="fontUbuntu fontSize14">{{ this.$t('admin.role.fields.lastNameCostumer') }}</label>
                  <input
                    v-validate="'required'"
                    name="lastNameCostumer"
                    type="text"
                    class="form-control"
                    :placeholder="$t('admin.role.placeholder.lastNameCostumer')"
                    v-model="formFields.lastNameCostumer"
                  >
                  <div
                    v-for="errorText in formErrors.lastNameCostumer"
                    :key="'code_' + errorText"
                  >
                    <span class="fontUbuntu fontSize13 red-skb">{{ errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-1">
              <b-img
                v-if="urlImageProfil"
                class="rounded-circle logo-size-75"
                :src="urlImageProfil"
              />
              <avatar
                v-else-if="utilisateur"
                class="p-0"
                :username="utilisateur.first_name + ' ' + utilisateur.last_name"
                :size="75"
              ></avatar>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <fieldset
                  id="email"
                  class="email"
                >
                  <label class="fontUbuntu fontSize14">{{ this.$t('admin.user.fields.email') }}</label>
                  <input
                    v-validate="'required|email'"
                    type="text"
                    name="email"
                    class="form-control"
                    :placeholder="$t('admin.user.placeholder.email')"
                    v-model="formFields.email"
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
              <div class="form-group mb-0">
                <fieldset
                  id="imageProfil"
                  class="imageProfil"
                >
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
                    <span class="fontUbuntu fontSize13 red-skb">{{errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
          -->
          <div class="row">
            <div class="col-12">

              <fieldset
                id="category"
                class="category"
              >

                <multiselect
                  v-model="formFields.category"
                  :options="category"
                  placeholder="Selectionner categorie"
                  :searchable="false"
                  :close-on-select="false"
                  :show-labels="false"
                  label="name"
                  track-by="name"
                >
                </multiselect>

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
        // nameCostumer: null,
        // lastNameCostumer: null,
        // email: null,
        // utilisateur: [],
        category: null,
      },
      formErrors: {
        name: [],
        numSiret: [],
        // nameCostumer: [],
        // lastNameCostumer: [],
        // email: [],
        // imageProfil: [],
        category: []
      },
      // urlImageProfil: null,
      // imageProfilSelected: null,
      // utilisateur: null,
      // imageName: '',
      // value: null,
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
    // onFileSelected () {
    //   this.imageProfilSelected = this.$refs.imageProfil.files[0];
    //   this.imageName = this.$refs.imageProfil.files[0].name;
    //   this.urlImageProfil = URL.createObjectURL(this.imageProfilSelected);
    // },
    reformName (name) {
      let reformedName = name.replaceAll(' ', '-').trim();
      console.log(reformedName);
      return reformedName;
    }
  },
  // watch: {
  //   formFields: {
  //     handler () {
  //       if (this.formFields.name) {
  //         let reformedName = this.reformName(this.formFields.name);
  //         this.formFields.urlName = reformedName;
  //       }
  //     },
  //     deep: true
  //   }
  // }

}
</script>
