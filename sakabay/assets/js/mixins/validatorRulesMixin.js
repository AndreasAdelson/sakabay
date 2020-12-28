import {
  Validator
} from 'vee-validate';

/**
 * Validator rules that can be used in v-validate.
 * All rules here must be in 'customRulesList' constant in cnsFormUtils.js
 */
export default {
  created() {
    Validator.extend('required_username', {
      getMessage: this.$t('error_message_required_username'),
      validate: value => value.trim().length >= 5 && value.trim().length <= 10
    });
  }
};
