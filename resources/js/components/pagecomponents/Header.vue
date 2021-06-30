<template>
  <div class="hero hero-classic">
    <div class="row hero-row">
      <!-- <img class="hero-image-md" :src="data.image" alt="Fine art" /> -->
      <div
        class="col-md-12 hero-container hide-d"
        id="hero-container_2"
        :style="'background:url(' + data.imageM + ')'"></div>
        <div
          class="col-md-12 hero-container hide-m"
          id="hero-container_1"
          :style="'background:url(' + data.image + ')'"
        ></div>
          <div class="hero-content">
              <img src="/images/LogoSymbolBlackPNG.png" style="width:200px" alt="">
            <p v-if="$i18n.locale == 'en'" class="hero-subtitle">
              {{ data.word1_en }}
            </p>
            <p v-else class="hero-subtitle">{{ data.word1_ar }}</p>
            
            <div class="hero-counter">
              <!-- style="margin-top: 2px !important;" -->
              <span class="hero-counter__live">{{ $t("message.live") }}</span>
              <img
                class="hero-counter__eye ml-2 mr-1"
                src="https://cdn2.iconfinder.com/data/icons/flat-ui-icons-24-px/24/eye-24-512.png"
                width="15px"
                height="15px"
                style="margin-top: 2px !important"
              />
              <span id="hero-counter">{{ numbers }}</span>
              {{ $t("message.shoppers") }}
            </div>
            <router-link to="/shop">
              <a class="hero-btn btn">{{ $t("message.shopnow") }}</a>
            </router-link>
          </div>
        </div>
      </div>
</template>

<script>
export default {
  data() {
    return {
      images: [
        "//cdn.shopify.com/s/files/1/3000/4362/files/desktop-hero-1_2048x.jpg?v=1592197390",
        "//cdn.shopify.com/s/files/1/3000/4362/files/Augmented_Art_Hero_Desktop_2048x.png?v=1594004875",
        "//cdn.shopify.com/s/files/1/3000/4362/files/peach_desktop_final_post_2048x.jpg?v=1581001094",
        "//cdn.shopify.com/s/files/1/3000/4362/files/sepia_dekstop_final_post_2048x.jpg?v=1565183372",
      ],
      selectedImage: null,
      numbers: "",
      data: {},
    };
  },
  methods: {
    randomItem(items) {
      return items[Math.floor(Math.random() * items.length)];
    },
  },
  created() {
    this.selectedImage = this.randomItem(this.images);
    // this.numbers = Math.floor(Math.random() * 200) + 50;
    axios
      .get("/api/homedata")
      .then((result) => {
        if (result.data.status) {
          this.data = result.data.data;
        }
      })
      .catch((err) => {
        console.log(err.data);
      });
    axios
      .get("/api/counter")
      .then((result) => {
        if (result.data.count) {
          let rand = Math.floor(Math.random() * (49 - 42 + 1)) + 42;
          this.numbers = result.data.count + rand;
        }
      })
      .catch((err) => {
        console.log(err.data);
      });
  },
};
</script>

<style scoped>
.row {
  padding: 0;
  margin: 0;
}

@media (max-width: 991px) {
  .hero .hero-title {
    font-size: 60px;
    padding: 0 10px;
  }
  .hide-d {
    display: block;
  }
  .hide-m {
    display: none;
  }

}
.hero-subtitle{
    margin:0px;
    margin-top:-20px;
}
.hero-container {
  padding-top: 34vh;
  height: 85vh;
  background-repeat: no-repeat !important;
  background-size: cover !important;
}
@media (min-width: 991px) {
  .hero-container {
    height: 75vh;
  }
  .hide-d {
    display: none;
  }
  .hide-m {
    display: block;
  }
}

@media (min-width: 551px) and (max-width: 990px) {
  .hero-container {
    padding-top: 50vh;
    height: 83vh;
    margin-bottom: 75px;
  }
  .myhome {
    padding-top: 100px;
  }
}
@media (min-width: 401px) and (max-width: 550px) {
  .hero-container {
    height: 64vh;
  }
  .hero .hero-title {
    font-size: 40px;
    padding: 0 10px;
    margin: 20px 0 10px 0;
  }
}
@media (max-width: 400px) {
  .hero-container {
    height: 60vh;

  }
  /* .hero-classic .hero-content {
    top: 165px !important;
  } */
  .hero .hero-title {
    font-size: 36px;
  }
}
a:not([href]):hover {
  color: white !important;
}
</style>
