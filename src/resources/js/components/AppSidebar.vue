<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { LayoutGrid, Pencil, BookOpenText, List } from 'lucide-vue-next';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
// import { dashboard } from '@/routes';
import type { NavItem } from '@/types';
import { index as dashboard } from "@/routes/recipe"
import { index as category_index }  from "@/routes/category";
import { create as recipe_create } from "@/routes/recipe";
import Notification from "@/components/Notification.vue";

const mainNavItems: NavItem[] = [
    {
        title: 'Din kogebog',
        href: dashboard(),
        icon: BookOpenText,
    },
    {
        title: 'Tilføj opskrift',
        href: recipe_create(),
        icon: Pencil,
    },
    {
        title: 'Tilføj kategori',
        href: category_index(),
        icon: Pencil,
    },
    {
        title: 'Se alle opskrifter',
        href: '',
        icon: LayoutGrid,
    },
    {
        title: 'Register',
        href: '',
        icon: List,
    },
];

const footerNavItems: NavItem[] = [

];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
    <!-- Notification to be used sitewide. Can be triggered through the controller -->
<!--    <div-->
<!--        aria-live="assertive"-->
<!--        class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:pt-20 sm:items-start"-->
<!--    >-->
<!--        <div class="w-full flex flex-col items-center space-y-4 sm:items-end">-->
<!--            <notification-->
<!--                v-for="(notification, index) in $page.props.flash.filter((item: any) => item.type === 'notification')"-->
<!--                :key="index"-->
<!--                :data="notification"-->
<!--            />-->
<!--        </div>-->
<!--    </div>-->
</template>
