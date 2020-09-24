<template>
  <div>
      <section class="text-gray-700 body-font">
        <div class="container mx-auto flex px-5  md:flex-row flex-col items-center">
          <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Before they sold out
              <br class="hidden lg:inline-block">readymade gluten
            </h1>
            <p class="mb-8 leading-relaxed">Copper mug try-hard pitchfork pour-over freegan heirloom neutra air plant cold-pressed tacos poke beard tote bag. Heirloom echo park mlkshk tote bag selvage hot chicken authentic tumeric truffaut hexagon try-hard chambray.</p>
            <div class="flex justify-center">
              <button class="inline-flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg">Button</button>
              <button class="ml-4 inline-flex text-gray-700 bg-gray-200 border-0 py-2 px-6 focus:outline-none hover:bg-gray-300 rounded text-lg">Button</button>
            </div>
          </div>
          <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
            <img class="object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
          </div>
        </div>
    </section>
    <h1 class="px-6 text-3xl my-12 font-semibold text-red-700">Latest Products</h1>      
    <div class="text-gray-700 body-font">
        <div class="px-5 mt-5 mx-auto">
            <div class="flex flex-wrap -m-4">

                <div v-for="(product, index) in products" :key="index" 
                  class="lg:w-1/4 md:w-1/2 w-full">
                    <div class="border border-gray-300 m-2">
                        <a class="block relative h-48 rounded overflow-hidden">
                            <img
                                alt="ecommerce"
                                class="object-cover object-center w-full h-full block"
                                src="https://dummyimage.com/420x260"
                            />
                        </a>
                        <div class="mt-4 p-4">
                            <h3
                                class="text-gray-500 text-xs tracking-widest title-font mb-1"
                            >
                                CATEGORY
                            </h3>
                            <h2
                                class="text-gray-900 title-font text-lg font-medium"
                            >
                                The Catalyzer
                            </h2>
                            <p class="mt-1">$16.00</p>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
        </div>
    </div>
    <section class="text-gray-700 body-font">
      <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
          <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Master Cleanse Reliac Heirloom</h1>
          <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Whatever cardigan tote bag tumblr hexagon brooklyn asymmetrical gentrify, subway tile poke farm-to-table. Franzen you probably haven't heard of them man bun deep.</p>
        </div>
        <div class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:px-0">
          <input class="flex-grow w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-red-500 text-base px-4 py-2 mr-4 mb-4 sm:mb-0" placeholder="Full Name" type="text">
          <input class="flex-grow w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-red-500 text-base px-4 py-2 mr-4 mb-4 sm:mb-0" placeholder="Email" type="email">
          <button class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">Button</button>
        </div>
      </div>
    </section>

  </div>
</template>

<script>
export default {
    name: "home",
    components: {},
    data() {
      return {
        products: [1,2,3,4,5,6,7,8]
      }
    }
};
</script>
