<template>
    <div class="flex">
        <ul role="tablist" class="w-32 border-r border-gray-200">
            <li
                v-for="(tab, i) in tabs"
                :key="i"
                :class="{ 'is-active': tab.isActive}"
                class="mt-3 border-b border-gray-200"
                role="presentation"
                v-show="tab.isVisible"
            >
                <a 
                   @click="selectTab(tab.identifier, $event)"
                   :href="'#' + tab.identifier"
                   class="bg-white inline-block py-2 px-4 text-blue-dark font-semibold"
                   role="tab"
                >{{ tab.name }}</a>
            </li>
        </ul>
        <div class="flex-1 p-4">
            <slot/>
        </div>
    </div>
</template>

<script>
    // import expiringStorage from '../expiringStorage';
    export default {
        props: {
            
           
        },
        data: () => ({
            tabs: [],
            activeTabIdentifier: '',
            activeTabIndex: 0,
            lastActiveTabIdentifier: '',
        }),
        computed: {
           
        },
        created() {
            this.tabs = this.$children;
        },
        mounted() {
           
            // const previousSelectedTabIdentifier = expiringStorage.get(this.storageKey);
            // if (this.findTab(previousSelectedTabIdentifier)) {
            //     this.selectTab(previousSelectedTabIdentifier);
            //     return;
            // }
           
            if (this.tabs.length) {
                this.selectTab(this.tabs[0].identifier);
            } else {
                this.selectTab(this.tabs[0].identifier);
            }
            
        },
        methods: {
            findTab(identifier) {
                return this.tabs.find(tab => tab.identifier === identifier);
            },
            selectTab(identifier, event) {
               
                const selectedTab = this.findTab(identifier);
                if (! selectedTab) {
                    return;
                }
            
                if (this.lastActiveTabIdentifier === selectedTab.identifier) {
                    this.$emit('clicked', { tab: selectedTab });
                    return;
                }
                this.tabs.forEach(tab => {
                    tab.isActive = (tab.identifier === selectedTab.identifier);
                });
                this.$emit('changed', { tab: selectedTab });
                this.activeTabIdentifier = selectedTab.identifier;
                this.activeTabIndex = this.getTabIndex(identifier);
                this.lastActiveTabIdentifier = this.activeTabIdentifier = selectedTab.identifier;
            },
            setTabVisible(identifier, visible) {
                const tab = this.findTab(identifier);
                if (! tab) {
                    return;
                }
                tab.isVisible = visible;
                if (tab.isActive) {
                    tab.isActive = visible;
                    this.tabs.every((tab, index, array) => {
                        if (tab.isVisible) {
                            tab.isActive = true;
                            return false;
                        }
                        return true;
                    });
                }
            },
            
            getTabIndex(identifier){
            	const tab = this.findTab(identifier);
            	
            	return this.tabs.indexOf(tab);
            },
            
			getTabIdentifier(index){
            	const tab = this.tabs.find(tab => this.tabs.indexOf(tab) === index);
            	
            	if (!tab) {
					return;
                }
                
                return tab.identifier;
			},
            
            getActiveTab(){
            	return this.findTab(this.activeTabIdentifier);
            },
            
			getActiveTabIndex() {
            	return this.getTabIndex(this.activeTabIdentifier);
            },
        },
    };
</script>
