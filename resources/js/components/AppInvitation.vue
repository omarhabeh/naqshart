<template>
  <v-app>
    <div class="spinner-content">
      <!-- <div class="spinner"></div> -->
      <img src="/images/Animatedlogogifspeed.gif" width="200px" />
    </div>
    <appnavbar></appnavbar>
    <router-view></router-view>
          <div class="container">
        <div class="row mt-2">
            <div class="col-md-12">
              <div class="card flex-md-row mb-1 h-md-250" style="border: 0px solid rgba(0,0,0,.125); text-align: right;">
                <div class="card-body d-flex flex-column align-items-start">
                  <h3 class="mb-0 text-dark">
                    أهلًا بكم في نقش
                    <hr>
                  </h3>
                  <p class="card-text mb-auto mt-1">في نقش, نطمح إلى نشر الفن الرقمي العربي إلى العالم بتمكين الفنانين من خلال
                    تسويق أعمالهم الأصلية وتقديمها بجودة فنية إلى محبي الفن في العالم.</p>
                </div>
                <img class="card-img-right flex-auto d-md-block" src="{{ asset('images/invitations/naqshart.jpg') }}" alt="Card image cap" height="220">
              </div>
            </div>
            <div class="col-md-12">
              <div class="card flex-md-row mb-4 h-md-250" style="border: 0px solid rgba(0,0,0,.125); text-align: right;">
                <div class="card-body d-flex flex-column align-items-start">
                  <h3 class="mb-0 text-dark">
                    لماذا أنضم إلى نقش؟
                    <hr>
                  </h3>
                  <p class="card-text mb-auto mt-1">
                    <ul class="mr-0 pr-0">
                      <li>- سنهتم بكل ما هو مطلوب لتسليم عملك الفني إلى العميل بأفضل طريقة ممكنة</li>
                      <li>- سيتم تضمين اسمك وأعمالك الفنية في حمالتنا التسويقية.</li>
                      <li>- 15 %من مبيعات لوحاتك الفنية تحوًل إلى حسابك نهاية كل شهرين.</li>
                      <li>- من حين آلخر، سيتم اختيار أعمال فنية مختلفة لعرضها في المعارض التي تشارك فيها
                        نقش.</li>
                    </ul>
                  </p>
                    <h3 class="mb-0 text-dark">
                      هل سيتم وضع اسمي على أعمالي؟
                      <hr>
                    </h3>
                    <p class="card-text mb-auto mt-1">بكل تأكيد! فإن سمعتك وتقديرك كفنان مهم لنا, سيكون اسمك واضحًا في صفحة
                      الفنانين، التي يتعرف من خلالها زوار الموقع على هوية الفنان والوصول إلى صفحاته على
                      مواقع التواصل الاجتماعي.</p>
                </div>
                <img class="card-img-right flex-auto d-md-block mt-3" src="{{ asset('images/invitations/img.jpg') }}" alt="Card image cap" height="350">
              </div>
            </div>
            <div class="col-md-12">
              <div class="card flex-md-row mb-1 h-md-250" style="border: 0px solid rgba(0,0,0,.125); text-align: right;">
                <div class="card-body d-flex flex-column align-items-start">
                  <h3 class="mb-0 text-dark">
                    كيف سيتم عرض أعمالي؟
                    <hr>
                  </h3>
                  <p class="card-text mb-auto mt-1">بكل تأكيد! فإن سمعتكمن خلال موقنا الإلكتروني الذي تم تطويره ليكون معرضاً للفن الرقمي بتجربة فريدة للزائرين.</p>
              </div>
            </div>
            <div class="col-md-12">
                <img class="card-img-right flex-auto d-md-block responsive" src="{{ asset('images/invitations/img2.jpg') }}" alt="Card image cap">
              </div>
            </div>
            <div class="col-md-12">
              <div class="card flex-md-row mb-1 h-md-250 no-border" style="text-align: right;">
                <div class="card-body d-flex flex-column align-items-start">
                  <h3 class="mb-0 text-dark">
                    ما هو المنتج الذي سيحمل أعمالي؟
                    <hr>
                  </h3>
                  <p class="card-text mb-auto mt-1">
                    <p>ندرك تماماً الجهود التي بذلتها على كل قطعة فنية, لذلك صممنا منتجاً بجودة
                      تليق بهذه الأعمال.</p>
                    <ul class="mr-0 pr-0">
                      <li>- بوليستر كانفاس190gsm.</li>
                      <li>- إطار خشب الماروبا الأسود مدمج بالمغناطيس.</li>
                      <li>- أسطوانة بتصميم فني لحفظ العمل. </li>
                    </ul>
                  </p>
                </div>
                <img class="card-img-right flex-auto d-md-block" src="{{ asset('images/invitations/img3.jpg') }}" alt="Card image cap" height="220">
              </div>
            </div>
            <div class="card text-center centred-card no-border">
              <div class="card-body">
                <button class="btn btn-dark mb-3 black" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">انضم الان</button>
                <p class="card-text">نتمنى أن نكون حافزاً لإبداعك واستمرارك</p>
                <p class="card-text">في حال وجود أي سؤال راسلنا على</p>
                <p class="card-text">hello@naqshart.com</p>
              </div>
            </div>
          </div>
          <!-- modal -->
          <div dir="rtl" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="form-group">
                      <label for="name" class="col-form-label">الاسم:</label>
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-form-label">البريد الالكتروني:</label>
                      <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                      <label for="phone" class="col-form-label">رقم الجوال:</label>
                      <input type="tel" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                      <label for="country" class="col-form-label">الدولة:</label>
                      <select name="country" id="country" class="form-control">
                        <option value="">Saudi Arabia</option>
                        <option value="">Morocco</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">ما هي برامج الرسم المستعملة؟</label>
                      <input type="text" class="form-control" id="recipient-name">
                    </div>
                  </form>
                </div>
                <div class="modal-footer justify-content-center">
                  <button type="button" class="btn btn-dark black ml-3">إرسال</button>
                </div>
              </div>
            </div>
          </div>
        </div>

    <appfooter></appfooter>
  </v-app>
</template>
<script>
import appnavbar from "./Layout/Navbar";
import appfooter from "./Layout/Footer";
import "jquery";
export default {
  created() {
    let cart = localStorage.getItem("cart");
    if (cart != null) {
      this.$store.commit("SET_CART", JSON.parse(cart));
    }
  },
  components: { appfooter, appnavbar },
};
</script>
<style>
@media (max-width: 768px) {
  html,
  body {
    overflow-x: hidden !important;
  }
}
.spinner {
  width: 40px;
  height: 40px;
  background-color: wheat;
  border-radius: 100%;
  -webkit-animation: sk-scaleout 1s infinite ease-in-out;
  animation: sk-scaleout 1s infinite ease-in-out;
}
.spinner-content {
  background: black;
  width: 100%;
  position: fixed;
  height: 100vh;
  z-index: 9999999999;
  display: flex;
  justify-content: center;
  align-items: center;
}
.spinner-content img {
  margin-top: -30px;
}
@-webkit-keyframes sk-scaleout {
  0% {
    -webkit-transform: scale(0);
  }
  100% {
    -webkit-transform: scale(1);
    opacity: 0;
  }
}
@keyframes sk-scaleout {
  0% {
    -webkit-transform: scale(0);
    transform: scale(0);
  }
  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 0;
  }
}
</style>
