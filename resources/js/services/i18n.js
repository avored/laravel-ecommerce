import Vue from 'vue'
import VueI18n from 'vue-i18n'
import * as system from '@/modules/system/lang/en.json'
Vue.use(VueI18n)


const messages = {
    'en': {
        system: {
            ...system.default
        }
    },
    'es': {

    }
};

const i18n = new VueI18n({
    locale: 'en',
    fallbackLocale: 'en',
    messages,
});

export default i18n;
