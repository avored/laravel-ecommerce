<script>
import isNil from 'lodash/isNil'

export default {
  props: ['banner', 'baseUrl'],
  data () {
    return {
        form: this.$form.createForm(this),
        status: 0,
        image_path: null,
        headers: null,
        bannerTarget: null,
        defaultFileList: []
    };
  },
  methods: {
    targetChange(val) {
      this.bannerTarget = val
    },
    handleSubmit() {
        this.form.validateFields((err, values) => {
        if (err) {
            e.preventDefault();
        }
        });
    },
    handleUploadImageChange(info) {
     
      if (info.file.status === 'done' && info.file.response.success) {
        this.image_path = info.file.response.image
      } else if (info.file.status === 'error') {
        this.$message.error('upload error');
      }  
    },
    changeStatusSwitch(val) {
    if (val) {
        this.status = 1;
    } else {
        this.status = 0;
    }
    },
    clickCancelButton() {
        window.location = this.baseUrl + '/banner';
    }
  },
  mounted() {
      this.headers = { 'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content};
      if (!isNil(this.banner)) {
        this.status = this.banner.status
        this.image_path = this.banner.image_path
        this.defaultFileList.push({
          uid: this.banner.id,
          name: '/storage/' + this.banner.image_path,
          status: 'done'
        })
        this.bannerTarget = this.banner.target
      }
  }
};
</script>
