<script>
import isNil from 'lodash/isNil'
import querystring from  'querystring'
import isArray  from 'lodash/isArray';

export default {
    props: ['currentUrl', 'filterProp'],
    data() {
        return {
            filter: {}
        }
    },
    methods: {
        filterCheckboxChange(e, filterSlug, filterValue, type) {
            if (e.target.checked) {
                if (type === 'PROPERTY') {
                    var arraySlug = 'p___' + filterSlug + '[]';
                }
                if (isNil(this.filter[arraySlug])) {
                    this.filter[arraySlug] = [];
                }
                this.filter[arraySlug].push(filterValue);
                    const url = this.currentUrl + '?' + querystring.stringify(this.filter);
                    location = url;
            } else {
                console.log('un checked box')
            }
        }
    },
    mounted() {
        for (var key  in this.filterProp) {
            if (isArray(this.filterProp[key])) {
                let arrayKey = key + '[]';
                this.filter[arrayKey] = [];
                this.filter[arrayKey] = this.filterProp[key];
            }
        }
        
    }
}
</script>
