<script>

export default {
  data () {
    return {
      loginForm: this.$form.createForm(this),
      loadingSubmitBtn: false
    };
  },
  methods: {
    handleSubmit (e) {
      this.loadingSubmitBtn = true;
      this.loginForm.validateFields((err, values) => {
        if (err) {
          this.loadingSubmitBtn = false;
          e.preventDefault();
        }
      });
    }
  },
};
</script>
