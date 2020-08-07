import Vue from 'vue';
import VueI18n from 'vue-i18n';

Vue.use(VueI18n);

// Set language navigator
const locale = navigator.language;

// Set i18n instance on app
const i18n = new VueI18n({
  fallbackLocale: 'fr',
  locale,
  messages: {
    'en-US': require('../i18n/en.json'),
    'fr-FR': require('../i18n/fr.json'),
    'fr': require('../i18n/fr.json'),
  },
});

i18n.path = (link) => {
  if (i18n.locale === i18n.fallbackLocale) {
    return `/${link}`;
  }
  return `/${i18n.locale}/${link}`;
};

export default i18n;
