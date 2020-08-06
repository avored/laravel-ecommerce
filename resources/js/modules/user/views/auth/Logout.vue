<template>
  <div>
   
  </div>
</template>
<script>

import { AUTH_TOKEN } from '@/modules/system/constants'

export default {
  name: "admin-logout",
  components: {},
  data() {
    return {
     
    };
  },
  mounted() {
    localStorage.removeItem(AUTH_TOKEN);
    this.$router.push({name: 'admin.login'});
  }
};
</script>
