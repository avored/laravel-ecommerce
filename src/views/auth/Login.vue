<template>
  <div class="w-full flex justify-center mx-auto">
    <div class="relative py-20 sm:max-w-md w-full">
      <div class="relative w-full rounded-3xl px-6 py-4 bg-gray-100 shadow-md">
        <div class="block mt-3 text-red-700 text-center text-2xl font-semibold">
          Login
        </div>
        
        <form method="#" action="#" class="mt-10">
          <div>
            <input
              type="email"
              placeholder="Email Address"
              class="avored-input"
            />
          </div>

          <div class="mt-7">
            <input
              type="password"
              placeholder="Password"
              class="avored-input"
            />
          </div>

          <div class="mt-7 flex">
            <label
              for="remember_me"
              class="inline-flex items-center w-full cursor-pointer"
            >
              <input
                id="remember_me"
                type="checkbox"
                class="
                  rounded
                  border-gray-300
                  text-indigo-600
                  shadow-sm
                  focus:border-indigo-300
                  focus:ring
                  focus:ring-indigo-200
                  focus:ring-opacity-50
                "
                name="remember"
              />
              <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>

            <div class="w-full text-right">
              <a
                class="underline text-sm text-gray-600 hover:text-gray-900"
                href="#"
              >
                Forgot your password?
              </a>
            </div>
          </div>

          <div class="mt-7">
            <button
              class="
                bg-blue-500
                w-full
                py-3
                rounded-xl
                text-white
                shadow-xl
                hover:shadow-inner
                focus:outline-none
                transition
                duration-500
                ease-in-out
                transform
                hover:-translate-x hover:scale-105
              "
            >
              Login
            </button>
          </div>

          <div class="flex mt-7 items-center text-center">
            <hr class="border-gray-300 border-1 w-full rounded-md" />
            <label class="block font-medium text-sm text-gray-600 w-full">
              Login With
            </label>
            <hr class="border-gray-300 border-1 w-full rounded-md" />
          </div>

          <div class="flex mt-7 justify-center w-full">
            <button
              class="
                mr-5
                bg-blue-500
                border-none
                px-4
                py-2
                rounded-xl
                cursor-pointer
                text-white
                shadow-xl
                hover:shadow-inner
                transition
                duration-500
                ease-in-out
                transform
                hover:-translate-x hover:scale-105
              "
            >
              Facebook
            </button>

            <button
              class="
                bg-red-500
                border-none
                px-4
                py-2
                rounded-xl
                cursor-pointer
                text-white
                shadow-xl
                hover:shadow-inner
                transition
                duration-500
                ease-in-out
                transform
                hover:-translate-x hover:scale-105
              "
            >
              Google
            </button>
          </div>

          <div class="mt-7">
            <div class="flex justify-center items-center">
              <label class="mr-2">Don't have an account with us?</label>
              <a
                href="#"
                class="
                  text-blue-500
                  transition
                  duration-500
                  ease-in-out
                  transform
                  hover:-translate-x hover:scale-105
                "
              >
                Register
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
