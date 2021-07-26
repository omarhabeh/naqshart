<template>
  <div>
    <div class="spinner-content">
      <!-- <div class="spinner"></div> -->
      <img src="/images/Animatedlogogifspeed.gif" width="200px" />
    </div>
    <shopHeader></shopHeader>
    <appslider></appslider>
  </div>
</template>

<script>
import shopHeader from "../pagecomponents/ShopHeader";
import appslider from "../pagecomponents/Slider";

export default {
  components: { shopHeader, appslider },
    metaInfo(){
      return{
          title:`Shop | Naqsh Art`,
          meta:[
             {
                  name:'description',
                  content:'Our mission is to empower creative expression by supporting artists and marketing their original works, and presenting their works with artistic quality to art lovers from all over the world.'
             },
             { property: 'og:site_name', content: 'Naqsh art'},
                {property: 'og:type', content: 'website'},
                {name: 'robots', content: 'index,follow'},
               ]
      }
  },
  mounted() {
    $(".modal-mask").css("display", "block");
  },
};
</script>

<style>
</style>
