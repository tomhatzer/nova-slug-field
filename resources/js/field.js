Nova.booting((Vue, router) => {
    Vue.component('index-nova-slug-field', require('./components/Slug/IndexField'));
    Vue.component('detail-nova-slug-field', require('./components/Slug/DetailField'));
    Vue.component('form-nova-slug-field', require('./components/Slug/FormField'));

    Vue.component('index-nova-textwithslug-field', require('./components/TextWithSlug/IndexField'));
    Vue.component('detail-nova-textwithslug-field', require('./components/TextWithSlug/DetailField'));
    Vue.component('form-nova-textwithslug-field', require('./components/TextWithSlug/FormField'));
})
