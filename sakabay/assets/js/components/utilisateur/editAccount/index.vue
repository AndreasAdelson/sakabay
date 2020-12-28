<template>
  <div class="container skb-body">
    <button
      :title="$t('commons.go_back')"
      type="button"
      class="w-40px p-0 rounded-circle btn-close btn"
      @click.prevent="goBack()"
    >
      <i class="fas fa-times "></i>
    </button>
    <form>
      <div class="">
        <div class="register-card w-100 h-100">
          <!-- First row  -->
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
                :username="utilisateur.last_name + ' ' + utilisateur.first_name"
                :size="75"
              ></avatar>
            </div>
            <div class="col-5 my-auto">
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
                    <span class="fontUbuntuItalic fontSize13 red-skb">{{errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
          <!-- Second row  -->
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <fieldset
                  id="email"
                  class="email"
                >
                  <label class="fontUbuntuItalic fontSize16">{{ this.$t('user.fields.email') }}</label>
                  <input
                    v-validate="'required|email'"
                    type="text"
                    name="email"
                    class="form-control"
                    :placeholder="$t('user.placeholder.email')"
                    v-model="formFields.email"
                  >
                  <div
                    v-for="errorText in formErrors.email"
                    :key="'email_' + errorText"
                  >
                    <span class="fontUbuntuItalic fontSize13 red-skb">{{ errorText }}</span>
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
                  <label class="fontUbuntuItalic fontSize16">{{ this.$t('user.fields.first_name') }}</label>
                  <input
                    v-validate="'required'"
                    name="firstName"
                    type="text"
                    class="form-control"
                    :placeholder="$t('user.placeholder.first_name')"
                    v-model="formFields.firstName"
                  >
                  <div
                    v-for="errorText in formErrors.firstName"
                    :key="'firstName_' + errorText"
                  >
                    <span class="fontUbuntuItalic fontSize13 red-skb">{{errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
          <!-- Third row  -->
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <fieldset
                  id="lastName"
                  class="lastName"
                >
                  <label class="fontUbuntuItalic fontSize16">{{ this.$t('user.fields.last_name') }}</label>
                  <input
                    type="text"
                    class="form-control"
                    :placeholder="$t('user.placeholder.last_name')"
                    v-model="formFields.lastName"
                  >
                  <div
                    v-for="errorText in formErrors.lastName"
                    :key="'lastName_' + errorText"
                  >
                    <span class="fontUbuntuItalic fontSize13 red-skb">{{ errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <fieldset
                  id="username"
                  class="username"
                >
                  <label class="fontUbuntuItalic fontSize16">{{ this.$t('user.fields.username') }}</label>
                  <input
                    v-validate="'required_username'"
                    type="text"
                    name="username"
                    class="form-control"
                    :placeholder="$t('user.placeholder.username')"
                    v-model="formFields.username"
                  >
                  <div
                    v-for="errorText in formErrors.username"
                    :key="'username_' + errorText"
                  >
                    <span class="fontUbuntuItalic fontSize13 red-skb">{{errorText }}</span>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
          <div class="row">
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
</template>
<script>
import axios from 'axios';
import validatorRulesMixin from 'mixins/validatorRulesMixin';
import Avatar from 'vue-avatar';

export default {
  mixins: [
    validatorRulesMixin
  ],
  components: {
    Avatar
  },
  data () {
    return {
      formFields: {
        email: null,
        firstName: null,
        lastName: null,
        username: null,
      },
      formErrors: {
        email: [],
        firstName: [],
        lastName: [],
        username: [],
      },
      urlImageProfil: null,
      imageProfilSelected: null,
      utilisateur: null,
      imageName: ''
    };
  },
  props: {
    utilisateurId: {
      type: Number,
      default: null,
    },
    urlPrecedente: {
      type: String,
      default: null
    }
  },
  created () {
    if (this.utilisateurId) {
      return axios.get("/api/admin/utilisateurs/" + this.utilisateurId)
        .then(response => {
          this.$setEditForm(response.data);
          this.utilisateur = response.data;
          if (this.utilisateur.image_profil) {
            this.urlImageProfil = "/build/images/uploads/" + this.utilisateur.image_profil;
          }
        }).catch(e => {
          console.log(e);
        });
    }
  },

  methods: {
    onFileSelected () {
      this.imageProfilSelected = this.$refs.imageProfil.files[0];
      this.imageName = this.$refs.imageProfil.files[0].name;
      this.urlImageProfil = URL.createObjectURL(this.imageProfilSelected);
    },

    submitForm () {
      let formData = this.$getFormFieldsData(this.formFields);
      if (this.imageProfilSelected) {
        formData.append('file', this.imageProfilSelected);
      }
      return axios.post("/api/utilisateur/edit/" + this.utilisateurId, formData)
        .then(response => {
          window.location.assign(response.headers.location);
        }).catch(e => {
          if (e.response && e.response.status && e.response.status == 400) {
            this.$handleFormError(e.response.data);
          }
        });
    },

    goBack () {
      this.$goTo(this.urlPrecedente);
    },
  },
}
</script>
