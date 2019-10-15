<script>

export default {
    props: ['items', 'couponUrl'],
    data () {
        return {
            form: this.$form.createForm(this)
        };
    },
    methods: {
        handleCouponSubmit(e) {
            //@todo catch the required field error
            this.form.validateFields((err, values) => {
                if (err) {
                    e.preventDefault();
                }
          });
        }
    },
    mounted() {
    }
}
</script>
