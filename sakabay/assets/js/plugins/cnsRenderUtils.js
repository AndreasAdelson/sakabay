import $ from 'jquery';
import _ from 'lodash';

const CnsRenderUtils = {
  install(Vue, options) {
    Vue.prototype.$setAreaHeight = function () {
      // let windowHeight = document.documentElement.clientHeight;
      let headerMainHeight = document.getElementById('headerMain').clientHeight;
      let sousNavHeight = document.getElementById('sousNav').clientHeight;
      let totalHeaderHeight = headerMainHeight + sousNavHeight;

      $(document).ready(function () {
        $('body').css('padding-top', totalHeaderHeight);
      });
    };


    /**
     * Convert a camel case string to a snake case string
     * @param {String} string
     * @returns {String}
     */
    Vue.prototype.$camelToSnakeCase = function (string) {
      let snake = '';
      for (let i = 0; i < string.length; i++) {
        const letter = string[i];
        if (letter === letter.toUpperCase()) {
          snake += '_' + letter.toLowerCase();
        } else {
          snake += letter;
        }
      }
      return snake;
    };


    /**
     * 12345678912345 => 123 456 789 12345
     *
     * @param {String} string
     * @returns {String}
     */
    Vue.prototype.$getStringWithSpaces = function (string) {
      string = string.replace(/[^\d.]/g, '');
      let split;
      let chunk = [];
      for (let i = 0; i < string.length; i += split) {
        if (i >= 9) {
          split = 5;
          chunk.push(string.substr(i, 5));
        } else {
          split = 3;
          chunk.push(string.substr(i, split));
        }
      }
      return chunk.join(' ');
    };

    Vue.prototype.$refreshScrollbar = function () {
      setTimeout(() => {
        this.$vuebar.refreshScrollbar(document.getElementById('scrollbar'));
      }, 50);
    };


    Vue.prototype.$getUserLabel = function (user) {
      let label = '';
      if (user) {
        if (user.last_name) {
          label += user.last_name.toUpperCase();
        }
        if (user.first_name) {
          if (user.last_name) {
            label += ' ';
          }
          label += user.first_name
        }
        if (user.login) {
          if (user.last_name || user.first_name) {
            label += ' [';
          }
          label += user.login + ']'
        }
      }
      return label.trim();
    }

    Vue.prototype.$getCityLabel = function (city) {
      let label = '';
      if (city) {
        if (city.name) {
          label += city.name;
        }
      }
      return label.trim();
    }

    /**
     * Print the given error message in the console.
     * @param {Error} error
     */
    Vue.prototype.$handleError = function(error) {
      if (error) {
        const errorResponse = error.response;
        if (errorResponse && errorResponse.data) {
          this.$log.error(
            this.$t('commons.error_code_message', [
              errorResponse.data.code,
              errorResponse.data.message,
            ])
          );
        } else if (
          errorResponse &&
          errorResponse.headers &&
          errorResponse.headers['x-message']
        ) {
          this.$log.error(
            decodeURIComponent(errorResponse.headers['x-message'])
          );
        } else if (error.message) {
          this.$log.error(error.message);
        } else {
          this.$log.error(error);
        }
      } else {
        this.$log.error(this.$t('commons.error_occured'));
      }
    };

  },
};

export default CnsRenderUtils;
