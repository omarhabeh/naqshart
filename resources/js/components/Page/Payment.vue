<template>
  <section
    style="margin-top: 3%; transition-duration: 5s; transition: all 2s linear"
  >
    <div class="row" v-if="$i18n.locale == 'en'">
      <div class="col-md-5 sm_discount mt-4" style="background-color: #fafafa">
        <div
          class="clickdown"
          @click="discount_section = !discount_section"
          v-if="!discount_section"
        >
          <span>
            <i class="fa fa-shopping-cart ml-2 mr-2"></i>
            {{ $t("message.showorder") }}
          </span>
          <span class="plus" v-if="discount_section == false">
            <i class="fa fa-chevron-down"></i>
          </span>
          <span style="float: right" class="mr-3">
            <span style="color: #737171"></span>
            <template v-if="currency == 'sar'"
              >{{ $t("currency.sar") }} {{ cartTotalPriceSAR }}</template
            >
            <template v-else
              >{{ $t("currency.usd1") }} {{ cartTotalPrice }}</template
            >
            <!-- {{cartTotalPrice}} SAR -->
          </span>
          <div style="clear: both"></div>
        </div>
        <div
          class="clickdown"
          @click="discount_section = !discount_section"
          v-else
        >
          <span>
            <i class="fa fa-shopping-cart ml-2 mr-2"></i>
            {{ $t("message.hideorder") }}
          </span>
          <span class="plus" v-if="discount_section == true">
            <i class="fa fa-chevron-up"></i>
          </span>
          <span style="float: right" class="mr-3">
            <span style="color: #737171"></span>
            <template v-if="currency == 'sar'"
              >{{ $t("currency.sar") }} {{ cartTotalPriceSAR }}</template
            >
            <template v-else
              >{{ $t("currency.usd1") }} {{ cartTotalPrice }}</template
            >
            <!-- {{cartTotalPrice}} SAR -->
          </span>
          <div style="clear: both"></div>
        </div>
        <div
          class="discount_section mt-5"
          style="width: 100%; padding: 0px 10px"
          v-if="discount_section"
        >
          <div
            class="border-bottom p-2 img"
            v-for="item in cart"
            :key="item.product.id"
          >
            <div class="d-inline-block position-relative">
              <span class="quantity">{{ item.quantity }}</span>
              <img :src="item.product.artistMinPalettes.img" />
            </div>
            <span class="price ml-5">
              <strong>{{ item.product.name }}</strong>
            </span>
            <!-- <div class="countity" style="float:right">{{item.price}} SAR</div> -->
            <div class="countity" style="float: right" v-if="currency == 'sar'">
              {{ item.product.M_price_sar }} {{ $t("currency.sar") }}
            </div>
            <div class="countity" style="float: right" v-else>
              {{ item.price }} {{ $t("currency.usd1") }}
            </div>
            <div style="clear: both"></div>
            <!-- <h6 style="width: 50%;margin-left: 90px;margin-top:-31px">{{ item.sizeTarget }} </h6> -->
          </div>

          <div class="discount">
            <v-form class="form_discount">
              <v-row>
                <v-col cols="9" sm="9" class="pr-0">
                  <v-text-field
                    v-model="discount"
                    label="Discount"
                    outlined
                    filled
                    style="border: none"
                  ></v-text-field>
                </v-col>
                <v-col cols="3" sm="3" style="padding: 0">
                  <v-btn
                    @click="apply_discount()"
                    color="#c8c8c8"
                    style="color: white; padding: 26px 0"
                  >
                    <i class="fa fa-arrow-right"></i>
                  </v-btn>
                </v-col>
              </v-row>
            </v-form>
          </div>
          <hr />
          <!-- <div class="discount_text" style="color:#737171;padding:10px"> -->
          <div style="padding: 10px" v-if="discount_value_sar != 0">
            <span style="padding: 10px; color: #444f58">Subtotal</span>
            <span
              style="float: right; color: #444f58; padding-right: 10px"
              v-if="currency == 'sar'"
              >{{ discount_value_sar }} {{ $t("currency.sar") }}</span
            >
            <span
              style="float: right; color: #444f58; padding-right: 10px"
              v-else
              >{{ discount_value }} {{ $t("currency.usd1") }}</span
            >
            <div style="clear: both"></div>
          </div>
          <hr />
          <!-- <div class="mt-3">
                <span>Shipping</span>
                <span style="float:right">calculated at next</span>
                <div style="clear:both"></div>
          </div>-->
          <!-- </div> -->

          <div style="padding: 10px">
            <span style="font-size: 1.3em; padding: 10px">Total</span>
            <span style="float: right">
              <span style="color: #737171; padding-right: 10px">
                <template v-if="currency == 'sar'">
                  <strong style="color: #323232; font-size: 1.5em"
                    >{{ $t("currency.sar") }} {{ cartTotalPriceSAR }}</strong
                  >
                </template>
                <template v-else>
                  <strong style="color: #323232; font-size: 1.5em"
                    >{{ $t("currency.usd1") }} {{ cartTotalPrice }}</strong
                  >
                </template>
                <!-- SAR&nbsp; &nbsp;
                <strong style="color:black;font-size:22px">{{cartTotalPrice}}</strong>-->
              </span>
            </span>
            <div style="clear: both"></div>
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div
          class="modal show"
          id="exampleModalCenter"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true"
          show="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="display: contents">
              <div class="moda-body">
                <form
                  :action="`/api/payment/${id}/${form.paymentMethod}`"
                  class="paymentWidgets"
                  :data-brands="form.paymentMethod"
                ></form>
              </div>
            </div>
          </div>
        </div>
        <v-form
          class="form"
          @submit.prevent="send"
          autocomplete="on"
          style="transition-duration: 5s; transition: all 2s linear"
        >
          <v-container v-if="step == 1">
            <div class="alert text-left mb-3">
              <h5 class="red--text" v-if="errors.items">
                {{ $t("message.noitem") }}
              </h5>
            </div>
            <div
              v-if="message.length > 0"
              class="alert alert-info alert-dismissible fade show"
              role="alert"
            >
              <h1 class="text-center">Done</h1>
              <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <v-row>
              <h4 style="font-size: 1.3rem">Contacts information</h4>
              <v-col cols="12" md="12" style="padding: 0px 12px">
                <label>E-mail</label>
                <v-text-field
                  v-model="form.email"
                  outlined
                  style="border: none"
                  :rules="emailRules"
                ></v-text-field>

                <span class="red--text" v-if="errors.email">{{
                  errors.email[0]
                }}</span>
              </v-col>
              <!-- <v-checkbox
                        v-model="form.checkbox"
                        :rules="[v => !!v || 'You must agree to continue!']"
                        label="Keep me up to date on news and exclusive offers"
                        required
              ></v-checkbox>-->

              <v-col cols="6" sm="6" style="padding: 0px 12px">
                <label>First Name</label>
                <v-text-field
                  v-model="form.fname"
                  outlined
                  style="border: none"
                  :rules="nameRules"
                ></v-text-field>
                <div class="invalid-feedback">
                  <span class="red--text" v-if="nameRules"
                    >This field is required</span
                  >
                </div>
                <span class="red--text" v-if="errors.fname">{{
                  errors.fname[0]
                }}</span>
              </v-col>

              <v-col cols="6" sm="6" style="padding: 0px 12px">
                <label>Last Name</label>
                <v-text-field
                  v-model="form.lname"
                  outlined
                  style="border: none"
                  :rules="nameRules"
                ></v-text-field>
                <span class="red--text" v-if="errors.lname">{{
                  errors.lname[0]
                }}</span>
              </v-col>

              <v-col md="4" sm="4" cols="4" style="padding: 0px 12px">
                <label>Code</label>
                <v-select
                  v-model="form.phonecode"
                  :items="mobileCode"
                  placeholder="Country code"
                  outlined
                  style="border: none"
                  :rules="nameRules"
                ></v-select>
                <span class="red--text" v-if="errors.phonecode">{{
                  errors.phonecode[0]
                }}</span>
              </v-col>
              <v-col cols="8" sm="8" style="padding: 0px 12px 12px">
                <label>Phone Number</label>
                <v-text-field
                  v-model="form.phone"
                  outlined
                  style="border: none"
                  :rules="nameRules"
                ></v-text-field>
                <span class="red--text" v-if="errors.phone">{{
                  errors.phone[0]
                }}</span>
              </v-col>
              <h4
                style="
                  font-size: 1.3rem;
                  padding-top: 1em;
                  padding-bottom: 0.5em;
                "
              >
                Shipping Address
              </h4>
              <v-col cols="12" sm="12" style="padding: 0px 12px">
                <label>Country</label>
                <v-select
                  v-model="form.country"
                  :items="countries"
                  outlined
                  style="border: none"
                  :rules="nameRules"
                ></v-select>
                <span class="red--text" v-if="errors.country">{{
                  errors.country[0]
                }}</span>
              </v-col>
              <v-col cols="8" md="8" style="padding: 0px 12px">
                <label>City</label>
                <!-- <v-text-field v-model="form.city" outlined style="border:none"></v-text-field> -->
                <v-select
                  v-model="form.city"
                  :items="cities"
                  :rules="nameRules"
                  outlined
                  dir="rtl"
                  style="border: none; text-align: right"
                ></v-select>
                <span class="red--text" v-if="errors.city">{{
                  errors.city[0]
                }}</span>
              </v-col>
              <v-col cols="4" sm="4" style="padding: 0px 12px">
                <label>Post Code</label>
                <v-text-field
                  v-model="form.postcode"
                  outlined
                  style="border: none"
                  :rules="nameRules"
                ></v-text-field>
                <span class="red--text" v-if="errors.postcode">{{
                  errors.postcode[0]
                }}</span>
              </v-col>
              <v-col cols="12" md="12" style="padding: 0px 12px">
                <label>Address</label>
                <v-text-field
                  v-model="form.address"
                  outlined
                  style="border: none"
                  :rules="nameRules"
                ></v-text-field>
                <span class="red--text" v-if="errors.address">{{
                  errors.address[0]
                }}</span>
              </v-col>
              <v-col cols="12" md="12" style="padding: 0px 12px">
                <label>Appartment (optional)</label>
                <v-text-field
                  v-model="form.apartment"
                  outlined
                  style="border: none"
                ></v-text-field>
                <span class="red--text" v-if="errors.apartment">{{
                  errors.apartment[0]
                }}</span>
              </v-col>
            </v-row>

            <v-btn
              color="#197bbd"
              style="
                float: right;
                margin: 20px 0;
                height: 10px;
                font-weight: 100;
                text-transform: none;
              "
              class="check_btn"
              :disabled="FormNotFinished()"
              @click.prevent="next()"
            >
              Next
            </v-btn>
          </v-container>
          <v-container v-if="step == 2">
            <div class="content-box cbox1">
              <div class="content-box__row content-box__row--no-border">
                <h2>Customer information</h2>
              </div>
              <div class="content-box__row">
                <div class="section__content">
                  <div
                    class="
                      section__content__column section__content__column--half
                    "
                  >
                    <div class="text-container">
                      <h3 class="heading-3">Contact information</h3>

                      <p>
                        <bdo dir="ltr">{{ this.form.email }}</bdo>
                      </p>
                      <h3 class="heading-3">Shipping address</h3>
                      <address class="address">
                        {{ this.form.fname }} {{ this.form.lname }}<br />{{
                          this.form.city
                        }}<br />{{ this.form.address }} {{ this.form.postcode
                        }}<br />{{ this.form.country }}<br />‎{{
                          this.form.phone
                        }}
                      </address>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="content-box cbox2">
              <div class="content-box__row content-box__row--no-border">
                <h3 class="heading-3">Please choose the payment method</h3>
              </div>
              <div class="content-box__row">
                <div class="section__content">
                  <v-row>
                    <div class="logo_payment mada col-lg-2 col-md-6">
                      <v-btn
                        type="sumbit"
                        style="border: none !important; background: none"
                        @click="form.paymentMethod = 'MADA'"
                      >
                        <img
                          src="/images/mada.png"
                          alt=""
                          style="width: 100px"
                        />
                      </v-btn>
                    </div>
                    <div class="logo_payment stc col-lg-2 col-md-6">
                      <v-btn
                        type="sumbit"
                        style="border: none !important; background: none"
                        @click="form.paymentMethod = 'STC_PAY'"
                      >
                        <img
                          src="/images/stcpay.jpeg"
                          alt=""
                          style="width: 100px"
                        />
                      </v-btn>
                    </div>
                    <div class="logo_payment visa col-lg-2 col-md-6">
                      <v-btn
                        type="sumbit"
                        style="border: none !important; background: none"
                        @click="form.paymentMethod = 'VISA'"
                      >
                        <img
                          src="/images/visa.png"
                          alt=""
                          style="width: 100px"
                        />
                      </v-btn>
                    </div>
                    <div class="logo_payment master col-lg-2 col-md-6">
                      <v-btn
                        type="sumbit"
                        style="border: none !important; background: none"
                        @click="form.paymentMethod = 'MASTER'"
                      >
                        <img
                          src="/images/master.png"
                          alt=""
                          style="width: 100px"
                        />
                      </v-btn>
                    </div>
 <div class="logo_payment apple col-lg-2 col-md-6">
                      <v-btn
                        type="sumbit"
                        style="border: none !important; background: none"
                        @click="form.paymentMethod = 'APPLEPAY'"
                      >
                        <img
                          src="/images/applepay.png"
                          alt=""
                          style="width: 100px"
                        />
                      </v-btn>
                    </div>
                    <!-- <form action="https://gate2play.docs.oppwa.com/tutorials/integration-guide" class="paymentWidgets" data-brands="APPLEPAY"></form> -->
                  </v-row>
                </div>
              </div>
            </div>

            <!-- <v-btn
              color="#197bbd"
              style="
                float: right;
                margin: 20px 0;
                height: 10px;
                font-weight: 100;
                text-transform: none;
              "
              class="check_btn"
              type="submit"
              >Continue to payment</v-btn
            > -->
            <v-btn
              color="#197bbd"
              style="
                float: right;
                margin: 20px 0;
                height: 10px;
                font-weight: 100;
                text-transform: none;
                margin-right: 20px;
              "
              class="check_btn"
              @click.prevent="prev()"
            >
              Previous
            </v-btn>
            <!-- <img
              src="/images/tenor.gif"
              v-show="loading"
              style="width: 82px; float: right"
            /> -->
          </v-container>
        </v-form>
        <!-- <form :action="`/api/payment/${id}/APPLEPAY`" class="paymentWidgets" data-brands="APPLEPAY"  @click="form.paymentMethod = 'APPLEPAY'" @submit.prevent="send()">
         <v-btn
                        type="sumbit"
                        style="border: none !important; background: none"
                        @click="form.paymentMethod = 'APPLEPAY'"
                      >
                        <img
                          src="/images/applepay.png"
                          alt=""
                          style="width: 100px"
                        />
                      </v-btn>
        </form> -->

      </div>
      <div class="col-md-5 lg_discount" style="background-color: #fafafa">
        <div class="discount_section mt-5">
          <div
            class="border-bottom p-2 img"
            v-for="item in cart"
            :key="item.product.id"
          >
            <div class="d-inline-block position-relative">
              <span class="quantity">{{ item.quantity }}</span>
              <img :src="item.product.artistMinPalettes.img" />
            </div>
            <span class="price ml-5">
              <strong>{{ item.product.name }}</strong>
            </span>
            <div class="countity" style="float: right" v-if="currency == 'sar'">
              {{ $t("currency.sar") }} {{ item.product.M_price_sar }}
            </div>
            <div class="countity" style="float: right" v-else>
              {{ $t("currency.usd1") }} {{ item.price }}
            </div>
            <!-- <div class="countity" style="float:right">{{item.price}} SAR</div> -->
            <div style="clear: both"></div>
            <!-- <h6 style="width: 50%;margin-left: 90px;margin-top:-31px">{{ item.sizeTarget }} </h6> -->
          </div>

          <div class="discount">
            <v-form class="form_discount">
              <v-row>
                <v-col cols="12" sm="9">
                  <v-text-field
                    v-model="discount"
                    label="Discount"
                    outlined
                    filled
                    style="border: none"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="3">
                  <v-btn
                    @click="apply_discount()"
                    color="#c8c8c8"
                    style="color: white; padding: 10px"
                    >Apply</v-btn
                  >
                </v-col>
              </v-row>
            </v-form>
          </div>
          <hr />
          <!-- <div class="discount_text" style="color:#737171;padding:10px"> -->
          <div v-if="discount_value_sar != 0">
            <span
              style="
                font-size: 1em;
                padding: 10px;
                color: #535353;
                font-weight: 600;
              "
              >Subtotal</span
            >
            <span
              style="
                float: right;
                font-size: 1em;
                color: #323232;
                padding-right: 10px;
                font-weight: bold;
              "
              v-if="currency == 'sar'"
              >{{ $t("currency.sar") }}{{ discount_value_sar }}</span
            >
            <span
              style="
                float: right;
                font-size: 1em;
                color: #323232;
                padding-right: 10px;
                font-weight: bold;
              "
              v-else
              >{{ $t("currency.usd1") }}{{ discount_value }}</span
            >
            <div style="clear: both"></div>
            <hr />
          </div>

          <!-- <div class="mt-3">
              <span>Shipping</span>
              <span style="float:right">calculated at next</span>
              <div style="clear:both"></div>
          </div>-->
          <!-- </div> -->
          <div v-if="step == 2 && Shipping_res != null">
            <span
              style="
                font-size: 1.2em;
                padding-left: 10px;
                color: #323232;
                font-weight: 600;
              "
              >Shipping</span
            >
            <span style="float: right">
              <span style="color: #737171; padding-right: 10px">
                <template v-if="currency == 'sar'">
                  <strong style="color: #323232; font-size: 1.5em"
                    >{{ $t("currency.sar") }} {{ Shipping_res }}</strong
                  >
                </template>
                <template v-else>
                  <strong style="color: #323232; font-size: 1.5em"
                    >{{ $t("currency.usd1") }} {{ Shipping_res_us }}</strong
                  >
                </template>
              </span>
            </span>
            <div style="clear: both"></div>
          </div>
          <div>
            <span
              style="
                font-size: 1.2em;
                padding-left: 10px;
                color: #323232;
                font-weight: 600;
              "
              >Subtotal</span
            >
            <span style="float: right">
              <span style="color: #737171; padding-right: 10px">
                <template v-if="currency == 'sar'">
                  <strong style="color: #323232; font-size: 1.5em"
                    >{{ $t("currency.sar") }} {{ cartTotalPriceSAR }}</strong
                  >
                </template>
                <template v-else>
                  <strong style="color: #323232; font-size: 1.5em"
                    >{{ $t("currency.usd1") }} {{ cartTotalPrice }}</strong
                  >
                </template>
              </span>
            </span>
            <div style="clear: both"></div>
          </div>
          <div v-if="step == 2 && Shipping_res != null">
            <hr />
            <span
              style="
                font-size: 1.2em;
                padding-left: 10px;
                color: #323232;
                font-weight: 600;
              "
              >Total</span
            >
            <span style="float: right">
              <span style="color: #737171; padding-right: 10px">
                <template v-if="currency == 'sar'">
                  <strong style="color: #323232; font-size: 1.5em"
                    >{{ $t("currency.sar") }}
                    {{ cartTotalPriceSAR + parseFloat(Shipping_res) }}</strong
                  >
                </template>
                <template v-else>
                  <strong style="color: #323232; font-size: 1.5em"
                    >{{ $t("currency.usd1") }}
                    {{ cartTotalPrice + parseFloat(Shipping_res_us) }}</strong
                  >
                </template>
              </span>
            </span>
            <div style="clear: both"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" dir="ltr" v-else>
      <div class="col-md-5 sm_discount mt-4" style="background-color: #fafafa">
        <div
          class="clickdown"
          @click="discount_section = !discount_section"
          v-if="!discount_section"
        >
          <span>
            <i class="fa fa-shopping-cart ml-2 mr-2"></i>
            {{ $t("message.showorder") }}
          </span>
          <span class="plus" v-if="discount_section == false">
            <i class="fa fa-chevron-down"></i>
          </span>
          <span style="float: right" class="mr-3">
            <span style="color: #737171"></span>
            <template v-if="currency == 'sar'"
              >{{ $t("currency.sar") }} {{ cartTotalPriceSAR }}</template
            >
            <template v-else
              >{{ $t("currency.usd1") }} {{ cartTotalPrice }}</template
            >
          </span>
          <div style="clear: both"></div>
        </div>
        <div
          class="clickdown"
          @click="discount_section = !discount_section"
          v-else
        >
          <span>
            <i class="fa fa-shopping-cart ml-2 mr-2"></i>
            {{ $t("message.hideorder") }}
          </span>
          <span class="plus" v-if="discount_section == true">
            <i class="fa fa-chevron-up"></i>
          </span>
          <span style="float: right" class="mr-3">
            <span style="color: #737171"></span>
            <template v-if="currency == 'sar'"
              >{{ $t("currency.sar") }} {{ cartTotalPriceSAR }}</template
            >
            <template v-else
              >{{ $t("currency.usd1") }} {{ cartTotalPrice }}</template
            >
            <!-- {{cartTotalPrice}} SAR -->
          </span>
          <div style="clear: both"></div>
        </div>
        <div
          class="discount_section mt-5"
          style="width: 100%; padding: 0px 10px"
          v-if="discount_section"
        >
          <div
            class="border-bottom p-2 img"
            v-for="item in cart"
            :key="item.product.id"
          >
            <div class="d-inline-block position-relative">
              <span class="quantity">{{ item.quantity }}</span>
              <img :src="item.product.artistMinPalettes.img" />
            </div>
            <span class="price ml-5">
              <strong>{{ item.product.name }}</strong>
            </span>
            <div class="countity" style="float: right" v-if="currency == 'sar'">
              {{ $t("currency.sar") }} {{ item.product.M_price_sar }}
            </div>
            <div class="countity" style="float: right" v-else>
              {{ $t("currency.usd1") }} {{ item.price }}
            </div>

            <div style="clear: both"></div>
            <!-- <h6 style="width: 50%;margin-left: 90px;margin-top:-31px">{{ item.sizeTarget }} </h6> -->
          </div>

          <div class="discount">
            <v-form class="form_discount">
              <v-row>
                <v-col cols="9" sm="9">
                  <v-text-field
                    v-model="discount"
                    label="الكوبون"
                    outlined
                    filled
                    style="border: none"
                  ></v-text-field>
                </v-col>
                <v-col cols="3" sm="3" style="padding: 0">
                  <v-btn
                    @click="apply_discount()"
                    color="#c8c8c8"
                    style="color: white; padding: 26px 0"
                  >
                    <i class="fa fa-arrow-right"></i>
                  </v-btn>
                </v-col>
              </v-row>
            </v-form>
          </div>
          <hr />
          <div
            class="discount_text"
            style="color: #737171; padding: 10px"
            v-if="discount_value_sar != 0"
          >
            <div>
              <span
                style="
                  font-size: 16px;
                  float: right;
                  padding: 10px;
                  color: #444f58;
                "
                >الخصم</span
              >
              <span
                style="
                  font-size: 16px;
                  color: #444f58;
                  padding-right: 10px;
                  font-weight: bold;
                "
                v-if="currency == 'sar'"
                >{{ discount_value_sar }} {{ $t("currency.sar") }}</span
              >
              <span
                style="
                  font-size: 16px;
                  color: #444f58;
                  padding-right: 10px;
                  font-weight: bold;
                "
                v-else
                >{{ discount_value }} {{ $t("currency.usd1") }}</span
              >

              <div style="clear: both"></div>
            </div>
          </div>

          <div style="font-size: 1.3em; padding: 10px">
            <span style="float: right">الحساب الإجمالى</span>
            <span>
              <span style="color: #737171; padding-right: 10px">
                <template v-if="currency == 'sar'">
                  <strong style="color: #323232; font-size: 1.5em">{{
                    cartTotalPriceSAR
                  }}</strong>
                  {{ $t("currency.sar") }}
                </template>
                <template v-else>
                  <strong style="color: #323232; font-size: 1.5em">{{
                    cartTotalPrice
                  }}</strong>
                  {{ $t("currency.usd1") }}
                </template>
                <!-- SAR&nbsp;&nbsp; -->
                <!-- <strong style="color:black;font-size:22px">{{cartTotalPrice}}</strong> -->
              </span>
            </span>
            <div style="clear: both"></div>
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div
          class="modal show"
          id="exampleModalCenter"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true"
          show="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="display: contents">
              <div class="moda-body">
                <form
                  :action="'/api/payment/' + id + '/' + form.paymentMethod"
                  class="paymentWidgets"
                  :data-brands="form.paymentMethod"
                ></form>
              </div>
            </div>
          </div>
        </div>
        <v-form class="form" @submit.prevent="send">
          <v-container v-if="step == 1">
            <div class="alert text-center mb-3">
              <h5 class="red--text" v-if="errors.items">
                {{ $t("message.noitem") }}
              </h5>
            </div>
            <div
              v-if="message.length > 0"
              class="alert alert-info alert-dismissible fade show"
              role="alert"
            >
              <h1 class="text-center">Done</h1>
              <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <v-row>
              <h4 style="font-size: 1.3rem; width: 100%" class="text-right">
                تسجيل البيانات
              </h4>
              <v-col cols="12" md="12" style="padding: 0px 12px">
                <label style="float: right">البريد الإلكتروني</label>
                <div style="clear: both"></div>
                <v-text-field
                  v-model="form.email"
                  outlined
                  style="border: none"
                  dir="rtl"
                  :rules="emailRules"
                ></v-text-field>
                <span class="red--text" v-if="errors.email">{{
                  errors.email[0]
                }}</span>
              </v-col>
              <!-- <v-checkbox
                        v-model="form.checkbox"
                        :rules="[v => !!v || 'You must agree to continue!']"
                        label="Keep me up to date on news and exclusive offers"
                        required
              ></v-checkbox>-->

              <v-col cols="6" sm="6" style="padding: 0px 12px">
                <label style="float: right">الاسم الأخير</label>
                <div style="clear: both"></div>
                <v-text-field
                  v-model="form.lname"
                  outlined
                  style="border: none"
                  dir="rtl"
                  :rules="nameRules"
                ></v-text-field>
                <span class="red--text" v-if="errors.lname">{{
                  errors.lname[0]
                }}</span>
              </v-col>
              <v-col cols="6" sm="6" style="padding: 0px 12px">
                <label style="float: right">الاسم الأول</label>
                <div style="clear: both"></div>
                <v-text-field
                  v-model="form.fname"
                  outlined
                  style="border: none"
                  dir="rtl"
                  :rules="nameRules"
                ></v-text-field>
                <span class="red--text" v-if="errors.fname">{{
                  errors.fname[0]
                }}</span>
              </v-col>
              <v-col cols="4" sm="4" style="padding: 0px 12px 12px">
                <label style="float: right">كود الدولة</label>
                <div style="clear: both"></div>
                <v-select
                  v-model="form.phonecode"
                  :items="mobileCode"
                  outlined
                  style="border: none"
                  placeholder="كود الدولة"
                  dir="rtl"
                  :rules="nameRules"
                ></v-select>
                <span class="red--text" v-if="errors.phonecode">{{
                  errors.phonecode[0]
                }}</span>
              </v-col>
              <v-col cols="8" sm="8" style="padding: 0px 12px 12px">
                <label style="float: right">رقم الهاتف</label>
                <div style="clear: both"></div>
                <v-text-field
                  v-model="form.phone"
                  outlined
                  style="border: none"
                  dir="rtl"
                  :rules="nameRules"
                ></v-text-field>
                <span class="red--text" v-if="errors.phone">{{
                  errors.phone[0]
                }}</span>
              </v-col>

              <h4
                style="
                  font-size: 1.3rem;
                  padding-top: 1em;
                  padding-bottom: 0.5em;
                  width: 100%;
                "
                class="text-right"
              >
                بيانات الشحن
              </h4>
              <v-col cols="12" sm="12" style="padding: 0px 12px">
                <label style="float: right">الدولة</label>
                <div style="clear: both"></div>
                <v-select
                  v-model="form.country"
                  :items="countries"
                  outlined
                  dir="rtl"
                  :rules="nameRules"
                  style="border: none; text-align: right"
                ></v-select>
                <span class="red--text" v-if="errors.country">{{
                  errors.country[0]
                }}</span>
              </v-col>
              <v-col cols="8" md="8" style="padding: 0px 12px">
                <label style="float: right">المدينة</label>
                <div style="clear: both"></div>
                <!-- v-select -->
                <v-select
                  v-model="form.city"
                  :items="cities"
                  outlined
                  :rules="nameRules"
                  dir="rtl"
                  style="border: none; text-align: right"
                ></v-select>
                <span class="red--text" v-if="errors.city">{{
                  errors.city[0]
                }}</span>
              </v-col>
              <v-col cols="4" sm="4" style="padding: 0px 12px">
                <label style="float: right">رمز البريد</label>
                <div style="clear: both"></div>
                <v-text-field
                  v-model="form.postcode"
                  outlined
                  :rules="nameRules"
                  style="border: none"
                  dir="rtl"
                ></v-text-field>
                <span class="red--text" v-if="errors.postcode">{{
                  errors.postcode[0]
                }}</span>
              </v-col>

              <v-col cols="12" md="12" style="padding: 0px 12px">
                <label style="float: right">العنوان</label>
                <div style="clear: both"></div>
                <v-text-field
                  v-model="form.address"
                  outlined
                  :rules="nameRules"
                  style="border: none"
                  dir="rtl"
                ></v-text-field>
                <span class="red--text" v-if="errors.address">{{
                  errors.address[0]
                }}</span>
              </v-col>
              <v-col cols="12" md="12" style="padding: 0px 12px">
                <label style="float: right">المنزل (اختياري)</label>
                <div style="clear: both"></div>
                <v-text-field
                  v-model="form.apartment"
                  outlined
                  style="border: none"
                  dir="rtl"
                ></v-text-field>
                <span class="red--text" v-if="errors.apartment">{{
                  errors.apartment[0]
                }}</span>
              </v-col>

              <!-- <v-col class="d-flex" cols="12" sm="4">
                <v-select
                  v-model="form.goverment"
                  item-text="name"
                  item-value="last"
                  :items="item"
                  label="المحافظة"
                  outlined
                ></v-select>
              </v-col>-->
            </v-row>

            <v-btn
              color="#197bbd"
              style="
                float: right;
                margin: 20px 0;
                height: 10px;
                font-weight: 100;
                text-transform: none;
              "
              class="check_btn"
              :disabled="FormNotFinished()"
              @click.prevent="next()"
            >
              التالي
            </v-btn>
            <div style="clear: both"></div>
          </v-container>
          <v-container v-if="step == 2">
            <div class="content-box cbox1">
              <div class="content-box__row content-box__row--no-border">
                <h2>بيانات العميل</h2>
              </div>
              <div class="content-box__row">
                <div class="section__content">
                  <div
                    class="
                      section__content__column section__content__column--half
                    "
                  >
                    <div class="text-container">
                      <h3 class="heading-3">معلومات التواصل</h3>

                      <p>
                        <bdo dir="ltr">{{ this.form.email }}</bdo>
                      </p>
                      <h3 class="heading-3">بيانات الشحن</h3>
                      <address class="address">
                        {{ this.form.fname }} {{ this.form.lname }}<br />{{
                          this.form.city
                        }}<br />{{ this.form.address }} {{ this.form.postcode
                        }}<br />{{ this.form.country }}<br />‎{{
                          this.form.phone
                        }}
                      </address>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="content-box cbox2">
              <div class="content-box__row content-box__row--no-border">
                <h3 class="heading-3">الرجاء اختيار طريقة الدفع</h3>
              </div>
              <div class="content-box__row">
                <div class="section__content">
                  <v-row>
                    <div class="logo_payment mada col-lg-2 col-md-6">
                      <v-btn
                        type="sumbit"
                        style="border: none !important; background: none"
                        @click="form.paymentMethod = 'MADA'"
                      >
                        <img
                          src="/images/mada.png"
                          alt=""
                          style="width: 100px"
                        />
                      </v-btn>
                    </div>
                    <div class="logo_payment stc col-lg-2 col-md-6">
                      <v-btn
                        type="sumbit"
                        style="border: none !important; background: none"
                        @click="form.paymentMethod = 'STC_PAY'"
                      >
                        <img
                          src="/images/stcpay.jpeg"
                          alt=""
                          style="width: 100px"
                        />
                      </v-btn>
                    </div>
                    <div class="logo_payment visa col-lg-2 col-md-6">
                      <v-btn
                        type="sumbit"
                        style="border: none !important; background: none"
                        @click="form.paymentMethod = 'VISA'"
                      >
                        <img
                          src="/images/visa.png"
                          alt=""
                          style="width: 100px"
                        />
                      </v-btn>
                    </div>
                    <div class="logo_payment master col-lg-2 col-md-6">
                      <v-btn
                        type="sumbit"
                        style="border: none !important; background: none"
                        @click="form.paymentMethod = 'MASTER'"
                      >
                        <img
                          src="/images/master.png"
                          alt=""
                          style="width: 100px"
                        />
                      </v-btn>
                    </div>
                    <div class="logo_payment apple col-lg-2 col-md-6">
                      <v-btn
                        type="submit"
                        style="border: none !important; background: none"
                        @click="form.paymentMethod = 'APPLEPAY'"
                      >
                        <img
                          src="/images/applepay.png"
                          alt=""
                          style="width: 100px"
                        />
                      </v-btn>
                    </div>
                  </v-row>
                </div>
              </div>
            </div>
            <v-btn
              color="#197bbd"
              style="
                float: right;
                margin: 20px 0;
                height: 10px;
                font-weight: 100;
                text-transform: none;
                margin-right: 20px;
              "
              class="check_btn"
              @click.prevent="prev()"
            >
              <span class="back">الرجوع</span>
            </v-btn>
            <!-- <img
              src="/images/tenor.gif"
              class="loader"
              style="width: 82px; float: right"
            /> -->
          </v-container>
        </v-form>
      </div>
      <div
        class="col-md-5 lg_discount"
        style="background-color: #fafafa; padding-left: 4%; padding-right: 2%"
      >
        <div class="discount_section mt-5">
          <div
            class="border-bottom p-2 img"
            v-for="item in cart"
            :key="item.product.id"
          >
            <div class="d-inline-block position-relative">
              <span class="quantity">{{ item.quantity }}</span>
              <img :src="item.product.artistMinPalettes.img" />
            </div>
            <span class="price ml-5">
              <strong>{{ item.product.name }}</strong>
            </span>
            <div class="countity" style="float: right" v-if="currency == 'sar'">
              {{ $t("currency.sar") }} {{ item.product.M_price_sar }}
            </div>
            <div class="countity" style="float: right" v-else>
              {{ $t("currency.usd1") }} {{ item.price }}
            </div>
            <div style="clear: both"></div>
            <!-- <h6 style="width: 50%;margin-left: 70px;margin-top:-31px">{{ item.sizeTarget }} </h6> -->
          </div>

          <div class="discount">
            <v-form class="form_discount">
              <v-row>
                <v-col cols="12" sm="9">
                  <v-text-field
                    v-model="discount"
                    label="الكوبون"
                    outlined
                    filled
                    style="border: none"
                  ></v-text-field>
                </v-col>

                <v-col cols="12" sm="3">
                  <v-btn
                    @click="apply_discount()"
                    color="#c8c8c8"
                    style="color: white; padding: 10px"
                    >خصم الأن</v-btn
                  >
                </v-col>
              </v-row>
            </v-form>
          </div>
          <hr />
          <div
            class="discount_text"
            style="color: #737171; padding: 10px"
            v-if="discount_value_sar != 0"
          >
            <div>
              <span
                style="
                  font-size: 16px;
                  float: right;
                  padding: 10px;
                  color: #444f58;
                "
                >الخصم</span
              >
              <span
                style="
                  font-size: 16px;
                  color: #444f58;
                  padding-right: 10px;
                  font-weight: bold;
                "
                v-if="currency == 'sar'"
                >{{ discount_value_sar }} {{ $t("currency.sar") }}</span
              >
              <span
                style="
                  font-size: 16px;
                  color: #444f58;
                  padding-right: 10px;
                  font-weight: bold;
                "
                v-else
                >{{ discount_value }} {{ $t("currency.usd1") }}</span
              >
              <div style="clear: both"></div>
            </div>
          </div>

          <div style="padding: 10px" v-if="step == 2 && Shipping_res != null">
            <span style="float: right; font-size: 1.3em">حساب التوصيل</span>
            <span>
              <span style="color: #737171; padding-right: 10px">
                <template v-if="currency == 'sar'">
                  <strong style="color: #323232; font-size: 1.5em">{{
                    Shipping_res
                  }}</strong>
                  {{ $t("currency.sar") }}
                </template>
                <template v-else>
                  <strong style="color: #323232; font-size: 1.5em">{{
                    Shipping_res_us
                  }}</strong>
                  {{ $t("currency.usd1") }}
                </template>
              </span>
            </span>
            <div style="clear: both"></div>
          </div>
          <div style="padding: 10px">
            <span style="float: right; font-size: 1.3em"
              >الحساب نصف الإجمالي</span
            >
            <span>
              <span style="color: #737171; padding-right: 10px">
                <template v-if="currency == 'sar'">
                  <strong style="color: #323232; font-size: 1.5em">{{
                    cartTotalPriceSAR
                  }}</strong>
                  {{ $t("currency.sar") }}
                </template>
                <template v-else>
                  <strong style="color: #323232; font-size: 1.5em">{{
                    cartTotalPrice
                  }}</strong>
                  {{ $t("currency.usd1") }}
                </template>
              </span>
            </span>
            <div style="clear: both"></div>
          </div>

          <div style="padding: 10px" v-if="step == 2 && Shipping_res != null">
            <hr />
            <span style="float: right; font-size: 1.3em">الحساب الإجمالي</span>
            <span>
              <span style="color: #737171; padding-right: 10px">
                <template v-if="currency == 'sar'">
                  <strong style="color: #323232; font-size: 1.5em">{{
                    cartTotalPriceSAR + parseFloat(Shipping_res)
                  }}</strong>
                  {{ $t("currency.sar") }}
                </template>
                <template v-else>
                  <strong style="color: #323232; font-size: 1.5em">{{
                    cartTotalPrice + parseFloat(Shipping_res_us)
                  }}</strong>
                  {{ $t("currency.usd1") }}
                </template>
              </span>
            </span>
            <div style="clear: both"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
 <script>
