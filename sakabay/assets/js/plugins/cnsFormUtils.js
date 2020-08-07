import _ from 'lodash';

const CnsFormUtils = {
  install(Vue, options) {
    Vue.prototype.$handleFormError = function (errorsData) {
      let receivedFormError = errorsData.errors.children;
      Object.keys(receivedFormError).forEach(field => {
        const fieldErrors = receivedFormError[field].errors;
        if (fieldErrors) {
          this.$addErrorInFormError(field, fieldErrors);
        }
      });
    };

    Vue.prototype.$addErrorInFormError = function (field, error) {
      if (error) {
        this.formErrors[field] = error;
      }
      let fieldElementHtml = document.getElementsByClassName(field)[0];
      let formElement =
        fieldElementHtml.getElementsByTagName('input')[0] ||
        fieldElementHtml.getElementsByTagName('textarea')[0];
      if (formElement) {
        formElement.classList.add('border-danger-skb');
      }
    };

    Vue.prototype.$validateForm = function (newLocationHash) {
      this.$removeFormErrors();
      return this.$validator.validate().then(result => {
        if (result) {
          this.submitForm();
        } else {
          this.$validator.errors.items.forEach(error => {
            let fieldErrors = _.get(this.formErrors, error.field);
            if (fieldErrors === undefined) {
              fieldErrors = [];
            }

            //add custom rules gestion here -> see connectus
            const customRulesList = [];
            let errorMessage = error.msg;
            if (!customRulesList.includes(error.rule)) {
              errorMessage = this.$t('error_message_' + error.rule);
            }
            if (fieldErrors instanceof Array) {
              fieldErrors.push(errorMessage);
            } else {
              this.$set(fieldErrors, '-1', errorMessage);
            }
            let formErrors = _.cloneDeep(this.formErrors);
            _.set(formErrors, error.field, fieldErrors);
            this.formErrors = _.cloneDeep(formErrors);
            this.$addErrorInFormError(error.field);
          });
          if (newLocationHash) {
            window.location.hash = newLocationHash;
          }
        }
      })
    };

    Vue.prototype.$removeFormErrors = function () {
      Object.keys(this.formErrors).forEach(field => {
        this.$removeFieldErrors(field);
      });
    };

    Vue.prototype.$removeFieldErrors = function (field) {
      _.set(this.formErrors, field, []);
      let fieldsetElement = document.getElementsByClassName(field)[0];
      if (fieldsetElement) {
        let formElement =
          fieldsetElement.getElementsByTagName('input')[0] ||
          fieldsetElement.getElementsByTagName('textarea')[0];
        if (formElement) {
          formElement.classList.remove('border-danger-skb');
        }
      }
    };

    Vue.prototype.$setEditForm = function (data) {
      Object.keys(this.formFields).forEach(field => {
        let underscoreField = this.$camelCaseToUnderscoreCase(field);
        this.formFields[field] = data[underscoreField];
      });
    }

    Vue.prototype.$camelCaseToUnderscoreCase = function (field) {
      return field.replace(/([A-Z])/g, "_$1").toLowerCase();
    }
  }
}

export default CnsFormUtils;
