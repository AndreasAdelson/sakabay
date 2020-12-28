import {
  shallow,
  createLocalVue
} from 'vue-test-utils';
import axios from 'axios';
import cnsFormUtils from 'plugins/cnsFormUtils';
import cnsRenderUtils from 'plugins/cnsRenderUtils';
import VueLogger from 'vuejs-logger';
import VueI18n from 'vue-i18n';
import UtilisateurShow from './index.vue';

const loggerOptions = {
  isEnabled: true,
  logLevel: 'debug',
  stringifyArguments: false,
  showLogLevel: true,
  showMethodName: true,
  separator: '|',
  showConsoleColors: true
};

const localVue = createLocalVue();

localVue.use(VueI18n);
localVue.use(cnsFormUtils);
localVue.use(cnsRenderUtils);
localVue.use(VueLogger, loggerOptions);

jest.mock('axios', () => ({
  get: jest.fn(() => {
    return Promise.resolve({
      data: {
        last_name: "toto",
        username: "test"
      }
    });
  })
}));

let wrapper;

describe('UtilisateurShow', () => {
  beforeEach(() => {
    const i18n = new VueI18n({
      locale: 'fr',
      fallbackLocale: 'fr',
      messages: {
        'en': require('i18n/en.json'),
        'fr': require('i18n/fr.json')
      }
    });
    wrapper = shallow(UtilisateurShow, {
      i18n,
      localVue,
    });
  });

  it('initializes', () => {
    expect(wrapper.vm).toBeDefined();
  })
});