let mobileCodes = require("../../data/mobilecode").default;
// mobileCodes.unshift("Mobile Code");
let countries = require("../../data/countries.json");
let codes = require("../../data/code.json");
let countriesNames = Object.keys(countries);

export default {
  computed: {
    larg(el, price, avilable) {
      this.sizeTarget = "Large - 70x93.5cm (28x37)";
      this.avilableTarget = avilable;
      this.active_el = el;
      this.priceTarget = price;
      $(".active>.details_img").css({ width: "100%", height: "250px" });
      $(".active>.content").css({ width: "100%" });
    },
    cartTotalPrice() {
      return this.$store.getters.cartTotalPrice;
    },
    cartTotalPriceSAR() {
      return this.$store.getters.cartTotalPriceSAR;
    },
    cart() {
      return this.$store.state.cart;
    },
    currency() {
      return this.$store.getters.currency;
    },
    currentLanguage() {
      return this.$i18n.locale;
    },
    currentCountry() {
      return this.form.country;
    },
    callShippmentCalc() {
      return this.form.city;
    },
    formEmail() {
      return this.form.email;
    },
  },
  watch: {
    formEmail(value) {
      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
        this.errors.email = "";
      } else {
        this.errors.email = ["The email must be a valid email address."];
      }
    },
    callShippmentCalc(city) {
      if (city != null) {
        axios
          .get(
            "/aramix/sample.php?length=" +
              this.cart.length +
              "&city=" +
              this.form.city +
              "&countryCode=" +
              this.countryCode +
              "&currency=" +
              this.currency
          )
          .then((result) => {
            if (result.data) {
              this.Shipping_res = result.data.TotalAmount.Value;
              this.form.shippment_res = this.shippment_res;
              this.Shipping_res_us = (
                result.data.TotalAmount.Value / 3.75
              ).toFixed(2);
            }
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
    currentCountry(newCountry, oldCountry) {
      for (var i = 0; i < codes.length; i++) {
        if (codes[i].name == newCountry) {
          this.countryCode = codes[i].code;
        }
      }
      this.cities = countries[newCountry];
    },
  },
  data() {
    return {
      errors: {},
      loading: false,
      step: 1,
      Shipping_res: null,
      Shipping_res_us: null,
      form: {
        email: null,
        lname: null,
        address: null,
        fname: null,
        apartment: null,
        city: null,
        phone: null,
        phonecode: null,
        country: "Saudi Arabia",
        goverment: "Saudi Arabia",
        postcode: null,
        items: [],
        promocode: "",
        paymentMethod: "VISA",
        shippment_res: 0,
      },
      discount: "",
      discount_value: 0,
      discount_value_sar: 0,
      //   cartTotalPrice: 0,
      id: "",
      mobileCode: mobileCodes,
      countries: countriesNames,
      cities: [],
      nameRules: [(v) => !!v || "Field is required"],
      emailRules: [
        (v) =>
          !v ||
          /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          "E-mail must be valid",
      ],
      checkbox: false,
      message: "",
      formview: "",
      discount_section: false,
      paymentMethods: ["VISA", "MASTER", "MADA", "APPLEPAY", "STC_PAY"],
      countryCode: "SA",
    };
  },
  mounted() {
    var wpwlOptions = {
      paymentTarget: "_top",
      applePay: {
        displayName: "MyStore",
        total: { label: "COMPANY, INC." },
        merchantCapabilities: ["supports3DS"],
        supportedNetworks: ["masterCard", "visa", "mada"],
        supportedCountries: ["SA"],
      },
    };
    this.$store.commit("CHANGE_TIMER", false);
    $(".modal-mask").css("display", "none");

    this.form.country = "Saudi Arabia";
    this.cities = countries["Saudi Arabia"];
  },
  created() {
    this.cartTotalPrice;
    this.cart.forEach((element) => {
      this.form.items.push({
        paletteid: element.product.id,
        palettesize: element.sizeTarget,
        quantity: element.quantity,
      });
    });
  },
  methods: {
    FormNotFinished() {
      if (
        this.form.email &&
        this.form.lname &&
        this.form.address &&
        this.form.fname &&
        this.form.city &&
        this.form.phone &&
        this.form.phone &&
        this.form.phonecode &&
        this.form.country &&
        this.form.goverment &&
        this.form.postcode &&
        this.cart.length >= 1
      ) {
        return false;
      }
      return true;
    },
    prev() {
      this.step--;
    },
    next() {
      this.step++;
    },
    apply_discount() {
      //console.log(this.discount);
      axios
        .post("/api/check-promo", { code: this.discount })
        .then((data) => {
          // console.log(data.data);
          if (data.data.status) {
            var price = parseInt(data.data.percentage);
            this.discount_value = (this.cartTotalPrice * price) / 100;
            this.cartTotalPrice = this.cartTotalPrice - this.discount_value;
            this.form.promocode = this.discount;
            //SAR
            this.discount_value_sar = (this.cartTotalPriceSAR * price) / 100;
            this.cartTotalPriceSAR =
              this.cartTotalPriceSAR - this.discount_value_sar;
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    clearProductFromCart(product) {
      this.$store.dispatch("deleteCartItem", product);
    },
    clearCartItems() {
      //     this.shippment_res = 0;
      //     this.Shipping_res_us = 0;
      //   this.$store.dispatch("clearCartItems");
    },
    metaInfo() {
      return {
        title: `Checkout | Naqsh Art`,
        meta: [
          {
            name: "description",
            content:
              "Our mission is to empower creative expression by supporting artists and marketing their original works, and presenting their works with artistic quality to art lovers from all over the world.",
          },
          { property: "og:site_name", content: "Naqsh art" },
          { property: "og:type", content: "website" },
          { name: "robots", content: "index,follow" },
        ],
      };
    },
    send() {
      this.loading = true;
      this.form.shippment_res = parseFloat(this.Shipping_res);
      axios
        .post("/api/add-order", this.form)
        .then((data) => {
          $("#exampleModalCenter").modal("show");
          this.formview = data.data.orderid;
          this.id = data.data.orderid;
          let tag = document.createElement("script");
          tag.setAttribute(
            "src",
            "https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=" +
              data.data.checkid
          );
          document.head.appendChild(tag);
          this.errors = "";
          //   this.$store.dispatch("clearCartItems");
        })

        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log(error.response.data.errors);
          this.step--;
        });
      this.loading = false;
    },
  },
};
</script>

<style scoped>
.wpwl-apple-pay-button{-webkit-appearance: -apple-pay-button !important;}
.form {
  width: 87%;
  margin: auto;
  padding-left: 6%;
}
.img {
  padding-bottom: 1.5em !important;
  margin: 20px 0;
}
.img img {
  width: 62px;
  height: 70px;
  border: 1px rgba(0, 0, 0, 0.1) solid;
  border-radius: 8px;
}
.form_discount {
  padding: 10px;
}
.discount_section {
  width: 89%;
  margin-top: 12% !important;
}
.countity {
  margin-top: 20px;
  font-size: 1em;
  font-weight: 600;
  color: #323232;
}
.check_btn {
  border: 1px transparent solid;
  border-radius: 5px;
  color: white;
  font-weight: 500;
  padding: 25px 15px !important;
  text-align: center;
}
.price {
  position: relative;
  top: -16px;
  color: #323232;
  font-size: 1em;
  font-weight: 600;
}
@media (min-width: 1000px) {
  .content-box {
    width: 50%;
    margin-bottom: 20px;
  }
}
@media (min-width: 1380px) {
  .logo_payment button {
    width: 100% !important;
  }
  .logo_payment {
    flex: 0 0 50% !important;
  }
  .apple {
    flex: 0 0 100% !important;
  }
}
@media (min-width: 997px) and (max-width: 1335px) {
  .logo_payment {
    max-width: 50% !important;
    width: 100% !important;
  }
  .logo_payment button {
    width: 100% !important;
  }
}
@media (min-width: 767px) and (max-width: 991px) {
  .logo_payment {
    flex: 0 0 25%;
    max-width: 100% !important;
  }
  .apple {
    flex: 0 !important;
  }
  .discount_section {
    width: 100%;
  }
}

.discount .v-input__slot {
  background: transparent !important;
}
.alert {
  text-align: center;
}
.sm_discount {
  display: none;
}
@media (max-width: 767px) {
  .visa img,
  .mada img {
    width: 70px !important;
  }
  .stc img {
    width: 80px !important;
  }
  .apple img {
    width: 50px !important;
  }
  .form {
    padding-left: 0px;
  }
  .lg_discount {
    display: none;
  }
  .sm_discount {
    display: block;
    margin-top: 15% !important;
  }
  .logo_payment {
    margin: 0px !important;
    margin-bottom: 0px;
    display: grid;
    width: 50%;
    margin-bottom: -13px !important;
    padding: 5px !important;
  }
  .check_btn {
    margin: 0px !important;
    margin-top: 35px !important;
    margin-bottom: 20px;
  }
  .apple {
    margin-bottom: 10px !important;
  }
}
.quantity {
  position: absolute;
  width: 21px;
  right: -18%;
  top: -11%;
  height: 21px;
  background: #808080;
  color: #fff;
  border-radius: 50%;
  text-align: center;
  font-size: 0.8rem;
  line-height: 23px;
  font-weight: bold;
}
@media (max-width: 767px) {
  /* .quantity {
    left: 78px;
  } */
}
.clickdown {
  cursor: pointer;
  font-size: 18px;
  color: #197bbd;
  padding: 7px;
}
.theme--light.v-btn:not(.v-btn--flat):not(.v-btn--text):not(.v-btn--outlined) {
  background-color: rgb(200, 200, 200);
  padding: 1em 1.7em;
  border: 1px solid rgb(200, 200, 200);
  border-radius: 5px;
  color: white;
  font-weight: bolder;
  text-align: center;
  font-size: 14px;
  white-space: nowrap;
  line-height: 1.5;
  text-transform: capitalize;
  height: auto;
}
@media (max-width: 767px) {
  .apple {
    display: block !important;
    width: 100% !important;
  }
  .apple * {
    width: 100% !important;
  }
  .check_btn {
    margin-bottom: 20px !important;
  }
  .theme--light.v-btn:not(.v-btn--flat):not(.v-btn--text):not(.v-btn--outlined) {
    background-color: #f5f5f5;
    margin-top: 14px;
  }
}

.theme--light.v-input {
  padding: 0 !important;
}
.v-text-field > .v-input__control > .v-input__slot > .v-text-field__slot input {
  text-align: start !important;
}
@media all {
  .text-container > * + * {
    margin-top: 0.5714285714em;
  }
  .text-container * + .heading-3 {
    margin-top: 1.4285714286em;
  }
  h2 {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
      Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji",
      "Segoe UI Symbol", sans-serif;
    font-size: 1.2857142857em;
    line-height: 1.3em;
  }
  .main h2 {
    color: #333;
  }
  .content-box h2 {
    color: #333;
  }
  .heading-3,
  h3 {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
      Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji",
      "Segoe UI Symbol", sans-serif;
    font-size: 1em;
    font-weight: 500;
    line-height: 1.3em;
  }
  .main .heading-3,
  .main h3 {
    color: #333;
  }
  .content-box .heading-3,
  .content-box h3 {
    color: #333;
  }
  p {
    line-height: 1.5em;
  }
  .emphasis {
    font-weight: 500;
  }
  .main .emphasis {
    color: #333;
  }
  .content-box .emphasis {
    color: #333;
  }
  .address {
    font-style: normal;
    line-height: 1.5em;
  }
  .section__content {
    zoom: 1;
  }
  .section__content:after,
  .section__content:before {
    content: "";
    display: table;
  }
  .section__content:after {
    clear: both;
  }
  .section__content__column {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    margin-top: 2em;
  }
  .section__content__column:first-of-type {
    margin-top: 0;
  }
  @media (min-width: 750px) {
    .logo_payment {
      margin: 10px !important;
    }
    .section__content__column {
      margin-top: 0;
      float: left;
    }
  }
  @media (min-width: 750px) {
    .cbox2 {
      float: right;
      width: 58%;
    }
    .cbox1 {
      float: left;
      width: 40%;
    }
    .logo_payment {
      max-width: 50%;
      margin: 0px !important;
    }
    .apple {
      display: inline-block;
      width: 100%;
      max-width: 100% !important;
      flex: 1;
    }
    .apple * {
      width: 100%;
    }
    .section__content__column--half {
      padding: 0 0.75em;
      width: 50%;
    }
    .section__content__column--half:first-child {
      padding-left: 0;
    }
    .section__content__column--half:last-child {
      padding-right: 0;
    }
  }
  .content-box {
    background: #fff;
    background-clip: padding-box;
    border: 1px solid #d9d9d9;
    border-radius: 5px;
    color: #545454;
  }
  .main .content-box {
    border-color: #d9d9d9;
  }
  .content-box {
    margin-top: 1em;
  }
  .content-box__row {
    padding: 1.1428571429em;
    position: relative;
    zoom: 1;
  }
  .content-box__row ~ .content-box__row {
    border-top: 1px solid #d9d9d9;
  }
  .content-box__row:after,
  .content-box__row:before {
    content: "";
    display: table;
  }
  .content-box__row:after {
    clear: both;
  }
  .display-table .content-box__row {
    display: table;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    width: 100%;
  }
  .content-box__row:first-child {
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
  }
  .content-box__row:last-child {
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
  }
  .content-box__row--no-border {
    padding-bottom: 0;
  }
  .content-box__row--no-border + .content-box__row {
    border-top: none;
  }
  .payment-icon {
    display: inline-block;
    width: 38px;
    height: 24px;
    -webkit-transition: opacity 0.5s cubic-bezier(0.3, 0, 0, 1);
    transition: opacity 0.5s cubic-bezier(0.3, 0, 0, 1);
    backface-visibility: hidden;
  }
  .payment-icon--visa {
    background-image: url(//cdn.shopify.com/shopifycloud/shopify/assets/payment_icons/visa-319d545c6fd255c9aad5eeaad21fd6f7f7b4fdbdb1a35ce83b89cca12a187f00.svg),
      none;
  }
  .payment-icon {
    border-radius: 0.2142857143em;
    background-size: cover;
    background-repeat: no-repeat;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
    width: 2.7142857143em;
    height: 1.7142857143em;
  }
  .payment-method-list__item-icon {
    vertical-align: middle;
    margin: -0.1em 0.25em 0 0;
  }
  .visually-hidden {
    border: 0;
    clip: rect(0, 0, 0, 0);
    clip: rect(0 0 0 0);
    width: 2px;
    height: 2px;
    margin: -2px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    white-space: nowrap;
  }
}

html {
  overflow-x: hidden !important;
}
.logo_payment img {
  background: whitesmoke;
  height: 30px;
  object-fit: cover;
}

.stc .v-btn {
  background: #4f008d !important;
}
.apple * {
  background: black !important;
}
.apple img,
.mada img,
.master img {
  object-fit: contain;
}
.master * {
  background: #64625e !important;
}
.visa * {
  background: #0353a5 !important;
}
</style>

<style>
.theme--light.v-text-field--filled > .v-input__control > .v-input__slot {
  background: transparent !important;
}
</style>
