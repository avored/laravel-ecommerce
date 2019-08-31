<template>
    <div>
    <a-menu
        theme="light"
        mode="horizontal"
        :default-selected-keys="[]"
        class="navigation">
            <template v-for="menu in menus">
                <a-menu-item v-if="menu.submenus.length<=0" :key="menu.id">
                    <a :href="menu.url">
                        {{ menu.name }}
                    </a>
                </a-menu-item>
                <a-sub-menu v-if="menu.submenus.length>0" :key="'submenu' + menu.id" :title="menu.name">
                    <a-menu-item :key="menu.id">
                        <a :href="menu.url">
                        {{ menu.name }}
                        </a>
                    </a-menu-item>
                    <a-menu-item v-for="submenu in menu.submenus" :key="submenu.id">
                        <a :href="submenu.url">
                            {{ submenu.name }}
                        </a>
                    </a-menu-item>
                </a-sub-menu>
            </template>
    </a-menu>
    </div>
        
</template>

<script>
export default {
    name: 'avored-nav',
    props: ['menus'],
    data () {
        return {
            
        };
    },
}
</script>
