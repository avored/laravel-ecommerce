<template>
<nav class="">
    <ul class="block text-center">
        <li class="py-3 border-b block">
        <router-link :to="{name: 'account.edit'}" class="py-3">Edit Profile </router-link>
        </li>
        <li class="py-3 border-b block">
            <router-link :to="{name: 'address.index'}" class="py-3">
                Addresses
            </router-link>
        </li>
        <li class="py-3 border-b block">
            <router-link :to="{name: 'orders.index'}" class="py-3">
                Orders
            </router-link>
        </li>
        <!-- <li class="py-3 border-b block">
            <a class="py-3" href="#"> My Wishlist </a>
        </li> -->
        <li class="py-3 border-b block">
        <a class="py-3" href="#"> Logout </a>
        </li>
    </ul>
</nav>
</template>
