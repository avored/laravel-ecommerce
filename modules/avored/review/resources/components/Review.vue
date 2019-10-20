<template>
    <div>
        <h1>Reviews</h1>
        <a-tabs default-active-key="a.review.list" >
          <a-tab-pane tab="Reviews" key="a.review.list">
            <div v-for="(review, index) in reviews" :key="index">
              <div class="review">
                <a-row :gutter="30">
                  <a-col :span="6">
                    <p>
                      {{ review.name }}
                      <a-avatar :size="32" icon="user"></a-avatar> 
                    </p>
                    <a-rate :default-value="review.star"  name="star"></a-rate>
                  </a-col>
                  <a-col :span="18">
                    <p>{{ review.content }}</p>
                  </a-col>
                </a-row>
                <a-divider></a-divider>
              </div>
            </div>
          </a-tab-pane>
          <a-tab-pane tab="Submit Review" key="a.review.save" :force-render="true">
            <form :action="saveReviewUrl" method="post">
              <input type="hidden" name="_token" :value="token" />
              <a-form-item label="Name">
                  <a-input :auto-focus="true" name="name"></a-input>
              </a-form-item>
              <a-form-item label="Email">
                  <a-input  name="email"></a-input>
              </a-form-item>
              <a-form-item label="Review">
                  <a-textarea :rows="4" name="content"></a-textarea>
              </a-form-item>
              <a-form-item label="Star">
                  <a-rate v-model="star"  name="star"></a-rate>
              </a-form-item>
              <input type="hidden" name="star" v-model="star" />
              <input type="hidden" name="product_id" :value="productId" />
              <a-form-item>
                <a-button type="primary" html-type="submit">
                  Save Review
                </a-button>

              </a-form-item>
            </form>
          </a-tab-pane>
          
        </a-tabs>
    </div>
</template>

<script>


export default {
  props: ['saveReviewUrl', 'productId', 'reviews'],
  data () {
    return {
      token: null,
      star: 0,
    };
  },
  methods: {
  },
  mounted() {
    this.token = document.head.querySelector('meta[name="csrf-token"]').content;
  }
}
</script>
