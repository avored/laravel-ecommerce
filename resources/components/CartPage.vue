<template>
    <div class="flex justify-center my-6">
        <div
            class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5"
        >
            <div class="flex-1">
                <table class="w-full text-sm lg:text-base" cellspacing="0">
                    <thead>
                        <tr class="h-12 uppercase">
                            <th class="hidden md:table-cell"></th>
                            <th class="text-left">Product</th>
                            <th class="lg:text-right text-left pl-5 lg:pl-0">
                                <span class="lg:hidden" title="Quantity"
                                    >Qtd</span
                                >
                                <span class="hidden lg:inline">Quantity</span>
                            </th>
                            <th class="hidden text-right md:table-cell">
                                Unit price
                            </th>
                            <th class="text-right">Total price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in items" :key="item.slug">
                            <td class="hidden pb-4 md:table-cell">
                               
                                <a href="#">
                                    <img
                                        :src="item.image"
                                        class="w-20 rounded"
                                        :alt="item.name"
                                    />
                                </a>
                              
                            </td>
                            <td>
                                <a href="#">
                                   
                                    <p class="mb-2 md:ml-4">{{ item.name }}</p>
                                    
                                </a>
                            </td>
                            <td
                                class="justify-center md:justify-end md:flex mt-6"
                            >
                                <div class="w-20 h-10">
                                    <div
                                        class="relative flex flex-row w-full h-8"
                                    >
                                        <input
                                            type="number"
                                            :value="item.qty"
                                            class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black"
                                        />
                                    </div>
                                </div>
                            </td>
                            <td class="hidden text-right md:table-cell">
                                <span class="text-sm lg:text-base font-medium">
                                    {{ item.price }}
                                </span>
                            </td>
                            <td class="text-right">
                                <span class="text-sm lg:text-base font-medium">
                                    {{ item.price * item.qty }}
                                </span>
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
                <hr class="pb-6 mt-6" />
                <div class="my-4 mt-6 -mx-2 lg:flex">
                   
                    <div class="lg:px-2 lg:w-full">
                        <div class="flex justify-between pt-4 border-b">
                                <div
                                    class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800"
                                >
                                    Subtotal
                                </div>
                                <div
                                    class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900"
                                >
                                   {{ defaultCurrency.symbol }} {{ subtotal  }}
                                </div>
                            </div>
                            <div class="flex justify-between pt-4 border-b">
                                <div
                                    class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800"
                                >
                                    Tax
                                </div>
                                <div
                                    class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900"
                                >
                                    {{ defaultCurrency.symbol }} {{ totalTax }}
                                </div>
                            </div>
                            <div class="flex justify-between pt-4 border-b">
                                <div
                                    class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800"
                                >
                                    Total
                                </div>
                                <div
                                    class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900"
                                >
                                    {{ defaultCurrency.symbol }} {{ total }}
                                </div>
                            </div>
                            <a :href="checkoutUrl">
                                <button
                                    class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none"
                                >
                                    <svg
                                        aria-hidden="true"
                                        data-prefix="far"
                                        data-icon="credit-card"
                                        class="w-8"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"
                                    >
                                        <path
                                            fill="currentColor"
                                            d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"
                                        />
                                    </svg>
                                    <span class="ml-2 mt-5px"
                                        >Procceed to checkout</span
                                    >
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</template>
<script>
import axios from "axios";

export default {
    props: ["items", "couponUrl", "cartDeleteUrl", "cartUpdateUrl", 'defaultCurrency', 'checkoutUrl'],
    data() {
        return {
            showCartActionBtn: false,
            cartActionProducts: [],
            cartUpdateModalVisibility: false,
            totalTax: 0,
            subtotal: 0,
            total: 0
        };
    },
    methods: {
        clickOnCheckBox(e, product) {
            if (e.target.checked) {
                this.cartActionProducts.push(product);
            } else {
                const index = this.cartActionProducts.findIndex(
                    ele => ele.slug === product.slug
                );
                this.cartActionProducts.splice(index, 1);
            }
            if (this.cartActionProducts.length > 0) {
                this.showCartActionBtn = true;
            } else {
                this.showCartActionBtn = false;
            }
        },
        delteCartProductClick() {
            var app = this;
            axios({
                method: "delete",
                url: this.cartDeleteUrl,
                data: { products: this.cartActionProducts }
            }).then(response => {
                if (response.data.success == true) {
                    app.$notification.success({
                        key: "cart.destroy.success",
                        message: response.data.message
                    });
                    location.reload();
                } else {
                    app.$notification.error({
                        key: "cart.destroy.error",
                        message: response.data.message
                    });
                }
            });
        },
        updateCartProductClick() {
            this.cartUpdateModalVisibility = !this.cartUpdateModalVisibility;
        },
        clickOnCartUpdateCancel() {
            this.cartUpdateModalVisibility = false;
        },
        clickOnCartUpdateOk() {
            var app = this;

            axios({
                method: "put",
                url: this.cartUpdateUrl,
                data: { products: this.cartActionProducts }
            }).then(response => {
                if (response.data.success == true) {
                    app.$notification.success({
                        key: "cart.update.success",
                        message: response.data.message
                    });
                    location.reload();
                } else {
                    app.$notification.error({
                        key: "cart.update.error",
                        message: response.data.message
                    });
                }
            });
        }
    },
    mounted() {
        if (this.items.length > 0 ) {
            this.items.forEach((item) => {
                this.subtotal += item.price * item.qty
                this.total += item.tax
            })

             this.total = this.subtotal + this.totalTax
        }
    }
};
</script>
