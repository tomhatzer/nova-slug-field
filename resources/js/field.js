import SlugIndexField from './components/Slug/IndexField';
import SlugDetailField from './components/Slug/DetailField';
import SlugFormField from './components/Slug/FormField';

import TextSlugIndexField from './components/TextWithSlug/IndexField';
import TextSlugDetailField from './components/TextWithSlug/DetailField';
import TextSlugFormField from './components/TextWithSlug/FormField';

Nova.booting((Vue, router) => {
    Vue.component('index-nova-slug-field', SlugIndexField);
    Vue.component('detail-nova-slug-field', SlugDetailField);
    Vue.component('form-nova-slug-field', SlugFormField);

    Vue.component('index-nova-textwithslug-field', TextSlugIndexField);
    Vue.component('detail-nova-textwithslug-field', TextSlugDetailField);
    Vue.component('form-nova-textwithslug-field', TextSlugFormField);
})
