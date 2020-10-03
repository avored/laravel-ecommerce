<template>
  <div>
    <div class="mt-3">
         <avored-table
            :columns="columns"
            :from="initReviews.from"
            :to="initReviews.to"
            :total="initReviews.total"
            :prev_page_url="initReviews.prev_page_url"
            :next_page_url="initReviews.next_page_url"
            :items="initReviews.data"
        >
         
          <template slot="action" slot-scope="{item}">
            <div class="flex items-center">
                <button type="button" class="px-2 py-1 text-white hover:text-white bg-red-600 rounded hover:bg-red-700" 
                    v-if="item.status != 'APPROVED'" 
                    @click.prevent="doApprovedRequest(item)">
                  {{ $t('system.approved') }}
                </button>
                <div v-else class="text-green-500 font-semibold">
                  {{ $t('system.approved') }}
                </div>
            </div>
          </template>
        </avored-table>
    </div>
  </div>
</template>

<script>

export default {
  props: ['baseUrl', 'initReviews'],
  data () {
    return {
        columns: [],
    };
  },
  mounted() {
    this.columns = [
        {
          label: this.$t('system.id'),
          fieldKey: "id"
        },
        {
          label: this.$t('system.name'),
          fieldKey: "name"
        },
        {
          label: this.$t('system.email'),
          fieldKey: "email"
        },
        {
          label: this.$t('system.rating'),
          fieldKey: "star"
        },
        {
          label: this.$t('system.status'),
          fieldKey: "status"
        },
        {
          label: this.$t('system.actions'),
          slotName: "action"
        }
    ];

  },
  methods: {
     
      doApprovedRequest(record) {
        var url = this.baseUrl  + '/review/' + record.id + '/approved/'
        var app = this;
        this.$confirm({message: this.$t('system.approved_modal_message', {name: record.name, term: this.$t('system.rating')}), callback: () => {
            axios.post(url)
              .then(response =>  {
                  if (response.data.success === true) {
                      app.$alert(response.data.message)
                  }
                  window.location.reload();
              })
              .catch(errors => {
                  app.$alert(errors.message)
              });
        }})
     
    },
  }
};
</script>
