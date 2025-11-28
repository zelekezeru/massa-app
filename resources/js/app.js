import './bootstrap';
import '../css/app.css';
import '../../public/kaiadmin/css/kaiadmin.min.css';
import '../../public/kaiadmin/css/bootstrap.min.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createI18n } from 'vue-i18n';
import messages from './path/to/messages';

const appName = import.meta.env.VITE_APP_NAME || 'MASSA Farms';

const i18n = createI18n({
  legacy: false,
  locale: localStorage.getItem('locale') || 'en',
  fallbackLocale: 'en',
  messages,
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        
        const i18n = createI18n({
            locale: props.initialPage.props.translations.lang,
            fallbackLocale: 'en',
            messages,
        });

        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(i18n)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
