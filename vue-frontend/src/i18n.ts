import { createI18n } from 'vue-i18n'
import en from '@/locales/en.json'


const messages = {
    en: en
}
// function loadLocaleMessages() {
//     const locales = require.context('./locales', true, /[A-Za-z0-9-_,\s]+\.json$/i)
//     const messages: any = {}
//     locales.keys().forEach(key => {
//         const matched = key.match(/([A-Za-z0-9-_]+)\./i)
//         if (matched && matched.length > 1) {
//             const locale = matched[1]
//             messages[locale] = locales(key)
//         }
//     })
//     return messages
// }
const i18n = createI18n({
    legacy: false,
    locale: 'en',
    fallbackLocale: 'en',
    messages: messages
})

export default i18n
