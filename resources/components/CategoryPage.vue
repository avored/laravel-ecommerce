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
                if (type === 'ATTRIBUTE') {
                    var arraySlug = 'a___' + filterSlug + '[]';
                }
                if (isNil(this.filter[arraySlug])) {
                    this.filter[arraySlug] = [];
                }
                this.filter[arraySlug].push(filterValue);
                
            } else {
                if (type === 'PROPERTY') {
                    var arraySlug = 'p___' + filterSlug + '[]';
                }
                if (type === 'ATTRIBUTE') {
                    var arraySlug = 'a___' + filterSlug + '[]';
                }
                if (isNil(this.filter[arraySlug])) {
                    this.filter[arraySlug] = [];
                }

                const index = this.filter[arraySlug].findIndex(ele => ele === filterValue);
                this.filter[arraySlug].splice(index, 1);
            }
            
            location = this.currentUrl + '?' + querystring.stringify(this.filter);
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
