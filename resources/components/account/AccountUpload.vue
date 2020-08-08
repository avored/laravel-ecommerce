<script>

export default {
  props: [],
  data () {
    return {
        headers: null,
        image_path: ''
    };
  },
  methods: {
      handleChange(info) {
         if (info.file.status === 'done' && info.file.response.success) {
            this.image_path = info.file.response.image
          } else if (info.file.status === 'error') {
            this.$message.error('upload error');
          }  
      },
  },
  mounted() {
    this.headers = { 'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content};
  }
};
</script>
