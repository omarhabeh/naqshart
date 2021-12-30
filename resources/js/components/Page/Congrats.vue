<template>
  <div class="container">
    <div class="row" style="margin-top: 50px">
      <div class="col-lg-4 col-md-12 col-sm-12 hidem">
        <h2>Congratulations!</h2>
        <hr />
        <p>
          Only ten people can get this artwork, and having this artwork, you
          cultivate the motivation for the artist.
        </p>
      </div>
      <div class="col-lg-4 col-md-12 col-sm-12" style="text-align: center">
        <img
          src="/images/Logo_grey.png"
          alt=""
          width="200px"
          style="margin-top: -50px"
        />
        <p class="no-margin-bottom">معا, نمكن التعبير الابداعي</p>
        <p class="no-margin-bottom">Together, we empower creative expression</p>
      </div>
      <div class="col-lg-4 col-md-12 col-sm-12 hided" style="text-align: right">
        <h2>!تهانينا</h2>
        <hr />
        <p>
          .عشرة من الاشخاص فقط يمكنهم الحصول على هذا العمل, وباقتنائك هذا العمل,
          تزرع للفنان الحافز
        </p>
      </div>
      <div class="col-lg-4 col-md-12 col-sm-12 hided">
        <h2>Congratulations!</h2>
        <hr />
        <p>
          Only ten people can get this artwork, and having this artwork, you
          cultivate the motivation for the artist.
        </p>
      </div>
      <div class="col-lg-4 col-md-12 col-sm-12 hidem" style="text-align: right">
        <h2>!تهانينا</h2>
        <hr />
        <p>
          .عشرة من الاشخاص فقط يمكنهم الحصول على هذا العمل, وباقتنائك هذا العمل,
          تزرع للفنان الحافز
        </p>
      </div>
    </div>
    <div class="row">
      <div
        class="col"
        style="display: flex !important; justify-content: center !important"
      >
        <img src="/images/Tutorial.jpg" alt="" class="tutorial" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
      metaInfo(){
      return{
          title:`Congrats | Naqsh Art`,
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
};
</script>

<style scoped>
@media (max-width: 700px) {
  .tutorial {
    width: 100%;
  }
  .hidem {
    display: none;
  }
}
@media (min-width: 700px) {
  .hided {
    display: none;
  }
}
.no-margin-bottom {
  margin-bottom: 0px;
}
</style>
