

<script>
export default {
  data () {
    return {
        star: 0,
        givenRating: 0
    };
  },
  methods: {
        onStarOver(val) {
          this.star = val
        },
        clickOnStar(val) {
          this.givenRating = val
        },
        onStarLeave() {
          this.star = 0
        }
  },
  mounted() {
      console.info('avored review frontend components')
  }
}
</script>
