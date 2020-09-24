import get from 'lodash/get'

export default {
    data() {
        return {
            validationErrors: {}
        }
    },
    methods: {
        handleGraphQLErrors(error) {
            //todo handle network or exception validation
            let { graphQLErrors } = error;
            let errorCategpry = get(graphQLErrors, '0.extentions.category')
            if (errorCategpry === "validation") {
                this.validationErrors = graphQLErrors[0].extensions.validation;
            }
        }
    }
}
